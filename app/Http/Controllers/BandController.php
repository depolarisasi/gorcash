<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Band;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;

class BandController extends Controller
{
    public function index()
    {
        $band = Band::get();
        return view('band.index')->with(compact('band'));
    }

    public function create()
    {
        return view('band.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Band::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Band Berhasil');
        return redirect('band');
    }

    public function show($id)
    {
        $show = Band::where('band_id', $id)->first();

        return view('band.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Band::where('band_id', $id)->first();

        return view('band.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $band = Band::where('band_id', $request->v)->first();
        $update = collect($request->all());
        try {
        $band->update($update->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Pengubahan Band Berhasil');
        return redirect('band');
    }

    public function delete($id)
    {
        $band = Band::where('band_id', $id)->first();

        try {
            $band->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Band telah sukses dihapus !');

        return redirect('band');
    }
}
