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
            array_push($barangterjual,$val);
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
