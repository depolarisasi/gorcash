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
use App\Models\BarangTerjual;
use App\Models\BarangPublish;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Logs;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Auth;

class ProductController extends Controller
{


    public function generateMasterSKU($band, $type, $nama, $color){
        $databand = Band::where('band_id',$band)->first();
        $firstbandletter =  substr($databand->band_nama, 0, 1);
        $datatype = TypeProduct::where('type_id',$type)->first();
        $datacolor = Color::where('color_id',$color)->first();
        $sericode = BarcodeDB::where('barcode_productband',$band)->where('barcode_producttype',$type)->count();
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
        $produk = Product::join('band','band.band_id','=','product.product_idband')
        ->join('vendor','vendor.vendor_id','=','product.product_vendor')
        ->join('size','size.size_id','=','product.product_idsize')
        ->selectRaw("SUM(product_stok) AS product_stokawal, product.*,
        band.band_id,
        band.band_nama,
        group_concat(DISTINCT size.size_nama ORDER BY size.size_id ASC SEPARATOR ', ') as product_idsize,
        group_concat(DISTINCT vendor.vendor_nama SEPARATOR ', ') as product_vendor,
         group_concat(product.product_stokakhir ORDER BY size.size_id ASC SEPARATOR', ') as product_stokakhir")
        ->where('product.product_stokakhir','>',0) 
        ->Orwhere('product.product_stok','=',0) 
        ->orderBy('product.product_id', 'DESC')
        ->groupBy('product.product_mastersku')
        ->get();

        // foreach($produk as $key => $p){
        //     $variant = Product::join('size','size.size_id','=','product.product_idsize')
        //     ->select('product.*','size.size_id','size.size_nama')
        //     ->where('product.product_mastersku',$p->product_mastersku)->get();

        //     if(is_null($p->product_foto) || $p->product_foto == ''){
        //         $checkfoto = Product::where('product_mastersku', $p->product_mastersku)->whereNotNull('product_foto')->first();
        //         if($checkfoto){
        //             $produk[$key]['product_foto'] = $checkfoto->product_foto;
        //         }else {
        //             $produk[$key]['product_foto'] = "/assets/nopicture.png";
        //         }
        //     }

        // }

        $vendor = Vendor::get();
        $band = Band::orderBy('band_nama','ASC')->get();
        $size = Size::get();
        return view('produks.index')->with(compact('produk','vendor','band','size'));
        // return $produk;
    }

    public function outofstock()
    {
        $produk = Product::join('band','band.band_id','=','product.product_idband')
        ->join('vendor','vendor.vendor_id','=','product.product_vendor')
        ->join('size','size.size_id','=','product.product_idsize')
        ->selectRaw("product.*, band.band_id,band.band_nama,size.size_id,size.size_nama,vendor.vendor_id,vendor.vendor_nama")
        ->where('product.product_stokakhir','=',0)
        ->where('product.product_stok','>',0)
        ->orderBy('product.product_id', 'DESC')
        ->get();

        // foreach($produk as $key => $p){
        //     $variant = Product::join('size','size.size_id','=','product.product_idsize')
        //     ->select('product.*','size.size_id','size.size_nama')
        //     ->where('product.product_mastersku',$p->product_mastersku)->get();

        //     if(is_null($p->product_foto) || $p->product_foto == ''){
        //         $checkfoto = Product::where('product_mastersku', $p->product_mastersku)->whereNotNull('product_foto')->first();
        //         if($checkfoto){
        //             $produk[$key]['product_foto'] = $checkfoto->product_foto;
        //         }else {
        //             $produk[$key]['product_foto'] = "/assets/nopicture.png";
        //         }
        //     }

        // }

        $vendor = Vendor::get();
        $band = Band::orderBy('band_nama','ASC')->get();
        $size = Size::get();
        return view('produks.outofstock')->with(compact('produk','vendor','band','size'));
        // return $produk;
    }

    public function create()
    {
        $vendor = Vendor::get();
        $size = Size::get();
        $sizeanak = Size::where('size_category','Anak Anak')->get();
        $sizedewasa = Size::where('size_category','Dewasa')->get();
        $sizebarang = Size::where('size_category','Barang')->get();
        $band = Band::orderBy('band_nama','ASC')->get();
        $color = Color::get();
        $type = TypeProduct::get();
        $barcode = BarcodeDB::join('band','band.band_id','=','barcode.barcode_productband')
        ->select('barcode.*','band.band_nama')
        ->get();
        return view('produks.new')->with(compact('vendor','size','band','color','type','barcode','sizeanak','sizedewasa','sizebarang'));
    }

    public function store(Request $request)
    {
        $masterskus = $request->product_mastersku;
        if($masterskus != "NEW") {
                $typecategory = TypeProduct::where('type_id',$request->product_typeid)->first();
                if($typecategory->type_category == "Dewasa"){
                    $size = $request->sized_id;
                    $hargabeli = $request->hargabelid;
                    $hargajual = $request->hargajuald;
                    $stok = $request->stokawald;

                }else if($typecategory->type_category == "Anak Anak"){
                    $size = $request->sizea_id;
                    $hargabeli = $request->hargabelia;
                    $hargajual = $request->hargajuala;
                    $stok = $request->stokawala;

                }else if($typecategory->type_category == "Barang"){
                    $size = $request->sizeb_id;
                    $hargabeli = $request->hargabelib;
                    $hargajual = $request->hargajualb;
                    $stok = $request->stokawalb;
                }
                $arr = array();
                foreach($size as $key => $s){
                    if(($stok[$key] != 0 || $stok[$key] != "0") || is_null($stok[$key])){
                                $sizeselected = $s;
                                $skuvariant = $masterskus.$sizeselected;
                                $checksku = Product::where('product_sku',$skuvariant)->first();
                                $otherproduct = Product::where('product_mastersku',$masterskus)->first();
                                $masterdata = BarcodeDB::where('barcode_mastersku', $masterskus)->first();
                                if($masterdata && (strcasecmp($masterdata->barcode_productname, $request->product_nama) == 0)){
                                    if(!$checksku){
                                            $store = collect($request->all());
                                            $store->put('product_mastersku', $masterskus);
                                            $store->put('product_idsize', $sizeselected);
                                            $store->put('product_idband', $masterdata->barcode_productband);
                                            $store->put('product_typeid', $masterdata->barcode_producttype);
                                            $store->put('product_color', $masterdata->barcode_productcolor);
                                            $store->put('product_sku', $skuvariant);
                                            $store->put('product_hargajual', $hargajual[$key]);
                                            $store->put('product_hargabeli', $hargabeli[$key]);
                                            $store->put('product_stok', $stok[$key]);
                                            $store->put('product_stokakhir', $stok[$key]);
                                            if($stok[$key] >= 1){
                                            $store->put('product_stoktoko', 1);
                                            $store->put('product_stokgudang', (int)$stok[$key]-1);
                                            }elseif($stok[$key] <= 0){
                                                $store->put('product_stoktoko', 0);
                                                $store->put('product_stokgudang', 0);
                                            }
                                            $store->put('product_foto', $this->uploadImage($request->file('product_foto')));
                                            if(is_array($request->product_vendor)){
                                                $vendor = implode(',',$request->product_vendor);
                                            }else {
                                                $vendorinput = explode('',$request->product_vendor);
                                                $vendor = implode(',',$vendorinput);
                                            }
                                            $store->put('product_vendor', $vendor);
                                            // $store->put('product_productlama', $request->product_productlama);
                                        if(!$otherproduct && ($otherproduct->product_status == NULL || $otherproduct->product_status == 0)){
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
                                    else {

                                            $checksku->product_idsize = $sizeselected;
                                            $checksku->product_idband = $masterdata->barcode_productband;
                                            $checksku->product_typeid = $masterdata->barcode_producttype;
                                            $checksku->product_color = $masterdata->barcode_productcolor;
                                            $checksku->product_sku = $skuvariant;
                                            $checksku->product_hargajual = $hargajual[$key];
                                            $checksku->product_hargabeli = $hargabeli[$key];
                                            $checksku->product_stok = (int)$checksku->product_stok + $stok[$key];
                                            $checksku->product_stokakhir = (int)$checksku->product_stokakhir + $stok[$key];
                                            if($stok[$key] >= 1){
                                            $checksku->product_stoktoko = (int)$checksku->product_stoktoko+1;
                                            $checksku->product_stokgudang = (int)$checksku->product_stokgudang+(int)$stok[$key]-1;
                                            }elseif($stok[$key] <= 0){
                                                $checksku->product_stoktoko = 0;
                                                $checksku->product_stokgudang = 0;
                                            }
                                            $checksku->product_foto = $this->uploadImage($request->file('product_foto'));
                                            if(is_array($request->product_vendor)){
                                                $vendor = implode(',',$request->product_vendor);
                                            }else {
                                                $vendorinput = explode(' ',$request->product_vendor);
                                                $vendor = implode(',',$vendorinput);
                                            }
                                            $checksku->product_vendor = $vendor;
                                            // $checksku->product_productlama = $request->product_productlama;
                                            if(!$otherproduct && ($otherproduct->product_status == NULL || $otherproduct->product_status == 0)){
                                                $status = 0;
                                            }else {
                                                $status = 1;
                                            }
                                        $checksku->product_status = $status;

                                        try {
                                            $checksku->update();
                                            } catch (QE $e) {

                                    toast('Database error','error');
                                                return redirect()->back();
                                            }
                                    }
                                }else {
                                    toast('Nama Desain di Database Barcode berbeda dengan Nama Produk, Produk Berbeda?','error');
                                    return redirect()->back();
                                }

                    }
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


            $typecategory = TypeProduct::where('type_id',$request->product_typeid)->first();
            if($typecategory->type_category == "Dewasa"){
                $size = $request->sized_id;
                $hargabeli = $request->hargabelid;
                $hargajual = $request->hargajuald;
                $stok = $request->stokawald;

            }else if($typecategory->type_category == "Anak Anak"){
                $size = $request->sizea_id;
                $hargabeli = $request->hargabelia;
                $hargajual = $request->hargajuala;
                $stok = $request->stokawala;

            }else if($typecategory->type_category == "Barang"){
                $size = $request->sizeb_id;
                $hargabeli = $request->hargabelib;
                $hargajual = $request->hargajualb;
                $stok = $request->stokawalb;
            }

            foreach($size as $key => $s){
                if(($stok[$key] != 0 || $stok[$key] != "0") || is_null($stok[$key])){
                            $sizeselected = $s;
                            $skuvariant = $newbarcode["sku"].$s;
                            $store = collect($request->all());
                            $store->put('product_mastersku', $newbarcode["sku"]);
                            $store->put('product_sku', $skuvariant);
                            $store->put('product_idsize', $sizeselected);
                            $store->put('product_idband', $masterdata->barcode_productband);
                            $store->put('product_typeid', $masterdata->barcode_producttype);
                            $store->put('product_color', $masterdata->barcode_productcolor);
                            $store->put('product_hargajual', $hargajual[$key]);
                            $store->put('product_hargabeli', $hargabeli[$key]);
                            $store->put('product_stok', $stok[$key]);
                            $store->put('product_stokakhir', $stok[$key]);
                            if($stok[$key] >= 1){
                                $store->put('product_stoktoko', 1);
                                $store->put('product_stokgudang', (int)$stok[$key]-1);
                                }elseif($stok[$key] <= 0){
                                    $store->put('product_stoktoko', 0);
                                    $store->put('product_stokgudang', 0);
                                }
                            $store->put('product_foto', $this->uploadImage($request->file('product_foto')));
                            if(is_array($request->product_vendor)){
                                $vendor = implode(',',$request->product_vendor);
                            }else {
                                $vendorinput = explode('',$request->product_vendor);
                                $vendor = implode(',',$vendorinput);
                            }
                            $store->put('product_vendor', $vendor);
                            // $store->put('product_productlama', $request->product_productlama);
                            if($request->product_tanggalpublish == NULL || $request->product_status == 0){
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
        if(is_null($show->product_foto) || $show->product_foto == ''){
            $checkfoto = Product::where('product_mastersku', $show->product_mastersku)->whereNotNull('product_foto')->first();
            if($checkfoto){
                $show['product_foto'] = $checkfoto->product_foto;
            }else {
                $show['product_foto'] = "/assets/nopicture.png";
            }
        }
        $barangterjual = BarangTerjual::join('penjualan','penjualan.penjualan_id','=','barangterjual.barangterjual_idpenjualan')
        ->join('product','product.product_id','=','barangterjual.barangterjual_idproduk')
        ->select('product.*','penjualan.*','barangterjual.*')
        ->where('barangterjual.barangterjual_idproduk',$id)
        ->get();
        $vendorid = explode(',',$show->product_vendor);
        $arr = array();
        foreach($vendorid as $v){
            $name = Vendor::where('vendor_id',$v)->first();
            array_push($arr, $name->vendor_nama);
        }
        $vendorname = implode(', ', $arr);
        $show['product_vendor'] =  $vendorname;


        return view('produks.show')->with(compact('show','barangterjual'));
    }


    public function editselect($mastersku)
    {

        $produk = Product::join('band','band.band_id','=','product.product_idband')
        ->join('vendor','vendor.vendor_id','=','product.product_vendor')
        ->join('size','size.size_id','=','product.product_idsize')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product.product_mastersku', $mastersku)
        ->get();

        foreach($produk as $key => $p){
            if(is_null($p->product_foto) || $p->product_foto == ''){
                $checkfoto = Product::where('product_mastersku', $p->product_mastersku)->whereNotNull('product_foto')->first();
                if($checkfoto){
                    $produk[$key]['product_foto'] = $checkfoto->product_foto;
                }else {
                    $produk[$key]['product_foto'] = "/assets/nopicture.png";
                }
            }
            $arr = array();
            if(Str::contains($p->product_vendor, ',')){
                $vendorid = explode(',',$p->product_vendor);
                foreach($vendorid as $v){
                    $name = Vendor::where('vendor_id', $v)->first();
                    array_push($arr, $name->vendor_nama);
                }
            }else {
                $name = Vendor::where('vendor_id',$p->product_vendor)->first();
                $vendors = $name?$name->vendor_nama:"";
            }


            if(Str::contains($p->product_vendor, ',')){
                $vendorname = implode(', ', $arr);
            }else {
                $vendorname = $vendors;
            }
            $produk[$key]['product_vendor'] =  $vendorname;
        }

        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::orderBy('band_nama','ASC')->get();
        return view('produks.select')->with(compact('produk','vendor','size','band'));
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
        $band = Band::orderBy('band_nama','ASC')->get();
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
            $fileurl =  $this->uploadImage($request->file('product_foto'));
    }

    $update->put('product_foto', $fileurl);

    $vendor = implode(',',$request->product_vendor);
    $update->put('product_vendor', $vendor);


    if($produk->product_status == 0){
        $status = 0;
    }else {
        $status = 1;
    }
    $update->put('product_status', $status);

    if($status == 1){
        $pub = BarangPublish::where('publish_productid',$produk->product_id)->orderBy('publish_tanggal','DESC')->first();
        $pub->publish_stok = $request->product_stok;
        $pub->publish_stokakhir = $request->product_stokakhir;
        $pub->update();
    }


        try {
        $produk->update($update->all());
        $productwithsamesku = Product::where('product_mastersku', $produk->product_mastersku)->get();
        foreach($productwithsamesku as $ps){
            $ps->product_foto = $fileurl;
            $ps->update();
        }
        } catch (QE $e) {

        toast('Database error','error');
            return redirect()->back();
        }

        toast('Berhasil Mengubah Produk','success');
        return redirect('produk');
    }

    public function delete($id)
    {
        $produk = Product::where('product_sku', $id)->get();
        $productnama = Product::where('product_sku', $id)->first();

        try {
            foreach($produk as $p){
                $p->delete();
            }
        } catch (QE $e) {
        toast('Database error','error');
        return redirect('produk');
        } //show db error message

        Logs::create(['log_name' => 'Delete', 'log_msg' => "Produk ".$productnama->product_nama." di hapus via Satuan", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);

        toast('Berhasil Menghapus Produk','success');

        return redirect('produk');
    }

    public function deletemaster($id)
    {
        $produk = Product::where('product_mastersku', $id)->get();
        $productnama = Product::where('product_mastersku', $id)->first();
        $nama = $productnama->product_nama;

        try {
            foreach($produk as $p){
                $p->delete();
            }
        } catch (QE $e) {
        toast('Database error','error');
        return redirect('produk');
        } //show db error message

        toast('Berhasil Menghapus Produk','success');
        Logs::create(['log_name' => 'Delete', 'log_msg' => "Produk ".$nama." di hapus via Master Product", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);

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
            Product::whereIn('product_mastersku',$ids)->delete();
            $productname =   Product::whereIn('product_mastersku',explode(",",$ids))->first();
            $nama = $productname->product_nama;
            return response()->json(['success'=>"Products Deleted successfully."]);
            Logs::create(['log_name' => 'Delete', 'log_msg' => "Produk ".$ama."  di hapus via Mass Delete", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);


    }

    public function apideletesku(Request $request){

        $ids = $request->ids;
        Product::whereIn('product_sku',explode(",",$ids))->delete();
        $productname =   Product::whereIn('product_mastersku',explode(",",$ids))->first();
        $nama = $productname->product_nama;
        return response()->json(['success'=>"Products Deleted successfully."]);
        Logs::create(['log_name' => 'Delete', 'log_msg' => "Produk ".$nama." di hapus via API", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);

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

        Logs::create(['log_name' => 'Import', 'log_msg' => "Import Product Berhasil", 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);

        return redirect('/produk');
    }
}
