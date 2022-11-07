<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use PDF;


class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::get();
        return view('surat.index')->with(compact('surat'));
    }

    public function create()
    {
        return view('surat.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Surat::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Surat Berhasil Dibuat','success');
        return redirect('surat');
    }

    public function show($id)
    {
        $show = Surat::where('surat_id', $id)->first();

        return view('surat.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Surat::where('surat_id', $id)->first();

        return view('surat.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $size = Surat::where('surat_id', $request->surat_id)->first();
        $update = collect($request->all());
        try {
        $size->update($update->all());
        } catch (QE $e) {
            return $e;
        }
        toast('Surat Berhasil Diubah','success');
        return redirect('surat');
    }

    public function delete($id)
    {
        $size = Surat::where('surat_id', $id)->first();

        try {
            $size->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

    toast('Surat Berhasil Dihapus','success');

        return redirect('surat');
    }


}
