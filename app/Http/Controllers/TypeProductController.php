<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\TypeProduct;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use App\Imports\TypeImport;
use Maatwebsite\Excel\Facades\Excel;

class TypeProductController extends Controller
{
    public function index()
    {
        $type = TypeProduct::get();
        return view('typeproduct.index')->with(compact('type'));
    }

    public function create()
    {
        return view('typeproduct.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        TypeProduct::create($store->all());
        } catch (QE $e) {
            return $e;
        }
        notify()->success('Penambahan Tipe Berhasil');
        return redirect('type');
    }

    public function show($id)
    {
        $show = TypeProduct::where('type_id', $id)->first();

        return view('typeproduct.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = TypeProduct::where('type_id', $id)->first();

        return view('typeproduct.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $type = TypeProduct::where('type_id', $request->type_id)->first();
        $update = collect($request->all());
        try {
        $type->update($update->all());
        } catch (QE $e) {
            return $e;
        }
        notify()->success('Pengubahan Tipe Berhasil');
        return redirect('type');
    }

    public function delete($id)
    {
        $type = TypeProduct::where('type_id', $id)->first();

        try {
            $type->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Tipe telah sukses dihapus !');

        return redirect('type');
    }

    public function importdata(){
        return view('typeproduct.import');
    }

    public function importing(Request $request){
        if($request->file('type') != NULL) {
            Excel::import(new TypeImport, request()->file('type'));
        }else {
            toast('File kosong','error');
            return redirect('/type');
        }

        toast('Berhasil Menambah Warna','success');
        return redirect('/type');
    }

}
