<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\SlipGaji;
use App\Models\KomponenGaji;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use PDF;


class SlipGajiController extends Controller
{
    public function index(Request $request)
    {
        if($request->get('bulan') != "" | !empty($request->get('bulan'))){
            $bulan = $request->get('bulan');
        }else {
            $bulan = "All";
        }

        if($request->get('tahun') != "" | !empty($request->get('tahun'))){
            $tahun = $request->get('tahun');
        }else {
            $tahun = "All";
        }

        $selected_month =  $bulan == "All"? "All":$bulan;
        $selected_year =  $tahun == "All"? "All":$tahun;
        $gaji = SlipGaji::join('karyawan','karyawan_id','=','slipgaji_karyawanid')
        ->select('karyawan.*','slipgaji.*');

        if($selected_month != "All"){
        $gaji->where('slipgaji.slipgaji_bulan',$selected_month);
        }
        if($selected_year != "All"){
        $gaji->where('slipgaji.slipgaji_tahun',$selected_year);
        }

       $gaji = $gaji->get();

        $tahun = SlipGaji::select('slipgaji_tahun as year')->groupBy('year')->get();
        return view('slipgaji.index')->with(compact('gaji','tahun'));
    }

    public function create(Request $request)
    {

        $karyawan_list = Karyawan::join('users','users.id','=','karyawan.karyawan_userid')
        ->select('karyawan.*','users.name','users.email')
        ->get();

        if(!is_null($request->get('k') && is_numeric($request->get('k')))){
            $karyawan = Karyawan::where('karyawan_id', $request->get('k'))->first();
        return view('slipgaji.new')->with(compact('karyawan','karyawan_list'));
        }else {
        return view('slipgaji.new')->with(compact('karyawan_list'));
        }

    }

    public function store(Request $request)
    {
        $karyawan = Karyawan::where('karyawan_id',$request->slipgaji_karyawanid)->first();
        $slipgaji = new SlipGaji;
        $slipgaji->slipgaji_karyawanid = $request->slipgaji_karyawanid;
        $slipgaji->slipgaji_userid = $karyawan->karyawan_userid;
        $slipgaji->slipgaji_bulan = $request->slipgaji_bulan;
        $slipgaji->slipgaji_tahun = $request->slipgaji_tahun;
        $slipgaji->slipgaji_ttd = $request->slipgaji_ttd;
        $slipgaji->slipgaji_tanggalgaji = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $randomizer = Str::random(10).$slipgaji->slipgaji_tanggalgaji;
        $slipgaji->slipgaji_kodeunik = Hash::make($randomizer);

        try {
            $slipgaji->save();
        } catch (QE $e) {
            toast('Database Error','error');
            return $e;
        }

        $updategaji = SlipGaji::where('slipgaji_id', $slipgaji->slipgaji_id)->first();
        $penerimaan = array();
        $potongan = array();
        $totalgaji = 0;
        if($request->penerimaanname || $request->potonganname){
            if($request->penerimaanname){
                foreach($request->penerimaanname as $key => $val){
                    $komponenpenerimaan = new KomponenGaji;
                    $komponenpenerimaan->gaji_slipid = $slipgaji->slipgaji_id;
                    $komponenpenerimaan->gaji_kodeunik =  $slipgaji->slipgaji_kodeunik;
                    $komponenpenerimaan->gaji_typekomponen = 1;
                    $komponenpenerimaan->gaji_komponen = $val;
                    $komponenpenerimaan->gaji_jumlah = $request->penerimaantotal[$key];
                    $komponenpenerimaan->save();
                    $totalgaji = $totalgaji+$request->penerimaantotal[$key];
                    array_push($penerimaan, $komponenpenerimaan->gaji_id);
                }

        $updategaji->slipgaji_komponenpenerimaan = serialize($penerimaan);
            }

            if($request->potonganname){
                foreach($request->potonganname as $key => $val){
                    $komponenpotongan = new KomponenGaji;
                    $komponenpotongan->gaji_slipid = $slipgaji->slipgaji_id;
                    $komponenpotongan->gaji_kodeunik = $slipgaji->slipgaji_kodeunik;
                    $komponenpotongan->gaji_typekomponen = 2;
                    $komponenpotongan->gaji_komponen = $val;
                    $komponenpotongan->gaji_jumlah = $request->potongantotal[$key];
                    $komponenpotongan->save();

                    $totalgaji = $totalgaji-$request->potongantotal[$key];
                    array_push($penerimaan, $komponenpotongan->gaji_id);
                }

        $updategaji->slipgaji_komponenpotongan = serialize($potongan);
            }

        $updategaji->slipgaji_thp = $totalgaji;
        $updategaji->update();


        toast('Slip Gaji Berhasil Dibuat','success');
        return redirect('slipgaji');

        }else {
        alert()->warning('Komponen Penerimaan atau Potongan Kosong');

         return redirect()->back();

        }

    }

    public function show($id)
    {
        $show = SlipGaji::join('karyawan','karyawan_id','=','slipgaji_karyawanid')
        ->join('users','id','=','slipgaji_userid')
        ->select('slipgaji.*','karyawan.*','users.name','users.id','users.email')
        ->where('slipgaji_id', $id)->first();
        $komponenpenerimaan = KomponenGaji::where('gaji_slipid', $show->slipgaji_id)
        ->where('gaji_typekomponen',1)->get();
        $komponenpotongan = KomponenGaji::where('gaji_slipid', $show->slipgaji_id)
        ->where('gaji_typekomponen',2)->get();

        return view('slipgaji.show')->with(compact('show','komponenpenerimaan','komponenpotongan'));
        // return $komponenpenerimaan;
    }

    public function edit($id)
    {
        $edit = SlipGaji::join('karyawan','karyawan_id','=','slipgaji_karyawanid')
        ->join('users','id','=','slipgaji_userid')
        ->select('slipgaji.*','karyawan.*','users.name','users.id','users.email')
        ->where('slipgaji_id', $id)->first();
        $komponenpenerimaan = KomponenGaji::where('gaji_slipid', $edit->slipgaji_id)
        ->where('gaji_typekomponen',1)->get();
        $komponenpotongan = KomponenGaji::where('gaji_slipid', $edit->slipgaji_id)
        ->where('gaji_typekomponen',2)->get();

        $c_pot = count($komponenpotongan);
        $c_pen = count($komponenpenerimaan);

        return view('slipgaji.edit')->with(compact('edit','komponenpenerimaan','komponenpotongan','c_pot','c_pen'));
        // return $c_pot;
    }
    public function print($id)
    {
        $show = SlipGaji::join('karyawan','karyawan_id','=','slipgaji_karyawanid')
        ->join('users','id','=','slipgaji_userid')
        ->select('slipgaji.*','karyawan.*','users.name','users.id','users.email')
        ->where('slipgaji_id', $id)->first();
        $komponenpenerimaan = KomponenGaji::where('gaji_slipid', $show->slipgaji_id)
        ->where('gaji_typekomponen',1)->get();
        $komponenpotongan = KomponenGaji::where('gaji_slipid', $show->slipgaji_id)
        ->where('gaji_typekomponen',2)->get();


        return view('slipgaji.print')->with(compact('show','komponenpenerimaan','komponenpotongan'));
        // return $komponenpenerimaan;
    }



    public function update(Request $request)
    { 
        $slipgaji = SlipGaji::where('slipgaji_id',$request->slipgaji_id)->first();
        
        $komponenpenerimaan = KomponenGaji::where('gaji_slipid', $request->slipgaji_id)
        ->where('gaji_typekomponen',1)->get();
        
        foreach($komponenpenerimaan as $kp){
            $kp->delete();
        }

        $komponenpotongan = KomponenGaji::where('gaji_slipid', $request->slipgaji_id)
        ->where('gaji_typekomponen',2)->get();

        foreach($komponenpenerimaan as $kp2){
            $kp2->delete();
        }
        $karyawan = Karyawan::where('karyawan_id',$request->slipgaji_karyawanid)->first();
       
        $slipgaji->slipgaji_karyawanid = $request->slipgaji_karyawanid;
         
        $slipgaji->slipgaji_ttd = $request->slipgaji_ttd; 

        try {
            $slipgaji->save();
        } catch (QE $e) {
            toast('Database Error','error');
            return $e;
        }

        $updategaji = SlipGaji::where('slipgaji_id', $slipgaji->slipgaji_id)->first();
        $penerimaan = array();
        $potongan = array();
        $totalgaji = 0;
        if($request->penerimaanname || $request->potonganname){
            if($request->penerimaanname){
                foreach($request->penerimaanname as $key => $val){
                    $komponenpenerimaan = new KomponenGaji;
                    $komponenpenerimaan->gaji_slipid = $slipgaji->slipgaji_id;
                    $komponenpenerimaan->gaji_kodeunik =  $slipgaji->slipgaji_kodeunik;
                    $komponenpenerimaan->gaji_typekomponen = 1;
                    $komponenpenerimaan->gaji_komponen = $val;
                    $komponenpenerimaan->gaji_jumlah = $request->penerimaantotal[$key];
                    $komponenpenerimaan->save();
                    $totalgaji = $totalgaji+$request->penerimaantotal[$key];
                    array_push($penerimaan, $komponenpenerimaan->gaji_id);
                }

        $updategaji->slipgaji_komponenpenerimaan = serialize($penerimaan);
            }

            if($request->potonganname){
                foreach($request->potonganname as $key => $val){
                    $komponenpotongan = new KomponenGaji;
                    $komponenpotongan->gaji_slipid = $slipgaji->slipgaji_id;
                    $komponenpotongan->gaji_kodeunik = $slipgaji->slipgaji_kodeunik;
                    $komponenpotongan->gaji_typekomponen = 2;
                    $komponenpotongan->gaji_komponen = $val;
                    $komponenpotongan->gaji_jumlah = $request->potongantotal[$key];
                    $komponenpotongan->save();

                    $totalgaji = $totalgaji-$request->potongantotal[$key];
                    array_push($penerimaan, $komponenpotongan->gaji_id);
                }

        $updategaji->slipgaji_komponenpotongan = serialize($potongan);
            }

        $updategaji->slipgaji_thp = $totalgaji;
        $updategaji->update();


        toast('Slip Gaji Berhasil Diubah','success');
        return redirect('slipgaji');

        }else {
        alert()->warning('Komponen Penerimaan atau Potongan Kosong');

         return redirect()->back(); 
        }
    }

    public function delete($id)
    {
        $slipgaji = SlipGaji::where('slipgaji_id', $id)->first();

        try {
            $slipgaji->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Slip Gaji Berhasil Dihapus','success');


        return redirect('slipgaji');
    }

    public function pdf($id){
        $show = SlipGaji::join('karyawan','karyawan_id','=','slipgaji_karyawanid')
        ->join('users','id','=','slipgaji_userid')
        ->select('slipgaji.*','karyawan.*','users.name','users.id','users.email')
        ->where('slipgaji_id', $id)->first();
        $komponenpenerimaan = KomponenGaji::where('gaji_slipid', $show->slipgaji_id)
        ->where('gaji_typekomponen',1)->get();
        $komponenpotongan = KomponenGaji::where('gaji_slipid', $show->slipgaji_id)
        ->where('gaji_typekomponen',2)->get();
        $pdf = PDF::loadView('slipgaji.pdf', compact('show','komponenpenerimaan','komponenpotongan'));
        return $pdf->download('slipgaji-'.$show->karyawan_nama.$show->slipgaji_bulan.$show->slipgaji_tahun.'.pdf');
    }

    public function apideletepot(Request $request){
        try {
            $komponenpotongan = KomponenGaji::where('gaji_slipid', $request->gaji_idslip)
            ->where('gaji_id',$request->gaji_id)
            ->where('gaji_typekomponen',2)->first();
            $komponenpotongan->delete();
         } catch (QE $e) {
            return response()->json(['error'=>"Error occured when deleting product."]);
         } //show db error message
            return response()->json(['success'=>"Gaji Potongan Deleted Successfully."]);

    }

    public function apideletepen(Request $request){
        try {
            $komponenpenerimaan = KomponenGaji::where('gaji_slipid', $request->gaji_idslip)
            ->where('gaji_id',$request->gaji_id)
            ->where('gaji_typekomponen',1)->first();
            $komponenpenerimaan->delete();
         } catch (QE $e) {
            return response()->json(['error'=>"Error occured when deleting product."]);
         } //show db error message
            return response()->json(['success'=>"Gaji Deleted Successfully."]);

    }
}
