<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarangPublish;
use App\Models\PublishCounter;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class PublishController extends Controller
{
    public function generateRandomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function index(Request $request)
    {
        $tanggal = BarangPublish::distinct('publish_tanggal')->orderBy('publish_tanggal', 'DESC')->pluck('publish_tanggal');
        $publish = BarangPublish::groupBy('publish_groupid')->orderBy('publish_tanggal', 'DESC')->get();
        foreach($publish as $key => $pub){
            $productcount = BarangPublish::where('publish_groupid',$pub->publish_groupid)->count();
            $publish[$key]['count'] = $productcount;
        }
        return view('publish.index')->with(compact('publish','tanggal'));
    }

    public function apimasspublish(Request $request){

        $ids = $request->ids;
        $rand = mt_rand(1,9999).$this->generateRandomString(5);
        $today = Carbon::now()->format('d-m-Y');
        $weekofmonth = Carbon::now()->weekOfMonth;
        $todaydate = Carbon::now()->format('M Y');
        $dateinput = Carbon::now()->format('Y-m-d');
        foreach($ids as $id){
            $product = Product::where('product_mastersku', $id)->where('product_stok','>', 0)
            ->where(function($q) {
                $q->where('product_status', 0)
                  ->orWhere('product_status', NULL);
            })->get();
            foreach($product as $p){
                try {
                    $publish = new BarangPublish;
                    $publish->publish_name = " ";
                    $publish->publish_productid = $p->product_id;
                    $publish->publish_tanggal = $dateinput;
                    $publish->publish_groupid = $rand;
                    $publish->publish_stok = $p->product_stok;
                    $publish->publish_stokakhir = $p->product_stokakhir;
                    $publish->save();

                    $product = Product::where('product_id',$p->product_id)->first();
                    $product->product_status = 1;
                    $product->product_tanggalpublish = $dateinput;
                    $product->update();
                    } catch (QE $e) {
                        return $e;
                    } //show db error message

            }

        }

        return response()->json([
        'success'=>"Successfully Published.",
        'groupname' => $rand
    ]);

}

public function apimassunpublish(Request $request){

    $ids = $request->ids;
    $unpub = Product::whereIn('product_mastersku',$ids)->where('product_status', 1)->get();
    foreach($unpub as $u){
        $u->product_status = NULL;
        $u->product_tanggalpublish = NULL;
        try {
            $u->update();
             } catch (QE $e) {
           toast('Database error','error');
           return redirect()->back();
            }
    }
    return response()->json(['success'=>"Semua produk yang terpublish sudah di unpublish."]);

}

    public function show($id)
    {
        $publish = BarangPublish::join('product','product.product_id','publish.publish_productid')
        ->join('band','band.band_id','product.product_idband')
        ->join('size','size.size_id','product.product_idsize')
        ->select('publish.*','product.product_id','product.product_foto','band.band_nama','product.product_nama','size.size_nama','product.product_mastersku','product.product_sku'
        ,'product.product_material'
        ,'product.product_tag'
        ,'product.product_madein'
        ,'product.product_condition'
        ,'product.product_stok'
        ,'product.product_stokakhir')
        ->where('publish.publish_groupid',$id)
        ->orderBy('product.product_nama','ASC')->get();
        $infopub = BarangPublish::where('publish_groupid',$id)->first();

        return view('publish.detail')->with(compact('publish','infopub'));
    }

    public function edit($id)
    {
        $publish = BarangPublish::join('product','product.product_id','publish.publish_productid')
        ->join('size','size.size_id','product.product_idsize')
        ->join('band','band.band_id','product.product_idband')
        ->select('publish.*','product.product_id','product.product_foto','band.band_nama','product.product_nama','size.size_nama','product.product_mastersku','product.product_sku'
        ,'product.product_material'
        ,'product.product_tag'
        ,'product.product_madein'
        ,'product.product_condition'
        ,'product.product_stok'
        ,'product.product_stokakhir')
        ->where('publish.publish_groupid',$id)
        ->orderBy('product.product_nama','ASC')
        ->get();

        $infopub = BarangPublish::where('publish_groupid',$id)->first();

        return view('publish.edit')->with(compact('publish','infopub'));
    }

    public function update(Request $request)
    {
        $rand = mt_rand(1,9999).$this->generateRandomString(5);
        $today = Carbon::now()->format('d-m-Y');
        $dateinput = Carbon::now()->format('Y-m-d');
        $weekofmonth = Carbon::now()->weekOfMonth;
        $todaydate = Carbon::now()->format('M Y');

        // $arr = [];
        foreach($request->product_id as $key => $pid){
            $product = Product::where('product_id',$pid)->first();
            $product->product_tag = $request->product_tag[$key]??null;
            $product->product_material = $request->product_material[$key]??null;
            $product->product_madein = $request->product_madein[$key]??null;
            $product->product_condition = $request->product_condition[$key]??null;
            $product->product_tanggalpublish = $request->publish_tanggal;
            if($product->product_status == 1){
                $product->product_stok = $request->product_stok[$key];
                $product->product_stokakhir = $request->product_stokakhir[$key];
            }
            $editpublish = BarangPublish::where('publish_id',$request->publish_id[$key])->first();
            $editpublish->publish_stok = $request->product_stok[$key];
            $editpublish->publish_stokakhir = $request->product_stokakhir[$key];
            $editpublish->publish_name = $request->publish_name;
            $editpublish->publish_tanggal = $request->publish_tanggal;
            try {
                $product->update();
                $editpublish->update();
                    } catch (QE $e) {
                        toast('Database error','error');
                        return redirect()->back();
                    }
        }

         toast('Ubah Publish Berhasil','success');
        return redirect()->back();
        // return dd($request);
    }

    public function delete($groupid)
    {
        $publish = BarangPublish::where('publish_groupid', $groupid)->get();
        try {
        foreach($publish as $pid){
            $product = Product::where('product_id',$pid->publish_productid)->first();
            $product->product_status = 0;
            $product->product_tanggalpublish = null;
            $product->update();
            $pid->delete();
        }
        } catch (QE $e) {
            return $e;
        } //show db error message
        toast('Publish telah sukses dihapus dan Status berhasil diubah !','success');

        return redirect('publish');
    }
}
