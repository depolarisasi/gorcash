<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\BarangTerjual;
use App\Models\RiwayatPotongan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;


class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::get();
        $barang = []; //array penampung informasi produk untuk listing produk di avail_pen
        $potongan = []; //array penampung informasi produk untuk listing produk di avail_pen
        $pot = []; //array penampung informasi produk untuk listing produk di avail_pen


        foreach ($penjualan as $p) { //untuk setiap pengambilansampel, cari sampelnya, masukin ke array tersebut
            $barangarray = [];
            foreach (explode(',', $p->penjualan_barangterjual) as $b) {
                $barangterjual = BarangTerjual::where('barangterjual_id', $b)->first();
                if ($barangterjual) {
                    $produk = Produk::where('produk_id',$barangterjual->barangterjual_idproduk)->first();
                    $size = Size::where('size_id',$produk->produk_idsize)->first();
                    array_push($barangarray, $produk->produk_nama." (".$size->size_nama.")"." x".$barangterjual->barangterjual_qty);
                }
            }
            foreach (explode(',', $p->penjualan_daftarpotongan) as $p) {
                $potonganarray = [];
                $potonghargaarray = [];
                $riwayatpotongan = RiwayatPotongan::where('riwayatpotongan_id', $p)->first();
                if ($riwayatpotongan) {
                    array_push($potonganarray, $riwayatpotongan->riwayatpotongan_namapotongan);
                    array_push($potonghargaarray, $riwayatpotongan->riwayatpotongan_jumlahpotongan);
                }
            }

    array_push($barang, $barangarray);
    array_push($potongan, $potonganarray);
    array_push($pot, $potonghargaarray);
        }
        return view('penjualan.index')->with(compact('penjualan','barang','potongan','pot'));
        //return $pot;
    }

    public function create()
    {
        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::get();
        return view('penjualan.new')->with(compact('vendor','size','band'));
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

        return view('penjualan.show')->with(compact('show'));
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

        return view('penjualan.edit')->with(compact('edit','vendor','size','band'));
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


    public function kasir(){
        $product = Produk::join('vendor','vendor.vendor_id','=','produk.produk_idvendor',)
        ->join('size','size.size_id','=','produk.produk_idsize')
        ->join('band','band.band_id','=','produk.produk_idband')
        ->select('produk.*','size.size_id','size.size_nama','vendor.vendor_id','vendor.vendor_nama','band.band_id','band.band_nama')
        ->where('produk.produk_stok','>',0)
        ->get();

        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::get();
        return view('kasir.index')->with(compact('product','vendor','size','band'));
    }

    public function addpenjualan(Request $request){
        $penjualan = collect($request->all());
        $penjualan->put('penjualan_userid',Auth::user()->id);

        try {
           $addpenjualan = Penjualan::create($penjualan->all());
        } catch (QE $e) {
            return $e;
        } //show db error message

        $barangterjual = array();
        $totalpenjualan = 0;
        foreach($request->productorders as $key => $val){
            $produk = Produk::where('produk_id',$val)->first();
            $produkkeluar = new BarangTerjual;
            $produkkeluar->barangterjual_idproduk = $val;
            $produkkeluar->barangterjual_idpenjualan = $addpenjualan->penjualan_id;
            $produkkeluar->barangterjual_qty = $request->qtyorders[$key];
            $produkkeluar->barangterjual_totalbarangterjual = $produk->produk_hargajual*$request->qtyorders[$key];
            $produkkeluar->barangterjual_tanggalbarangterjual = $request->penjualan_tanggalpenjualan;
            $produkkeluar->barangterjual_userid = Auth::user()->id;
            $produk->produk_stok = $produk->produk_stok-$request->qtyorders[$key];
            $produk->update();
            $produkkeluar->save();
            array_push($barangterjual,$produkkeluar->barangterjual_id);
            $totalpenjualan = $totalpenjualan+($produk->produk_hargajual*$request->qtyorders[$key]);
        }


        $potonganpenjualan = array();
        $totalpotongan = 0;
        foreach($request->potonganname as $key => $val){
            $riwayat = new RiwayatPotongan;
            $riwayat->riwayatpotongan_namapotongan = $val;
            $riwayat->riwayatpotongan_jumlahpotongan = $request->potongantotal[$key];
            $riwayat->riwayatpotongan_idpenjualan = $addpenjualan->penjualan_id;
            $riwayat->riwayatpotongan_tanggalriwayatpotongan = $request->penjualan_tanggalpenjualan;
            $riwayat->riwayatpotongan_userid = Auth::user()->id;
            $riwayat->save();
            $riwayatid = $riwayat->riwayatpotongan_id;
            array_push($potonganpenjualan,$riwayatid);
            $totalpotongan = $totalpotongan+$request->potongantotal[$key];
        }

        $updatepenjualan = Penjualan::where('penjualan_id',$addpenjualan->penjualan_id)->first();
        $updatepenjualan->penjualan_barangterjual = implode(",", $barangterjual);
        $updatepenjualan->penjualan_totalpenjualan = $totalpenjualan;
        $updatepenjualan->penjualan_daftarpotongan = implode(",", $potonganpenjualan);
        $updatepenjualan->penjualan_totalpotongan = $totalpotongan;
        $updatepenjualan->update();


        notify()->success('Penjualan telah sukses ditambahkan !');

        return redirect('kasir');
    }
}
