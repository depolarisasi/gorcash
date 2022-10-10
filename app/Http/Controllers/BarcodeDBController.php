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
use Auth;
use App\Models\Logs;
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
        ->orderBy('barcode.barcode_productname', 'ASC')
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
        $sericode = BarcodeDB::where('barcode_productband',$request->barcode_productband)->where('barcode_producttype',$request->barcode_producttype)->count();
        if($sericode < 9){
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
        $mastersku = $databand->band_code."XX".$datatype->type_code.$serivarian.$datacolor->color_code;
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
        $masterskulama = $barcode->barcode_mastersku;
        if($barcode->barcode_productband != $request->barcode_productband || $barcode->barcode_producttype != $request->barcode_producttype){
            $databand = Band::where('band_id',$request->barcode_productband)->first();
            $firstbandletter =  substr($databand->band_nama, 0, 1);
            $datatype = TypeProduct::where('type_id',$request->barcode_producttype)->first();
            $datacolor = Color::where('color_id',$request->barcode_productcolor)->first();
            $sericode = BarcodeDB::where('barcode_productband',$request->barcode_productband)->count();
            if($sericode < 9){
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

        }else {
            $databand = Band::where('band_id',$request->barcode_productband)->first();
            $firstbandletter =  substr($databand->band_nama, 0, 1);
            $datatype = TypeProduct::where('type_id',$request->barcode_producttype)->first();
            $datacolor = Color::where('color_id',$request->barcode_productcolor)->first();
            $sericode = $barcode->barcode_productseri;

            $mastersku = $databand->band_code.$datatype->type_code.$sericode.$datacolor->color_code;
        }

        $store = collect($request->all());
        $store->put('barcode_mastersku', $mastersku);

        try {
            $barcode->update($store->all());
            $product = Product::where('product_mastersku', $masterskulama)->get();
             foreach($product as $p){
                 $p->product_mastersku = $mastersku;
                 $p->product_color = $request->barcode_productcolor;
                 $p->product_nama = $request->barcode_productname;
                 $p->product_typeid = $request->barcode_producttype;
                 $p->product_idband = $request->barcode_productband;
                 $p->product_sku = $mastersku.$p->product_idsize;
                 $p->update();

             }
            } catch (QE $e) {
                toast('Database Error!','error');
                return $e;
            }
        Logs::create(['log_name' => 'Edit', 'log_msg' => "Edit Barcode ". $masterskulama." Menjadi ".$mastersku."Berhasil", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);

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
        Logs::create(['log_name' => 'Delete', 'log_msg' => "Barcode dihapus", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);
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
        Logs::create(['log_name' => 'Delete', 'log_msg' => "Barcode dihapus via Mass Delete", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);
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

        Logs::create(['log_name' => 'Import', 'log_msg' => "Import Berhasil", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);
        toast('Berhasil Menambah Barcode','success');
        return redirect('/barcode');
    }

}
