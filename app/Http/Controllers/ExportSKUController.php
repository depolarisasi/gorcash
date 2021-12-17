<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Product;
use App\Models\ExportSKU;
use App\Models\Color;
use App\Models\TypeProduct;
use App\Models\BarcodeDB;
use App\Models\BarangTerjual;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Collection;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


class ExportSKUController extends Controller
{

    public function generateRandomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }


    public function index(){

        $exportsku = ExportSKU::groupBy('exportsku_groupid')->get();
        foreach($exportsku as $key => $pub){
            $productcount = ExportSKU::where('exportsku_groupid',$pub->exportsku_groupid)->count();
            $exportsku[$key]['count'] = $productcount;
        }
        return view('exportsku.index')->with(compact('exportsku'));
    }

    public function exportskuapi(Request $request){
        $ids = $request->ids;
        $rand = mt_rand(1,9999).$this->generateRandomString(5);
        $dateinput = Carbon::now()->format('Y-m-d');
        $product = Product::whereIn('product_mastersku', $request->ids)->get();
        foreach($product as $p){
            $export = new ExportSKU;
            $export->exportsku_productsku = $p->product_sku;
            $export->exportsku_tanggal = $dateinput;
            $export->exportsku_groupid = $rand;
            $export->save();

            }

        return response()->json([
        'success'=>"Successfully Published.",
        'groupname' => $rand
    ]);
    }

    public function show($id)
    {
        $export = ExportSKU::join('product','product.product_sku','exportsku.exportsku_productsku')
        ->join('band','band.band_id','product.product_idband')
        ->join('size','size.size_id','product.product_idsize')
        ->select('exportsku.*','band.band_nama','size.size_nama','product.*')
        ->where('exportsku.exportsku_groupid',$id)->get();
        $detail = ExportSKU::where('exportsku_groupid',$id)->first();

        return view('exportsku.detail')->with(compact('export','detail'));
    }

    public function edit($id)
    {
        $export = ExportSKU::join('product','product.product_sku','exportsku.exportsku_productsku')
        ->join('band','band.band_id','product.product_idband')
        ->join('size','size.size_id','product.product_idsize')
        ->select('exportsku.*','band.band_nama','size.size_nama','product.*')
        ->where('exportsku.exportsku_groupid',$id)->get();
        $detail = ExportSKU::where('exportsku_groupid',$id)->first();

        return view('exportsku.edit')->with(compact('export','detail'));
    }

    public function update(Request $request){
        $update = collect($request->all());
        $export = ExportSKU::where('exportsku_id',$request->exportid)->get();
        try {
            foreach($export as $x){
                $x->update($update->all());
            }
            } catch (QE $e) {
                toast('Database Error','error');
                return $e;
            }

            toast('Pengubahan Export Berhasil','success');
            return redirect()->back();
    }

    public function deleteproduct(Request $request){
        $produk = ExportSKU::where('exportsku_productsku', $request->get('sku'))
        ->where('exportsku_groupid',$request->get('id'))->first();

        try {
             $produk->delete();
        } catch (QE $e) {
        toast('Database error','error');
        return redirect('produk');
        } //show db error message

        toast('Berhasil Menghapus Produk','success');

        return redirect()->back();
    }

    public function deleteexport($id){
        $export = ExportSKU::where('exportsku_groupid', $id)->get();

        try {
            foreach($export as $ex){
                $ex->delete();
            }
        } catch (QE $e) {
        toast('Database error','error');
        return $e;
        } //show db error message

        toast('Berhasil Menghapus Export','success');

        return redirect()->back();
    }

    public function apimassdelete(Request $request){

        $ids = $request->ids;
        ExportSKU::whereIn('exportsku_productsku',$ids)->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);

}
}
