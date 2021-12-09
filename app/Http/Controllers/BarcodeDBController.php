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
use App\Imports\BarcodeImport;
use Maatwebsite\Excel\Facades\Excel;

class BarcodeDBController extends Controller
{
    public function index()
    {
        $barcode = BarcodeDB::join('band','band.band_id','=','barcode.barcode_productband')
        ->join('type','type.type_id','=','barcode.barcode_producttype')
        ->join('color','color.color_id','=','barcode.barcode_productcolor')
        ->select('barcode.*','type.type_id','color.color_id','band.band_id','band.band_nama','type.type_name','color.color_nama')
        ->get();


        return view('barcode.index')->with(compact('barcode'));
    }

    public function create()
    {
        $band = Band::get();
        $color = Color::get();
        $type = TypeProduct::get();
        return view('barcode.new')->with(compact('band','color','type'));
    }

    public function store(Request $request)
    {
        $barcode = BarcodeDB::where('barcode_id',$request->barcode_id)->first();
        if($barcode){
            toast('Master SKU sudah ada!','error');
            return redirect()->back();
        }else {
        $databand = Band::where('band_id',$request->barcode_productband)->first();
        $firstbandletter =  substr($databand->band_nama, 0, 1);
        $datatype = TypeProduct::where('type_id',$request->barcode_producttype)->first();
        $datacolor = Color::where('color_id',$request->barcode_productcolor)->first();
        $sericode = BarcodeDB::where('barcode_productband',$request->barcode_productband)->count();
        if($sericode < 10){
            if($sericode != 0) {
                $countseri = $sericode+1;
                $serivarian = "0".$countseri.$firstbandletter;
            }else {
            $countseri = 1;
            $serivarian = "0".$countseri.$firstbandletter;
            }
        }else {
            $countseri = $sericode+1;
            $serivarian = $countseri.$firstbandletter;
        }
        $mastersku = $databand->band_code.$datatype->type_code.$serivarian.$datacolor->color_code;
        $store = collect($request->all());
        $store->put('barcode_mastersku', $mastersku);
        $store->put('barcode_productseri', $serivarian);

        try {
            BarcodeDB::create($store->all());
            } catch (QE $e) {
                notify()->warning('Database Error');
                return redirect()->back();
            }
        }

        toast('Master SKU sudah ditambahkan!','success');
        return redirect('barcode');
    }

    public function show($id)
    {
        $show = BarcodeDB::join('band','band.band_id','=','barcode.barcode_productband')
        ->join('type','type.type_id','=','barcode.barcode_producttype')
        ->join('color','color.color_id','=','barcode.barcode_productcolor')
        ->select('barcode.*','type.type_id','type.type_category','color.color_id','band.band_id','band.band_nama','type.type_name','color.color_nama')
        ->where('barcode_id', $id)->first();

        return view('barcode.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = BarcodeDB::join('band','band.band_id','=','barcode.barcode_productband')
        ->join('type','type.type_id','=','barcode.barcode_producttype')
        ->join('color','color.color_id','=','barcode.barcode_productcolor')
        ->select('barcode.*','type.type_id','type.type_category','color.color_id','color.color_code','band.band_id','band.band_nama','type.type_name','color.color_nama')
        ->where('barcode_id', $id)->first();

        $band = Band::get();
        $color = Color::get();
        $type = TypeProduct::get();

        return view('barcode.edit')->with(compact('edit','band','color','type'));
    }

    public function update(Request $request)
    {
        $barcode = BarcodeDB::where('barcode_id', $request->barcode_id)->first();

        $databand = Band::where('band_id',$request->barcode_productband)->first();
        $firstbandletter =  substr($databand->band_nama, 0, 1);
        $datatype = TypeProduct::where('type_id',$request->barcode_producttype)->first();
        $datacolor = Color::where('color_id',$request->barcode_productcolor)->first();
        $sericode = BarcodeDB::where('barcode_productband',$request->barcode_productband)->count();
        if($sericode < 10){
            if($sericode != 0) {
                $countseri = $sericode+1;
                $serivarian = "0".$countseri.$firstbandletter;
            }else {
            $countseri = 1;
            $serivarian = "0".$countseri.$firstbandletter;
            }
        }
        $mastersku = $databand->band_code.$datatype->type_code.$serivarian.$datacolor->color_code;
        $store = collect($request->all());
        $store->put('barcode_mastersku', $mastersku);

        try {
            $barcode->update($store->all());
            $product = Product::where('product_mastersku', $mastersku)->get();
             foreach($product as $p){
                 $product->product_mastersku = $mastersku;
                 $product->product_color = $request->barcode_productcolor;
                 $product->product_typeid = $request->barcode_producttype;
                 $product->product_idband = $request->barcode_productband;
                 $product->product_sku = $mastersku.$product->product_idsize;
                 $product->update();

             }
            } catch (QE $e) {
                toast('Database Error!','error');
                return redirect()->back();
            }

        toast('Master SKU sudah diubah!','success');
        return redirect('barcode');
    }

    public function delete($id)
    {
        $barcode = BarcodeDB::where('barcode_id', $id)->first();
        $product = Product::where('product_mastersku',$barcode->mastersku)->get();
        foreach($product as $p){
            $p->delete();
        }

        try {
            $barcode->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Master SKU dan Produknya sudah dihapus!','success');
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
                'product_color'=> $selectedsku->barcode_productcolor,
                'product_band'=>$selectedsku->barcode_productband,]);
        }else {
            return response()->json(['status' => "Failed"]);
        }

    }

    public function apimassdelete(Request $request){

        $ids = $request->ids;
        BarcodeDB::whereIn('barcode_mastersku',$ids)->delete();
        return response()->json(['success'=>"Barcode Deleted successfully."]);

}

    public function importdata(){
        return view('barcode.import');
    }

    public function importing(Request $request){
        if($request->file('barcode') != NULL) {
            Excel::import(new BarcodeImport, request()->file('barcode'));
        }else {
            toast('File kosong','error');
            return redirect('/barcode');
        }

        toast('Berhasil Menambah Barcode','success');
        return redirect('/barcode');
    }

}
