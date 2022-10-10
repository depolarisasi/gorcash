<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Band;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Color;
use App\Models\TypeProduct;
use App\Models\Logs;
use App\Models\BarcodeDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use App\Imports\BandImport;
use Maatwebsite\Excel\Facades\Excel;

class BandController extends Controller
{
    public function index()
    {
        $band = Band::orderBy('band_nama','ASC')->get();
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
        $band = Band::where('band_id', $request->band_id)->first();
        $barcode = BarcodeDB::where('barcode_productband',$request->band_id)->first();
        $update = collect($request->all());
        try {
            // if(!is_null($barcode)){
            //     $datatype = TypeProduct::where('type_id',$barcode->barcode_producttype)->first();
            //     $datacolor = Color::where('color_id',$barcode->barcode_productcolor)->first();
            //     $sericode = $barcode->barcode_productseri;
            //     $masterskubaru = $request->band_code.$datatype->type_code.$sericode.$datacolor->color_code;
            //     $barcode->barcode_mastersku = $masterskubaru;
            // }
        $band->update($update->all());
        $barcode->update();
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

    public function apimassdelete(Request $request){

        $ids = $request->ids;
        Band::whereIn('band_code',$ids)->delete();
        return response()->json(['success'=>"Bands Deleted successfully."]);

}

    public function importdata(){
        return view('band.import');
    }

    public function importing(Request $request){
        if($request->file('band') != NULL) {
            Excel::import(new BandImport, request()->file('band'));
        }else {
            toast('File kosong','error');
            return redirect('/band');
        }

        toast('Berhasil Menambah Band','success');
        return redirect('/band');
    }
}
