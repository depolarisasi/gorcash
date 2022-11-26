<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Product;
use App\Models\Karyawan;
use App\Models\User;
use DB;
use \Carbon\Carbon;

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
        ->select('karyawan.karyawan_nama','absensi.*')
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
        $store = collect($request->all());
        try {
        Absensi::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Berhasil Membuat Riwayat Kirim Paket','success');
        return redirect('absensi');
    }


    public function edit($id)
    {
        $edit = Absensi::where('absensi_id', $id)->first();
        $user = User::get();

        return view('absensi.edit')->with(compact('edit','user'));
    }

    public function update(Request $request)
    {
        $absensi = Absensi::where('absensi_id', $request->absensi_id)->first();
        $update = collect($request->all());
        try {
        $absensi->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Status Kirim Paket Berhasil','success');
        return redirect('absensi');
    }


    public function delete($id)
    {
        $absensi = Absensi::where('absensi_id', $id)->first();

        try {
            $absensi->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Status Kirim Paket Berhasil Dihapus!','success');

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

}
