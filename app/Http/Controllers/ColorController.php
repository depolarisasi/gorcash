<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Color;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use App\Imports\ColorImport;
use Maatwebsite\Excel\Facades\Excel;

class ColorController extends Controller
{
    public function index()
    {
        $color = Color::get();
        return view('color.index')->with(compact('color'));
    }

    public function create()
    {
        return view('color.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Color::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Warna Berhasil');
        return redirect('color');
    }

    public function show($id)
    {
        $show = Color::where('color_id', $id)->first();

        return view('color.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Color::where('color_id', $id)->first();

        return view('color.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $color = Color::where('color_id', $request->color_id)->first();
        $update = collect($request->all());
        try {
        $color->update($update->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Pengubahan Warna Berhasil');
        return redirect('color');
    }

    public function delete($id)
    {
        $color = Color::where('color_id', $id)->first();

        try {
            $color->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Warna telah sukses dihapus !');

        return redirect('color');
    }

    public function importdata(){
        return view('color.import');
    }

    public function importing(Request $request){
        if($request->file('color') != NULL) {
            Excel::import(new ColorImport, request()->file('color'));
        }else {
            toast('File kosong','error');
            return redirect('/color');
        }

        toast('Berhasil Menambah Warna','success');
        return redirect('/color');
    }

    public function apimassdelete(Request $request){

        $ids = $request->ids;
        Color::whereIn('color_code',$ids)->delete();
        return response()->json(['success'=>"colors Deleted successfully."]);

}

}
