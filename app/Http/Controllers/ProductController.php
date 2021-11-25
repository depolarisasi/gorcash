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

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    public function generateMasterSKU($band, $type, $nama, $color){
        $databand = Band::where('band_id',$band)->first();
        $firstbandletter =  substr($databand->band_nama, 0, 1);
        $datatype = TypeProduct::where('type_id',$type)->first();
        $datacolor = Color::where('color_id',$color)->first();
        $sericode = BarcodeDB::where('barcode_productband',$band)->count();
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
        return ["sku" => $mastersku, "seri" => $serivarian];
    }

    public function checkBarcodeMaster($mastersku){
        $master = BarcodeDB::where('barcode_mastersku',$mastersku)->first();
        if($master){
            return true;
        }else {
            return false;
        }
    }

    public function uploadImage($image){
        if ($image == '') {
            $fileurl = '';
    } else {
        $file = $image;
        $fileArray = ['product_foto' => $file];
        $rules = ['product_foto' => 'mimes:jpeg,jpg,png,gif|required|max:100000'];
        $validator = Validator::make($fileArray, $rules);
        if ($validator->fails()) {
            // Redirect or return json to frontend with a helpful message to inform the user
            // that the provided file was not an adFile bukan gambar

         toast('File bukanlah gambar','error');
            return redirect()->back();
        } else {
            $img_id = mt_rand(1, 10000);
            $fileName = $img_id.time().'.'.$file->getClientOriginalName();
            Image::make($file)->encode('jpg', 90)->save('product/'.$fileName);
            $fileurl = 'product/'.$fileName;
        }
    }
    return $fileurl;
    }

    public function index()
    {
        $produk = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->groupBy('product.product_mastersku')
        ->get();

        foreach($produk as $key => $p){
            $variant = Product::join('size','size.size_id','=','product.product_idsize')
            ->select('product.*','size.size_id','size.size_nama')
            ->where('product.product_mastersku',$p->product_mastersku)
            ->where('product.product_stokakhir', '>', 0)->get();
            $vendorid = explode(',',$p->product_vendor);
            $arr = array();
            $arr2 = array();
            foreach($vendorid as $p){
                $name = Vendor::where('vendor_id',$p)->first();
                array_push($arr, $name->vendor_nama);
            }
            foreach($variant as $v){
                $size = $v->size_nama;
                array_push($arr2, $size);
            }
            $vendorname = implode(', ', $arr);
            $variantavailable = implode(', ', $arr2);
            $produk[$key]['product_vendor'] =  $vendorname;
            $produk[$key]['product_idsize'] =   $variantavailable;
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
        $type = TypeProduct::get();
        $barcode = BarcodeDB::get();
        return view('produks.new')->with(compact('vendor','size','band','color','type','barcode'));
    }

    public function store(Request $request)
    {
        $masterskus = $request->product_mastersku;
        if($masterskus != "NEW") {
                $size = $request->product_idsize;
                $skuvariant = $masterskus.$size;
                $checksku = Product::where('product_sku',$skuvariant)->first();
                $masterdata = BarcodeDB::where('barcode_mastersku', $masterskus)->first();
                if($masterdata && $masterdata->barcode_productname == $request->product_nama){
                    if($checksku == null){
                            $store = collect($request->all());
                            $store->put('product_mastersku', $masterskus);
                            $store->put('product_idsize', $request->product_idsize);
                            $store->put('product_idband', $masterdata->barcode_productband);
                            $store->put('product_typeid', $masterdata->barcode_producttype);
                            $store->put('product_color', $masterdata->barcode_productcolor);
                            $store->put('product_sku', $skuvariant);
                            $store->put('product_stok', $request->product_stok);
                            $store->put('product_stokakhir', $request->product_stok);
                            $store->put('product_foto', $this->uploadImage($request->file('product_foto')));
                            $vendor = implode(',',$request->product_vendor);
                            $store->put('product_vendor', $vendor);
                            $store->put('product_productlama', $request->product_productlama);
                        if($request->product_tanggalpublish == NULL){
                            $status = 0;
                        }else {
                            $status = 1;
                        }
                        $store->put('product_status', $status);

                        try {
                            Product::create($store->all());
                            } catch (QE $e) {

                    toast('Database error','error');
                                return redirect()->back();
                            }
                    }else {
                        toast('Produk Sudah Ada!','error');
                        return redirect()->back();
                    }
                }else {
                    toast('Nama Desain di Database Barcode berbeda dengan Nama Produk, Produk Berbeda?','error');
                    return redirect()->back();
                }
        }else {
            $masterdata = new BarcodeDB;
            $masterdata->barcode_productband = $request->product_idband;
            $masterdata->barcode_producttype = $request->product_typeid;
            $masterdata->barcode_productcolor = $request->product_color;
            $masterdata->barcode_productname = $request->product_nama;
            $newbarcode = $this->generateMasterSKU($request->product_idband,$request->product_typeid,$request->product_nama,$request->product_color);
            $masterdata->barcode_mastersku = $newbarcode["sku"];
            $masterdata->barcode_productseri = $newbarcode["seri"];
            $masterdata->save();
            $skuvariant = $newbarcode["sku"].$request->product_idsize;
            $store = collect($request->all());
            $store->put('product_mastersku', $newbarcode["sku"]);
            $store->put('product_sku', $skuvariant);
            $store->put('product_idband', $masterdata->barcode_productband);
            $store->put('product_typeid', $masterdata->barcode_producttype);
            $store->put('product_color', $masterdata->barcode_productcolor);
            $store->put('product_stok', $request->product_stok);
            $store->put('product_stokakhir', $request->product_stok);
            $store->put('product_foto', $this->uploadImage($request->file('product_foto')));
            $vendor = implode(',',$request->product_vendor);
            $store->put('product_vendor', $vendor);
            $store->put('product_productlama', $request->product_productlama);
            if($request->product_tanggalpublish == NULL){
                $status = 0;
            }else {
                $status = 1;
            }
            $store->put('product_status', $status);

            try {
                Product::create($store->all());
                } catch (QE $e) {

        toast('Database error','error');
                    return redirect()->back();
                }
        }

        toast('Berhasil Menambahkan Produk dan Variasi','success');
        return redirect('produk');
    }

    public function show($id)
    {
        $show = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product.product_id', $id)->first();

        $vendorid = explode(',',$show->product_vendor);
        $arr = array();
        foreach($vendorid as $v){
            $name = Vendor::where('vendor_id',$v)->first();
            array_push($arr, $name->vendor_nama);
        }
        $vendorname = implode(', ', $arr);
        $show['product_vendor'] =  $vendorname;


        return view('produks.show')->with(compact('show'));
    }


    public function editselect($mastersku)
    {

        $produk = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product.product_mastersku', $mastersku)
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
        return view('produks.select')->with(compact('produk','vendor','size','band','color'));
    }


    public function edit($id)
    {

        $edit = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->join('color','color.color_id','=','product.product_color')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama','color.color_id','color.color_nama','color.color_code')
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
        $color = Color::get();
        return view('produks.edit')->with(compact('edit','vendor','size','band','color'));
    }

    public function update(Request $request)
    {
        $produk = Product::where('product_id', $request->product_id)->first();
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
                   toast('File bukan gambar','error');
            return redirect()->back();
        } else {
            $img_id = mt_rand(1, 10000);
            $fileName = $img_id.time().'.'.$file->getClientOriginalName();
            Image::make($file)->encode('jpg', 90)->save('product/'.$fileName);
            $fileurl = 'product/'.$fileName;
        }
    }

    $update->put('product_foto', $fileurl);

    $vendor = implode(',',$request->product_vendor);
    $update->put('product_vendor', $vendor);


    if($request->product_tanggalpublish == NULL){
        $status = 0;
    }else {
        $status = 1;
    }
    $update->put('product_status', $status);


        try {
        $produk->update($update->all());
        } catch (QE $e) {

        toast('Database error','error');
            return redirect()->back();
        }

        toast('Berhasil Mengubah Produk','success');
        return redirect('produk');
    }

    public function delete($id)
    {
        $produk = Product::where('product_mastersku', $id)->get();

        try {
            foreach($produk as $p){
                $p->delete();
            }
        } catch (QE $e) {
        toast('Database error','error');
        return redirect('produk');
        } //show db error message

        toast('Berhasil Menghapus Produk','success');

        return redirect('produk');
    }

    public function getproduct(Request $request){
        $produk = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product.product_id',$request->productid)
        ->first();
        return $produk->toArray();
    }

    public function apimassdelete(Request $request){

            $ids = $request->ids;
            Product::whereIn('product_mastersku',explode(",",$ids))->delete();
            return response()->json(['success'=>"Products Deleted successfully."]);

    }

    public function apideletesku(Request $request){

        $ids = $request->ids;
        Product::whereIn('product_sku',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);

}

    public function importdata(){
        return view('produks.import');
    }

    public function importing(Request $request){
        if($request->file('product') != NULL) {
            Excel::import(new ProductsImport, request()->file('product'));
        }else {
            toast('File kosong','error');
            return redirect('/produk');
        }

        toast('Berhasil Menambah Produk','success');
        return redirect('/produk');
    }
}
