<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Informasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::orderBy('informasi_id','ASC')->get();
        return view('informasi.index')->with(compact('informasi'));
    }

    public function create()
    {
        return view('informasi.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Informasi::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Berhasil Membuat Note Baru','success');
        return redirect('informasi');
    }

    public function show($id)
    {
        $show = Informasi::where('informasi_id', $id)->first();

        return view('informasi.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Informasi::where('informasi_id', $id)->first();

        return view('informasi.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $informasi = Informasi::where('informasi_id', $request->informasi_id)->first();
        $update = collect($request->all());
        try {
        $informasi->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Note Berhasil','success');
        return redirect('informasi');
    }

    public function delete($id)
    {
        $informasi = Informasi::where('informasi_id', $id)->first();

        try {
            $informasi->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Note Berhasil Dihapus!','success');

        return redirect('informasi');
    }
}
