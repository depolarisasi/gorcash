<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;

use App\Imports\VendorImport;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends Controller
{
    public function index()
    {
        $vendor = Vendor::get();
        return view('vendors.index')->with(compact('vendor'));
    }

    public function create()
    {
        return view('vendors.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Vendor::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Vendor Berhasil');
        return redirect('vendors');
    }

    public function show($id)
    {
        $show = Vendor::where('vendor_id', $id)->first();

        return view('vendors.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Vendor::where('vendor_id', $id)->first();

        return view('vendors.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $vendor = Vendor::where('vendor_id', $request->v)->first();
        $update = collect($request->all());
        try {
        $vendor->update($update->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Pengubahan Vendor Berhasil');
        return redirect('vendors');
    }

    public function delete($id)
    {
        $vendor = Vendor::where('vendor_id', $id)->first();

        try {
            $vendor->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Vendor telah sukses dihapus !');

        return redirect('vendors');
    }

    public function importdata(){
        return view('vendors.import');
    }

    public function importing(Request $request){
        if($request->file('vendors') != NULL) {
            Excel::import(new VendorImport, request()->file('vendors'));
        }else {
            toast('File kosong','error');
            return redirect('/vendors');
        }

        toast('Berhasil Menambah Warna','success');
        return redirect('/vendors');
    }

    
    public function apimassdelete(Request $request){

        $ids = $request->ids;
        Vendor::whereIn('vendor_nama',$ids)->delete();
        return response()->json(['success'=>"Vendor Deleted successfully."]);

}
}
