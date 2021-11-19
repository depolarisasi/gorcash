<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Product;
use App\Models\Color;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $produk = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->groupBy('product.product_mastersku')
        ->get();

        foreach($produk as $key => $p){
            $vendorid = explode(',',$p->product_vendor);
            $arr = array();
            foreach($vendorid as $p){
                $name = Vendor::where('vendor_id',$p)->first();
                array_push($arr, $name->vendor_nama);
            }
            $vendorname = implode(', ', $arr);
            $produk[$key]['product_vendor'] =  $vendorname;
        }

        $vendor = Vendor::get();
        $size = Size::get();
        $color = Color::get();
        $band = Band::get();
        return view('produks.index')->with(compact('produk','vendor','size','band','color'));
    }

    public function create()
    {
        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::get();
        $color = Color::get();
        return view('produks.new')->with(compact('vendor','size','band','color'));
    }

    public function store(Request $request)
    {

        $size = [1 => "S",2 => "M",3 => "L",4 => "XL", 5 => "2XL"];
        foreach($size as $key => $s){
        $skuvariant = $request->product_mastersku.$key;
        $checksku = Product::where('product_sku',$skuvariant)->first();
        if($checksku == null){
                $store = collect($request->all());
                $store->put('product_sku', $skuvariant);
                if ($request->file('product_foto') == '') {
                    $fileurl = '';
            } else {
                $file = $request->file('product_foto');
                $fileArray = ['product_foto' => $file];
                $rules = ['product_foto' => 'mimes:jpeg,jpg,png,gif|required|max:100000'];
                $validator = Validator::make($fileArray, $rules);
                if ($validator->fails()) {
                    // Redirect or return json to frontend with a helpful message to inform the user
                    // that the provided file was not an adequate type
                    Alert::error('Error', 'File yang diupload bukanlah gambar!');
                    return redirect()->back();
                } else {
                    $img_id = mt_rand(1, 10000);
                    $fileName = $img_id.time().'.'.$file->getClientOriginalName();
                    Image::make($file)->encode('jpg', 90)->save('product/'.$fileName);
                    $fileurl = 'product/'.$fileName;
                }
            }
            if($request->product_idsize == $key){
            $store->put('product_stok', $request->product_stok);
            $store->put('product_stokakhir', $request->product_stok);
            }else {
            $store->put('product_idsize', $key);
            $store->put('product_stok', 0);
            $store->put('product_stokakhir', 0);
            }
            $store->put('product_foto', $fileurl);
            $vendor = implode(',',$request->product_vendor);
            $store->put('product_vendor', $vendor);

            try {
                Product::create($store->all());
                } catch (QE $e) {
                    Alert::error('Error', 'Database Error!');
                    return redirect()->back();
                }
         }
        }

        Alert::success('Success', 'Berhasil Menambahkan Produk & Variasi');
        return redirect('produk');
    }

    public function show($id)
    {
        $show = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product.product_id', $id)->first();

        return view('produks.show')->with(compact('show'));
    }

    public function edit($id)
    {

        $edit = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product.product_id', $id)->first();
            $vendorid = explode(',',$edit->product_vendor);
            $arr = array();
            foreach($vendorid as $p){
                $name = Vendor::where('vendor_id',$p)->first();
               $arr[$p] = $name->vendor_nama;
            }

            $edit['product_vendor'] =  $arr;

        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::get();
        return view('produks.edit')->with(compact('edit','vendor','size','band'));
    }

    public function update(Request $request)
    {
        $produk = Product::where('product_id', $request->v)->first();
        $update = collect($request->all());


        if ($request->file('product_foto') == '') {
            $fileurl = $produk->product_foto;
    } else {
        $file = $request->file('product_foto');
        $fileArray = ['files' => $file];
        $rules = ['files' => 'mimes:jpeg,jpg,png,gif|required|max:100000'];
        $validator = Validator::make($fileArray, $rules);
        if ($validator->fails()) {
            // Redirect or return json to frontend with a helpful message to inform the user
            // that the provided file was not an adequate type
        notify()->error('File yang diupload bukanlah gambar !');
            return redirect()->back();
        } else {
            $img_id = mt_rand(1, 10000);
            $fileName = $img_id.time().'.'.$file->getClientOriginalName();
            Image::make($file)->encode('jpg', 90)->save('product/'.$fileName);
            $fileurl = 'product/'.$fileName;
        }
    }

    $update->put('product_foto', $fileurl);


        try {
        $produk->update($update->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Pengubahan Size Berhasil');
        return redirect('produk');
    }

    public function delete($id)
    {
        $produk = Product::where('product_id', $id)->first();

        try {
            $produk->delete();
        } catch (QE $e) {

        toast('Berhasil Menghapus Produk','error');
        } //show db error message

        toast('Berhasil Menghapus Produk','success');

        return redirect('produk');
    }

    public function getproduct(Request $request){
        $produk = Product::join('vendor','vendor.vendor_id','=','product.product_idvendor',)
        ->join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','vendor.vendor_id','vendor.vendor_nama','band.band_id','band.band_nama')
        ->where('product.product_id',$request->productid)
        ->first();
        return $produk->toArray();
    }
}
