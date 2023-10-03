<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KategoriPengajuan;
use App\Models\PengajuanDana;

class PengajuanController extends Controller
{
    public function indexcatpengajuan()
    {
        $kategoripengajuan = KategoriPengajuan::orderBy('catpengajuan_id','ASC')->get();
        return view('kategoripengajuan.index')->with(compact('kategoripengajuan'));
    }

    public function createcatpengajuan()
    {
        return view('kategoripengajuan.new');
    }

    public function storecatpengajuan(Request $request)
    {
        $store = collect($request->all());
        try {
        KategoriPengajuan::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Berhasil Membuat Note Baru','success');
        return redirect('kategoripengajuan');
    }

    public function showcatpengajuan($id)
    {
        $show = KategoriPengajuan::where('catpengajuan_id', $id)->first();

        return view('kategoripengajuan.show')->with(compact('show'));
    }

    public function editcatpengajuan($id)
    {
        $edit = KategoriPengajuan::where('catpengajuan_id', $id)->first();

        return view('kategoripengajuan.edit')->with(compact('edit'));
    }

    public function updatecatpengajuan(Request $request)
    {
        $kategoripengajuan = KategoriPengajuan::where('catpengajuan_id', $request->catpengajuan_id)->first();
        $update = collect($request->all());
        try {
        $kategoripengajuan->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Kategori Pengajuan Berhasil','success');
        return redirect('kategoripengajuan');
    }

    public function deletecatpengajuan($id)
    {
        $kategoripengajuan = KategoriPengajuan::where('catpengajuan_id', $id)->first();

        try {
            $kategoripengajuan->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Note Berhasil Dihapus!','success');

        return redirect('kategoripengajuan');
    }

    public function indexpengajuan(Request $request)
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
        
        $tahun = PengajuanDana::select('pengajuandana_tahun as year')->groupBy('year')->get();

        $pengajuan = PengajuanDana::orderBy('pengajuandana_id','ASC')->get();
        return view('pengajuandana.index')->with(compact('pengajuan','tahun'));
    }

    public function createpengajuan()
    {
        
        $kategoripengajuan = KategoriPengajuan::get();
        return view('pengajuandana.new')->with(compact('kategoripengajuan'));
    }

    public function storepengajuan(Request $request)
    {
        $store = collect($request->all());
        try {
        PengajuanDana::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Berhasil Membuat Note Baru','success');
        return redirect('kategoripengajuan');
    }

    public function showpengajuan($id)
    {
        $show = PengajuanDana::where('pengajuandana_id', $id)->first();

        return view('pengajuandana.show')->with(compact('show'));
    }

    public function editpengajuan($id)
    {
        $edit = PengajuanDana::where('pengajuandana_id', $id)->first();

        return view('pengajuandana.edit')->with(compact('edit'));
    }

    public function updatepengajuan(Request $request)
    {
        $kategoripengajuan = PengajuanDana::where('pengajuandana_id', $request->pengajuandana_id)->first();
        $update = collect($request->all());
        try {
        $kategoripengajuan->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Kategori Pengajuan Berhasil','success');
        return redirect('kategoripengajuan');
    }

    public function deletepengajuan($id)
    {
        $kategoripengajuan = PengajuanDana::where('pengajuandana_id', $id)->first();

        try {
            $kategoripengajuan->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Note Berhasil Dihapus!','success');

        return redirect('kategoripengajuan');
    }
}
