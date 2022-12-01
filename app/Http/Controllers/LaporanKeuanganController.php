<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\LaporanKeuangan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use PDF;
use DB;

class LaporanKeuanganController extends Controller
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

        $laporan = DB::table('laporankeuangan');
        if($selected_month != "All"){
            $laporan->where('laporankeuangan.laporankeuangan_bulan',$selected_month);
            }
            if($selected_year != "All"){
            $laporan->where('laporankeuangan.laporankeuangan_tahun',$selected_year);
            }

           $laporan = $laporan->get();


        return view('laporankeuangan.index')->with(compact('laporan'));
    }

    public function create()
    {
        return view('laporankeuangan.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        LaporanKeuangan::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Laporan Keuangan Berhasil Dibuat','success');
        return redirect('laporankeuangan');
    }

    public function show($id)
    {
        $show = LaporanKeuangan::where('laporankeuangan_id', $id)->first();

        return view('laporankeuangan.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = LaporanKeuangan::where('laporankeuangan_id', $id)->first();

        return view('laporankeuangan.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $size = LaporanKeuangan::where('laporankeuangan_id', $request->laporankeuangan_id)->first();
        $update = collect($request->all());
        try {
        $size->update($update->all());
        } catch (QE $e) {
            return $e;
        }
        toast('Laporan Keuangan Berhasil Diubah','success');
        return redirect('laporankeuangan');
    }

    public function delete($id)
    {
        $size = LaporanKeuangan::where('laporankeuangan_id', $id)->first();

        try {
            $size->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

    toast('Laporan Keuangan Berhasil Dihapus','success');

        return redirect('laporankeuangan');
    }

}
