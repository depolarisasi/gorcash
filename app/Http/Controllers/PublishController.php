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

    public function index()
    {
        $publish = BarangPublish::groupBy('publish_groupid')->get();
        foreach($publish as $key => $pub){
            $productcount = BarangPublish::where('publish_groupid',$pub->publish_groupid)->count();
            $publish[$key]['count'] = $productcount;
        }

        return view('publish.index')->with(compact('publish'));
    }

    public function apimasspublish(Request $request){

        $ids = explode(',',$request->ids);
        $rand = mt_rand(1,9999).$this->generateRandomString(5);
        $today = Carbon::now()->format('d-m-Y');
        $dateinput = Carbon::now()->format('Y-m-d');
        foreach($ids as $id){
            $product = Product::where('product_mastersku', $id)->get();
            foreach($product as $p){
                $publish = new BarangPublish;
                $publish->publish_productid = $p->product_id;
                $publish->publish_tanggal = $dateinput;
                $publish->publish_groupid = $rand;
                $publish->save();

                $product = Product::where('product_id',$id)->first();
                $product->product_status = 1;
                $product->product_status = $request->tanggalpublish;
                $product->update();
                $pubcount = PublishCounter::where('publishcount_pubid',$publish->publish_id)->first();
                if($pubcount){
                    $pubcount->publishcount_count = $pubcount->publishcount_count+1;
                    $pubcount->update();
                    $editpublish = BarangPublish::where('publish_id',$publish->publish_id)->first();
                    $editpublish->publish_name = "Publish tanggal ".$today." ke ".$pubcount->publishcount_count;
                    $editpublish->update();
                }else {
                $count = new PublishCounter;
                $count->publishcount_pubid = $publish->publish_id;
                $count->publishcount_count = 1;
                $count->save();
                $editpublish = BarangPublish::where('publish_id',$publish->publish_id)->first();
                $editpublish->publish_name = "Publish tanggal ".$today." ke ".$count->publishcount_count;
                $editpublish->update();
                }
            }
        }



        return response()->json([
        'success'=>"Successfully Published.",
        'groupname' => $rand
    ]);

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
        return redirect('publish');
    }

    public function show($id)
    {
        $publish = BarangPublish::join('product','product.product_id','publish.publish_productid')
        ->join('size','size.size_id','product.product_idsize')
        ->select('publish.*','product.product_id','product.product_nama','size.size_nama','product.product_mastersku','product.product_sku'
        ,'product.product_material'
        ,'product.product_tag'
        ,'product.product_madein'
        ,'product.product_condition')
        ->where('publish.publish_groupid',$id)->get();
        $infopub = BarangPublish::where('publish_groupid',$id)->first();

        return view('publish.detail')->with(compact('publish','infopub'));
    }

    public function edit($id)
    {
        $publish = BarangPublish::join('product','product.product_id','publish.publish_productid')
        ->join('size','size.size_id','product.product_idsize')
        ->select('publish.*','product.product_id','product.product_nama','size.size_nama','product.product_mastersku','product.product_sku'
        ,'product.product_material'
        ,'product.product_tag'
        ,'product.product_madein'
        ,'product.product_condition')
        ->where('publish.publish_groupid',$id)->get();

        return view('publish.edit')->with(compact('publish'));
    }

    public function update(Request $request)
    {
        foreach($request->product_id as $key => $pid){
            $product = Product::where('product_id',$pid)->first();
            $product->product_tag = $request->product_tag[$key];
            $product->product_material = $request->product_material[$key];
            $product->product_madein = $request->product_madein[$key];
            $product->product_condition = $request->product_condition[$key];

            try {

            $product->update();
                } catch (QE $e) {
                    notify()->warning('Database Error');
                    return redirect()->back();
                }
        }
        notify()->success('Publish Berhasil');
        return redirect('publish');
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

        return redirect('publish');
    }
}
