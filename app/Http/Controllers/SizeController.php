<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Size;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;


class SizeController extends Controller
{
    public function index()
    {
        $size = Size::get();
        return view('size.index')->with(compact('size'));
    }

    public function create()
    {
        return view('size.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Size::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Size Berhasil');
        return redirect('size');
    }

    public function show($id)
    {
        $show = Size::where('size_id', $id)->first();

        return view('size.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Size::where('size_id', $id)->first();

        return view('size.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $size = Size::where('size_id', $request->size_id)->first();
        $update = collect($request->all());
        try {
        $size->update($update->all());
        } catch (QE $e) {
            return $e;
        }
        notify()->success('Pengubahan Size Berhasil');
        return redirect('size');
    }

    public function delete($id)
    {
        $size = Size::where('size_id', $id)->first();

        try {
            $size->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Size telah sukses dihapus !');

        return redirect('size');
    }
}
