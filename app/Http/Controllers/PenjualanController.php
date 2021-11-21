<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Product;
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
use PDF;


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
                    $produk = Product::where('product_id',$barangterjual->barangterjual_idproduk)->first();
                    $size = Size::where('size_id',$produk->product_idsize)->first();
                    array_push($barangarray, $produk->product_sku.' - '.$produk->product_nama." (".$size->size_nama.")"." x".$barangterjual->barangterjual_qty);
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
 

    public function show($id)
    {
        $penjualan = Penjualan::join('users','penjualan.penjualan_userid','=','users.id')
        ->select('penjualan.*','users.name')
        ->where('penjualan.penjualan_id',$id)->first();

        $barangterjual = BarangTerjual::join('product','barangterjual.barangterjual_idproduk','=','product.product_id')
        ->join('size','product.product_idsize','=','size.size_id')
        ->select('product.product_sku','product.product_mastersku','size.size_nama','product.product_nama','product.product_hargajual','product.product_hargabeli','product.product_foto','barangterjual.*')
        ->where('barangterjual.barangterjual_idpenjualan',$id)->get();


        $daftarpotongan = RiwayatPotongan::where('riwayatpotongan_idpenjualan',$id)->get();
        if($penjualan){ 
            $totalbarang = $barangterjual->sum('barangterjual.barangterjual_totalbarangterjual');
            $totalpotongan = $daftarpotongan->sum('riwayatpotongan.riwayatpotongan_jumlahpotongan');
       return view('penjualan.show')->with(compact('penjualan','barangterjual','daftarpotongan','totalbarang','totalpotongan'));
      //return $barangterjual;
        }else {
            
            toast('Penjualan Tidak Ditemukan','error');
            return redirect('penjualan');
        }

    }

    public function receipt($id){
        $penjualan = Penjualan::join('users','penjualan.penjualan_userid','=','users.id')
        ->select('penjualan.*','users.name')
        ->where('penjualan.penjualan_id',$id)->first();

        $barangterjual = BarangTerjual::join('product','barangterjual.barangterjual_idproduk','=','product.product_id')
        ->join('size','product.product_idsize','=','size.size_id')
        ->select('product.product_sku','product.product_mastersku','size.size_nama','product.product_nama','product.product_hargajual','product.product_hargabeli','product.product_foto','barangterjual.*')
        ->where('barangterjual.barangterjual_idpenjualan',$id)->get();
        $daftarpotongan = RiwayatPotongan::where('riwayatpotongan_idpenjualan',$id)->get();
        $data = array();
        array_push($data, $penjualan);
        array_push($data, $daftarpotongan->toArray());
        array_push($data, $barangterjual->toArray());
      
         $pdf = PDF::loadView('penjualan.struk', $data);
        $path = public_path('pdf/');
        $random = substr(md5(mt_rand()), 0, 7);
        $fileName =  $addpenjualan->penjualan_id.'_'.$addpenjualan->penjualan_tanggalpenjualan.$random.'.pdf' ;
        $updatepenjualan->penjualan_receipt = $path.$fileName;
        //$pdf->save($path.$fileName); 
        //return $data;   
        $pdf->setPaper('a8', 'portrait')->dpi('72')->stream($fileName);
        return view('penjualan.struk')->with(compact('data','penjualan','barangterjual','daftarpotongan'));
    }
  
    public function delete($id)
    {
        $penjualan = Penjualan::where('penjualan_id', $id)->first();

        if($penjualan){
            foreach (explode(',', $penjualan->penjualan_barangterjual) as $b) {
                $barangterjual = BarangTerjual::where('barangterjual_id', $b)->first();
                if ($barangterjual) {
                    $barangterjual->delete();
                }
            }
            foreach (explode(',', $penjualan->penjualan_daftarpotongan) as $p) { 
                $riwayatpotongan = RiwayatPotongan::where('riwayatpotongan_id', $p)->first();
                if ($riwayatpotongan) {
                    $riwayatpotongan->delete();
                }
            }
            $penjualan->delete();
        }else { 
            toast('Penjualan Tidak Ditemukan','error');
            return redirect()->back();
        } 

        toast('Penjualan Berhasil Dihapus','success');
        return redirect('penjualan');
    }
 

    public function kasir(){
        $product = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product.product_stok','>',0)
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
            $produk = Product::where('product_id',$val)->first();
            $produkkeluar = new BarangTerjual;
            $produkkeluar->barangterjual_idproduk = $val;
            $produkkeluar->barangterjual_idpenjualan = $addpenjualan->penjualan_id;
            $produkkeluar->barangterjual_qty = $request->qtyorders[$key];
            $produkkeluar->barangterjual_totalbarangterjual = $produk->product_hargajual*$request->qtyorders[$key];
            $produkkeluar->barangterjual_tanggalbarangterjual = $request->penjualan_tanggalpenjualan;
            $produkkeluar->barangterjual_userid = Auth::user()->id;
            $produk->product_stok = $produk->product_stok-$request->qtyorders[$key];
            $produk->update();
            $produkkeluar->save();
            array_push($barangterjual,$produkkeluar->barangterjual_id);
            $totalpenjualan = $totalpenjualan+($produk->product_hargajual*$request->qtyorders[$key]);
        }

        $updatepenjualan = Penjualan::where('penjualan_id',$addpenjualan->penjualan_id)->first();
        $updatepenjualan->penjualan_barangterjual = implode(",", $barangterjual);
        $updatepenjualan->penjualan_totalpenjualan = $totalpenjualan; 

        if($request->potonganname != NULL){
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
          
        $updatepenjualan->penjualan_daftarpotongan = implode(",", $potonganpenjualan);
        $updatepenjualan->penjualan_totalpotongan = $totalpotongan; 
        }else {

        }  
        // $barangterjual = BarangTerjual::join('product','barangterjual.barangterjual_idproduk','=','product.product_id')
        // ->join('size','product.product_idsize','=','size.size_nama')
        // ->select('product.product_sku','product.product_mastersku','size.size_nama','product.product_nama','product.product_hargajual','product.product_hargabeli','product.product_foto','barangterjual.*')
        // ->where('barangterjual.barangterjual_idpenjualan',$addpenjualan->penjualan_id)->get();
        // $daftarpotongan = RiwayatPotongan::where('riwayatpotongan_idpenjualan',$addpenjualan->penjualan_id)->get();
        // $data = array();
        // array_push($data, $updatepenjualan);
        // array_push($data, $daftarpotongan->toArray());
        // array_push($data, $barangterjual->toArray());
        // $pdf = PDF::loadView('penjualan.struk', $data);
        // $path = public_path('pdf/');
        // $random = substr(md5(mt_rand()), 0, 7);
        // $fileName =  $addpenjualan->penjualan_id.'_'.$addpenjualan->penjualan_tanggalpenjualan.$random.'.pdf' ;
        // $updatepenjualan->penjualan_receipt = $path.$fileName;
        // $pdf->save($path.$fileName); 
 
        $updatepenjualan->update(); 
        
        toast('Penjualan Berhasil Ditambahkan','success');

        return redirect('/penjualan');
    }
}
