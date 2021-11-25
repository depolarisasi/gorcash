<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Product;
use App\Models\Color;
use App\Models\TypeProduct;
use App\Models\BarcodeDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class BarcodeDBController extends Controller
{
    public function index()
    {
        $barcode = BarcodeDB::get();
        return view('barcode.index')->with(compact('barcode'));
    }

    public function create()
    {
        return view('barcode.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        BarcodeDB::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Warna Berhasil');
        return redirect('barcode');
    }

    public function show($id)
    {
        $show = BarcodeDB::where('barcode_id', $id)->first();

        return view('barcode.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = BarcodeDB::where('barcode_id', $id)->first();

        return view('barcode.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $barcode = BarcodeDB::where('barcode_id', $request->barcode_id)->first();
        $update = collect($request->all());
        try {
        $barcode->update($update->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Pengubahan Warna Berhasil');
        return redirect('barcode');
    }

    public function delete($id)
    {
        $barcode = BarcodeDB::where('barcode_id', $id)->first();

        try {
            $barcode->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Warna telah sukses dihapus !');

        return redirect('barcode');
    }

    public function getproductmastersku(Request $request){
        $mastersku = $request->get('mastersku');
        $selectedsku = BarcodeDB::where('barcode_mastersku', $mastersku)->first();
        if($selectedsku){
            return response()->json([
                'status'=>"Success",
                'product_nama'=> $selectedsku->barcode_productname,
                'product_type'=> $selectedsku->barcode_producttype,
                'product_color'=> $selectedsku->barcode_productband,
                'product_band'=>$selectedsku->barcode_productcolor,]);
        }else {
            return response()->json(['status' => "Failed"]);
        }

    }
}
