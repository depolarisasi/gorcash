<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Product;
use App\Models\Karyawan;
use App\Models\User;
use DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;  
use Carbon\CarbonPeriod; 
use Illuminate\Support\Str;
use PDF;
class AbsensiController extends Controller
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

        $selected_month =  $bulan == "All"? Carbon::now()->format('m'):$bulan;
        $selected_year =  $tahun == "All"? Carbon::now()->format('Y'):$tahun;

        $absensi = Absensi::join('karyawan','karyawan_id','=','absensi_karyawanid')
        ->select(array('absensi.*','karyawan.*',
        DB::raw('COUNT(absensi.absensi_type) as harikerja'),
        DB::raw('SUM(CASE WHEN absensi.absensi_type != 1 THEN 1 ELSE 0 END) tidakhadir'),
        DB::raw('MONTH(absensi.absensi_tanggal) as month'),
        DB::raw('YEAR(absensi.absensi_tanggal) as year')))
        ->whereRaw('MONTH(absensi.absensi_tanggal) = '.$selected_month)
        ->groupBy('absensi.absensi_karyawanid')
        ->get();
        $karyawan = Karyawan::get();
        return view('absensi.index')->with(compact('absensi','selected_month','selected_year','tahun','bulan','karyawan'));
    }

    public function create(Request $request)
    {
        $karyawan = Karyawan::get();
        if($request->get('absensi_karyawanid') != NULL || !empty($request->get('absensi_karyawanid'))){
        $selected_karyawan = Karyawan::where('karyawan_id',$request->absensi_karyawanid)->first();
        }else {
            $selected_karyawan = Null;
        }

        return view('absensi.new')->with(compact('karyawan','selected_karyawan'));
    }


    public function store(Request $request)
    {
        foreach($request->index as $key => $key){
            $absensi = new Absensi;
            $absensi->absensi_karyawanid = $request->absensi_karyawanid;
            $absensi->absensi_tanggal = $request->absensi_tanggal[$key]??null;
            $absensi->absensi_jammasuk = $request->absensi_jammasuk[$key]??null;
            $absensi->absensi_jampulang = $request->absensi_jampulang[$key]??null;
            $absensi->absensi_lembur = $request->absensi_lembur[$key]??null;
            $absensi->absensi_lamakerja = $request->absensi_lamakerja[$key]??null;
            $absensi->absensi_type = $request->absensi_type[$key]??null;
            $absensi->absensi_keterangan = $request->absensi_keterangan[$key]??null;
            try {
                $absensi->save();
                    } catch (QE $e) {
                        toast('Database error','error');
                        return $e;
                    }
        }


        toast('Berhasil Membuat Riwayat Absensi','success');
        return redirect('absensi');
    }


    public function edit(Request $request)
    {
        $edit = Absensi::join('karyawan','karyawan_id','=','absensi_karyawanid')
        ->select(array('absensi.*','karyawan.*', 
        DB::raw('MONTH(absensi.absensi_tanggal) as month'),
        DB::raw('YEAR(absensi.absensi_tanggal) as year')))
        ->whereRaw('MONTH(absensi.absensi_tanggal) = '.$request->get('bulan')) 
        ->whereRaw('YEAR(absensi.absensi_tanggal) = '.$request->get('tahun')) 
        ->whereRaw('absensi.absensi_karyawanid = '.$request->get('karyawan')) 
        ->get();
        $selected_karyawan = Karyawan::where('karyawan_id',$request->get('karyawan'))->first();

        return view('absensi.edit')->with(compact('edit','selected_karyawan'));
    }

    public function show(Request $request)
    {
        $show = Absensi::join('karyawan','karyawan_id','=','absensi_karyawanid')
        ->select(array('absensi.*','karyawan.*', 
        DB::raw('MONTH(absensi.absensi_tanggal) as month'),
        DB::raw('YEAR(absensi.absensi_tanggal) as year')))
        ->whereRaw('MONTH(absensi.absensi_tanggal) = '.$request->get('bulan')) 
        ->whereRaw('YEAR(absensi.absensi_tanggal) = '.$request->get('tahun')) 
        ->whereRaw('absensi.absensi_karyawanid = '.$request->get('karyawan')) 
        ->get();

        $selected_karyawan = Karyawan::where('karyawan_id',$request->get('karyawan'))->first();
 

        return view('absensi.show')->with(compact('show','selected_karyawan'));
    }

    public function update(Request $request)
    {
        foreach($request->index as $key => $val){
            $absensi = Absensi::where('absensi_id',$request->id[$key])->first(); 
            $absensi->absensi_karyawanid = $request->absensi_karyawanid;
            $absensi->absensi_tanggal = $request->absensi_tanggal[$key]??null;
            $absensi->absensi_jammasuk = $request->absensi_jammasuk[$key]??null;
            $absensi->absensi_jampulang = $request->absensi_jampulang[$key]??null;
            $absensi->absensi_lembur = $request->absensi_lembur[$key]??null;
            $absensi->absensi_lamakerja = $request->absensi_lamakerja[$key]??null;
            $absensi->absensi_type = $request->absensi_type[$key]??null;
            $absensi->absensi_keterangan = $request->absensi_keterangan[$key]??null;
            try {
                $absensi->update();
                    } catch (QE $e) {
                        toast('Database error','error');
                        return $e;
                    }
        }


        toast('Berhasil Membuat Riwayat Absensi','success');
        return redirect('absensi');
        // return $request->all();
    }


    public function delete(Request $request)
    {
        $absensi = Absensi::whereRaw('MONTH(absensi_tanggal) ='.$request->get('bulan'))
        ->whereRaw('YEAR(absensi_tanggal) ='.$request->get('tahun'))
        ->where('absensi_karyawanid',$request->get('karyawan'))
        ->get();
foreach($absensi as $abs){
    try {
        $abs->delete();
    } catch (QE $e) {
        return $e;
    } //show db error message
}
        toast('Status Absensi Berhasil Dihapus!','success');

        return redirect('absensi');
    }

    public function laporan(Request $request){
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

        $selected_month =  $bulan == "All"? Carbon::now()->format('m'):$bulan;
        $selected_year =  $tahun == "All"? Carbon::now()->format('Y'):$tahun;

        $data = DB::table('absensi')
        ->join('users','id','=','absensi_user')
        ->select('absensi.absensi_user','users.name', DB::raw('sum(absensi.absensi_jumlahpaket) as totalpaket'))
        ->whereMonth('absensi_tanggal', $selected_month)
        ->whereYear('absensi_tanggal', $selected_year)
        ->groupBy('absensi_user')
        ->get();
        $tahun = Absensi::select(DB::Raw('YEAR(absensi_tanggal) as year'))->groupBy('year')->get();
        return view('absensi.laporan')->with(compact('data', 'tahun'));
        // return $selected_year;
    }

    public function pdf(Request $request){
        
       
        $show = Absensi::join('karyawan','karyawan_id','=','absensi_karyawanid')
        ->select(array('absensi.*','karyawan.*', 
        DB::raw('MONTH(absensi.absensi_tanggal) as month'),
        DB::raw('YEAR(absensi.absensi_tanggal) as year')))
        ->whereRaw('MONTH(absensi.absensi_tanggal) = '.$request->get('bulan')) 
        ->whereRaw('YEAR(absensi.absensi_tanggal) = '.$request->get('tahun')) 
        ->whereRaw('absensi.absensi_karyawanid = '.$request->get('karyawan')) 
        ->get();

        $selected_karyawan = Karyawan::where('karyawan_id',$request->get('karyawan'))->first();

        $pdf = PDF::loadView('absensi.pdf', compact('show','selected_karyawan'));
        return $pdf->download('absensi-'.$selected_karyawan->karyawan_nama.$request->get('bulan').$request->get('tahun').'.pdf');
    }

}
