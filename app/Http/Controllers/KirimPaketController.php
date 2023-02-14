<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KirimPaket;
use App\Models\Product;
use App\Models\User;
use DB;
use \Carbon\Carbon;

class KirimPaketController extends Controller
{

    public function index()
    {
        $kirimpaket = KirimPaket::join('users','id','=','kirimpaket_user')
        ->select('users.name','kirimpaket.*')
        ->get();
        return view('kirimpaket.index')->with(compact('kirimpaket'));
    }


    public function store(Request $request)
    {
        $store = collect($request->all());
        $paket = KirimPaket::where('kirimpaket_tanggal',Carbon::now()->format('Y-m-d'))->first();
        if($paket){
            if($paket->kirimpaket_waktupengiriman == $request->kirimpaket_waktupengiriman && $paket->kirimpaket_tanggal == Carbon::now()->format('Y-m-d')){

                toast('Pengiriman '.$request->kirimpaket_waktupengiriman.' telah dilakukan di hari ini ('.Carbon::parse($paket->kirimpaket_tanggal)->format('d-m-Y').')','error');
                return redirect()->back();
            }
        }

            else {
                try {
                    KirimPaket::create($store->all());
                    } catch (QE $e) {
                        toast('Database Error','error');
                        return redirect()->back();
                    }
            }

        toast('Berhasil Membuat Riwayat Kirim Paket','success');
        return redirect('kirimpaket');
    }


    public function edit($id)
    {
        $edit = KirimPaket::where('kirimpaket_id', $id)->first();
        $user = User::get();

        return view('kirimpaket.edit')->with(compact('edit','user'));
    }

    public function update(Request $request)
    {
        $kirimpaket = KirimPaket::where('kirimpaket_id', $request->kirimpaket_id)->first();
        $update = collect($request->all());
        try {
        $kirimpaket->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Status Kirim Paket Berhasil','success');
        return redirect('kirimpaket');
    }


    public function delete($id)
    {
        $kirimpaket = KirimPaket::where('kirimpaket_id', $id)->first();

        try {
            $kirimpaket->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Status Kirim Paket Berhasil Dihapus!','success');

        return redirect('kirimpaket');
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

        $data = KirimPaket::join('users','id','=','kirimpaket_user')
        ->select(array('kirimpaket.kirimpaket_user','kirimpaket.created_at','users.name', DB::Raw('COUNT(*) as totalpengiriman')))
        ->whereRaw('MONTH(kirimpaket.created_at) = '. $selected_month.' AND YEAR(kirimpaket.created_at) = '. $selected_year )
        ->groupBy('kirimpaket.kirimpaket_user')
        ->get();
        $tahun = KirimPaket::select(DB::Raw('YEAR(kirimpaket_tanggal) as year'))->groupBy('year')->get();
        return view('kirimpaket.laporan')->with(compact('data', 'tahun'));
    }

}
