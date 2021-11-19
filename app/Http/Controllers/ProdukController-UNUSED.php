<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Produk;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::join('vendor','vendor.vendor_id','=','produk.produk_idvendor',)
        ->join('size','size.size_id','=','produk.produk_idsize')
        ->join('band','band.band_id','=','produk.produk_idband')
        ->select('produk.*','size.size_id','size.size_nama','vendor.vendor_id','vendor.vendor_nama','band.band_id','band.band_nama')
        ->get();

        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::get();
        return view('produk.index')->with(compact('produk','vendor','size','band'));
    }

    public function create()
    {
        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::get();
        return view('produk.new')->with(compact('vendor','size','band'));
    }

    public function store(Request $request)
    {
        $checksku = Produk::where('produk_sku',$request->produk_sku)->first();
        if($checksku){
        notify()->danger('SKU Sudah Ada!');
            return redirect('produk');
        }
        $store = collect($request->all());


        if ($request->file('produk_foto') == '') {
            $fileurl = '';
    } else {
        $file = $request->file('produk_foto');
        $fileArray = ['produk_foto' => $file];
        $rules = ['produk_foto' => 'mimes:jpeg,jpg,png,gif|required|max:100000'];
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

    $store->put('produk_foto', $fileurl);


        try {
        Produk::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Produk Berhasil');
        return redirect('produk');
    }

    public function show($id)
    {
        $show = Produk::join('vendor','vendor.vendor_id','=','produk.produk_idvendor',)
        ->join('size','size.size_id','=','produk.produk_idsize')
        ->join('band','band.band_id','=','produk.produk_idband')
        ->select('produk.*','size.size_id','size.size_nama','vendor.vendor_id','vendor.vendor_nama','band.band_id','band.band_nama')
        ->where('produk.produk_id', $id)->first();

        return view('produk.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Produk::join('vendor','vendor.vendor_id','=','produk.produk_idvendor',)
        ->join('size','size.size_id','=','produk.produk_idsize')
        ->join('band','band.band_id','=','produk.produk_idband')
        ->select('produk.*','size.size_id','size.size_nama','vendor.vendor_id','vendor.vendor_nama','band.band_id','band.band_nama')
        ->where('produk.produk_id', $id)->first();

        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::get();

        return view('produk.edit')->with(compact('edit','vendor','size','band'));
    }

    public function update(Request $request)
    {
        $produk = Produk::where('produk_id', $request->v)->first();
        $update = collect($request->all());


        if ($request->file('produk_foto') == '') {
            $fileurl = $produk->produk_foto;
    } else {
        $file = $request->file('produk_foto');
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

    $update->put('produk_foto', $fileurl);


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
        $produk = Produk::where('produk_id', $id)->first();

        try {
            $produk->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Size telah sukses dihapus !');

        return redirect('produk');
    }

    public function getproduct(Request $request){
        $produk = Produk::join('vendor','vendor.vendor_id','=','produk.produk_idvendor',)
        ->join('size','size.size_id','=','produk.produk_idsize')
        ->join('band','band.band_id','=','produk.produk_idband')
        ->select('produk.*','size.size_id','size.size_nama','vendor.vendor_id','vendor.vendor_nama','band.band_id','band.band_nama')
        ->where('produk.produk_id',$request->productid)
        ->first();
        return $produk->toArray();
    }
}
