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
use App\Models\BarangPublish;
use App\Models\BarangTerjual;
use App\Models\RiwayatPotongan;
use App\Models\Logs;
use App\Models\Customer;
use App\Models\PointLog;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Str;



class PenjualanController extends Controller
{
    public function generateRandomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function index()
    {
        if(Auth::user()->role == 1 ||  Auth::user()->role == 6 || Auth::user()->role == 4){
            $penjualan = Penjualan::OrderBy('penjualan_tanggalwaktupenjualan','DESC')->get();
        }elseif(Auth::user()->role == 2){
            $penjualan = Penjualan::where('penjualan_channel', '!=', 'Toko')
            ->OrderBy('penjualan_tanggalwaktupenjualan','DESC')->get();
        }elseif(Auth::user()->role == 5){
            $penjualan = Penjualan::where('penjualan_channel', '=', 'Toko')
            ->OrderBy('penjualan_tanggalwaktupenjualan','DESC')->get();
        }
        // $penjualan = Penjualan::OrderBy('penjualan_tanggalwaktupenjualan','DESC')->get();
        $barang = []; //array penampung informasi produk untuk listing produk di avail_pen
        $potongan = []; //array penampung informasi produk untuk listing produk di avail_pen
        $pot = []; //array penampung informasi produk untuk listing produk di avail_pen


        foreach ($penjualan as $p) { //untuk setiap pengambilansampel, cari sampelnya, masukin ke array tersebut
            $barangarray = [];
            foreach (explode(',', $p->penjualan_barangterjual) as $b) {
                $barangterjual = BarangTerjual::whereNotNull('barangterjual_id')->where('barangterjual_id', $b)->first();
                if ($barangterjual) {
                    $produk = Product::join('size','size.size_id','=','product.product_idsize')
                    ->select('product.*','size.size_nama')
                    ->where('product.product_id',$barangterjual->barangterjual_idproduk)->first();
                    array_push($barangarray, $produk->product_sku.' - '.$produk->product_nama." (".$produk->size_nama.")"." x".$barangterjual->barangterjual_qty);
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

    // public function create()
    // {
    //     $vendor = Vendor::get();
    //     $size = Size::get();
    //     $band = Band::get();
    //     return view('penjualan.new')->with(compact('vendor','size','band'));
    // }


    public function show($id)
    {
        $penjualan = Penjualan::join('users','penjualan.penjualan_userid','=','users.id')
        ->select('penjualan.*','users.name')
        ->where('penjualan.penjualan_id',$id)->first();

        $barangterjual = BarangTerjual::join('product','barangterjual.barangterjual_idproduk','=','product.product_id')
        ->join('size','product.product_idsize','=','size.size_id')
        ->select('product.product_sku','product.product_mastersku','size.size_nama','product.product_nama','product.product_hargajual','product.product_hargabeli','product.product_foto','barangterjual.*')
        ->where('barangterjual.barangterjual_idpenjualan',$id)->get();

        $logpoint = PointLog::where('order_id',$penjualan->penjualan_id)->first();
        if($logpoint){
            $member = Customer::where('customer_id',$logpoint->user_id)->first();
        }else {
            $member = null;
        }


        $daftarpotongan = RiwayatPotongan::where('riwayatpotongan_idpenjualan',$id)->get();
        if($penjualan){
            $totalbarang = $barangterjual->sum('barangterjual.barangterjual_totalbarangterjual');
            $totalpotongan = $daftarpotongan->sum('riwayatpotongan.riwayatpotongan_jumlahpotongan');
             
                return view('penjualan.show')->with(compact('penjualan','barangterjual','daftarpotongan','totalbarang','totalpotongan','logpoint','member'));

             
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

        $logpoint = PointLog::where('order_id',$penjualan->penjualan_id)->first();
        if($logpoint){
            $member = Customer::where('customer_id',$logpoint->user_id)->first();
        }else {
            $member = null;
        }
        // $pdf = PDF::loadView('penjualan.struk', $data);
        // $path = public_path('pdf/');
        // $random = substr(md5(mt_rand()), 0, 7);
        // $fileName =  $penjualan->penjualan_id.'_'.$penjualan->penjualan_tanggalwaktupenjualan.$random.'.pdf' ;

        //$pdf->save($path.$fileName);
        //return $data;
    //    $pdf->stream($fileName);
    //   // return $data;
 
    return view('penjualan.struk')->with(compact('penjualan','barangterjual','daftarpotongan','logpoint','member'));
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
        ->where('product.product_stokakhir','>',0)
        ->get();
        $invoice = "#".Carbon::now()->format('dmy').mt_rand(1,99).$this->generateRandomString(5);

        $vendor = Vendor::get();
        $size = Size::get();
        $band = Band::get();

        $customer = Customer::orderBy('customer.created_at','DESC')->get();
        $persen_point = SystemSetting::where('setting_name','persen_point')->first();
        $max_point = SystemSetting::where('setting_name','max_point')->first();
        return view('kasir.kasir')->with(compact('product','vendor','size','band','invoice','customer','persen_point','max_point'));
    }

    public function apiaddbarang(Request $request){
        try {
            $produk = Product::where('product_id',$request->productid)->first();
            $produkkeluar = new BarangTerjual;
            $produkkeluar->barangterjual_idproduk = $request->productid;
            $produkkeluar->barangterjual_qty = $request->qty;
            $produkkeluar->barangterjual_totalbarangterjual = $produk->product_hargajual;
            $produkkeluar->barangterjual_tanggalwaktubarangterjual = $request->tanggalpenjualan;
            $produkkeluar->barangterjual_userid = Auth::user()->id;
            $produkkeluar->save();
         } catch (QE $e) {
            return $e;
         } //show db error message
         $produk = Product::join('size','size.size_id','=','product.product_idsize')
         ->join('band','band.band_id','=','product.product_idband')
         ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
         ->where('product.product_id',$request->productid)
         ->first();
         $arr = array();
         if(Str::contains($produk->product_vendor, ',')){
             $vendorid = explode(',',$produk->product_vendor);
             foreach($vendorid as $v){
                 $name = Vendor::where('vendor_id', $v)->first();
                 array_push($arr, $name->vendor_nama);
             }
         }else {
             $name = Vendor::where('vendor_id',$produk->product_vendor)->first();
             $vendors = $name?$name->vendor_nama:"";
         }
         if(Str::contains($produk->product_vendor, ',')){
             $vendorname = implode(', ', $arr);
         }else {
             $vendorname = $vendors;
         }
         $produk['product_vendor'] = $vendorname;
         return $produk->toArray();
    }

    public function apidelbarang(Request $request){
        try {
            $produk = BarangTerjual::where('barangterjual_idproduk',$request->productid)
            ->where('barangterjual_idpenjualan',NULL)
            ->orderBy('created_at','DESC')->first();
            $produk->delete();
         } catch (QE $e) {
            return response()->json(['error'=>"Error occured when deleting product."]);
         } //show db error message
            return response()->json(['success'=>"Products Deleted Successfully."]);

    }

    public function addpenjualan(Request $request){
         ///POINT
         if(isset($request->customer_nohp)){

         $customer = Customer::where('customer.customer_nohp',$request->customer_nohp)->first();
         $persen_point = SystemSetting::where('setting_name','persen_point')->first();
         $max_point = SystemSetting::where('setting_name','max_point')->first();
         $point = ($request->penjualan_paymenttotal*$persen_point->setting_value)/100;
         if($point >= $max_point->setting_value){
             $memberpoint = $max_point->setting_value;
         } else {
            $memberpoint = $point;
         }
         $pointawal = $customer->customer_points;

         if($request->pakaipoint == 1){
            $customer->customer_points = ((int) $customer->customer_points - (int) $pointawal) + (int) $memberpoint;
         }else {
            $customer->customer_points = (int) $customer->customer_points + (int) $memberpoint;
         }
         $customer->update();

        }
         //
        $penjualan = collect($request->all());
        $penjualan->put('penjualan_userid',Auth::user()->id);
        $diskon = 0;
        try {
           $addpenjualan = Penjualan::create($penjualan->all());
        } catch (QE $e) {
            return $e;
        } //show db error message



        $barangterjual = array();
        $totalpenjualan = 0;
        foreach($request->productorders as $key => $val){
            $produk = Product::where('product_id',$val)->first();
            $produkkeluar = BarangTerjual::where('barangterjual_idproduk',$val)->where('barangterjual_idpenjualan',null)->first();
            $produkkeluar->barangterjual_idpenjualan = $addpenjualan->penjualan_id;
            $produkkeluar->barangterjual_qty = $request->qtyorders[$key];
            if (str_contains($request->diskonproduct[$key], '%')) {
                $disk =  trim(str_replace('%','',$request->diskonproduct[$key]));
                $potonganharga = ($disk*$produk->product_hargajual)/100;
                }elseif($request->diskonproduct[$key] == 0 || is_null($request->diskonproduct[$key])){
                $potonganharga = 0;
                }else{
                $potonganharga = $request->diskonproduct[$key];
                }
            $diskon = $diskon+$potonganharga;
            $produkkeluar->barangterjual_diskon = $potonganharga;
            $produkkeluar->barangterjual_totalbarangterjual = $produk->product_hargajual*$request->qtyorders[$key];
            $produkkeluar->barangterjual_totalpendapatan = ($produk->product_hargajual*$request->qtyorders[$key])-$potonganharga;
            $produkkeluar->barangterjual_tanggalwaktubarangterjual = $request->penjualan_tanggalwaktupenjualan;
            $produkkeluar->barangterjual_userid = Auth::user()->id;
            $stoklama = $produk->product_stokakhir;
            $produk->product_stokakhir = $produk->product_stokakhir-$request->qtyorders[$key];
            $produk->update();
            if($produk->wasChanged()){
                Logs::create(['log_name' => '[PEN] Stok Akhir Berubah', 'log_msg' => "Stok Akhir Produk ".$produk->product_nama." berubah karena penjualan dari ".$stoklama." menjadi ".$produk->product_stokakhir, 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);
            }else {
                Logs::create(['log_name' => '[PEN] Stok Akhir GAGAL Berubah', 'log_msg' => "Stok Akhir Produk ".$produk->product_nama." GAGAL berubah karena penjualan dari ".$stoklama." menjadi ".$produk->product_stokakhir, 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);

            }


                $publish = BarangPublish::where('publish_productid',$val)->orderBy('publish_tanggal','DESC')->first();
                if($publish){
                $stokpublama = $publish->publish_stokakhir;
                $publish->publish_stokakhir = $publish->publish_stokakhir-$request->qtyorders[$key];
                $publish->update();
                if($publish->wasChanged()){
                    Logs::create(['log_name' => '[PUB] Produk Stok Berubah', 'log_msg' => "Stok Akhir Produk ".$produk->product_nama." di Publish ".$publish->publish_name." berubah karena penjualan dari ".$stokpublama." menjadi ". $publish->publish_stokakhir, 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);
                }else {
                    Logs::create(['log_name' => '[PUB] Produk Stok GAGAL Berubah', 'log_msg' => "Stok Akhir Produk ".$produk->product_nama." di Publish ".$publish->publish_name." GAGAL berubah karena penjualan dari ".$stokpublama." menjadi ". $publish->publish_stokakhir, 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);
                }

            }
            $produkkeluar->update();
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
            $riwayat->riwayatpotongan_tanggalriwayatpotongan = $request->penjualan_tanggalwaktupenjualan;
            $riwayat->riwayatpotongan_userid = Auth::user()->id;
            $riwayat->save();
            $riwayatid = $riwayat->riwayatpotongan_id;
            array_push($potonganpenjualan,$riwayatid);
            $totalpotongan = $totalpotongan+$request->potongantotal[$key];
          }

        $updatepenjualan->penjualan_daftarpotongan = implode(",", $potonganpenjualan);
        $updatepenjualan->penjualan_totalpotongan = $totalpotongan;
        $updatepenjualan->penjualan_totalpendapatan = $totalpenjualan-$totalpotongan-$diskon;
        }else {
            $updatepenjualan->penjualan_totalpendapatan = $totalpenjualan-$diskon;
        }
        $updatepenjualan->penjualan_diskon = $diskon;
        $barangterjual = BarangTerjual::join('product','barangterjual.barangterjual_idproduk','=','product.product_id')
        ->join('size','product.product_idsize','=','size.size_nama')
        ->select('product.product_sku','product.product_mastersku','size.size_nama','product.product_nama','product.product_hargajual','product.product_hargabeli','product.product_foto','barangterjual.*')
        ->where('barangterjual.barangterjual_idpenjualan',$addpenjualan->penjualan_id)->get();
        $daftarpotongan = RiwayatPotongan::where('riwayatpotongan_idpenjualan',$addpenjualan->penjualan_id)->get();
        $data = array();
        array_push($data, $updatepenjualan);
        array_push($data, $daftarpotongan->toArray());
        array_push($data, $barangterjual->toArray());
        $pdf = PDF::loadView('penjualan.strukpenjualan', compact('data'));
        $path = public_path('pdf/');
        $random = substr(md5(mt_rand()), 0, 7);
        $fileName =  $addpenjualan->penjualan_id.'_'.$addpenjualan->penjualan_tanggalwaktupenjualan.$random.'.pdf' ;
        $updatepenjualan->penjualan_receipt = $path.$fileName;
        $updatepenjualan->update();

       // return $data;//
    //    $pdf->stream($fileName);
    //   // return $data;

    if(isset($request->customer_nohp)){
    PointLog::create([
        'user_id' => $customer->customer_id,
        'points' => $memberpoint,
        'order_id' => $addpenjualan->penjualan_id,
        'type' => 1,
        'admin_user_id' => Auth::user()->id,
        'data' => 'Penambahan Point sebesar '. $memberpoint . ' Karena Penjualan ID' .$addpenjualan->penjualan_id,
        'date' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d')]);

        if($request->pakaipoint == 1){
            PointLog::create([
                'user_id' => $customer->customer_id,
                'points' => $customer->customer_points,
                'order_id' => $addpenjualan->penjualan_id,
                'type' => 1,
                'admin_user_id' => Auth::user()->id,
                'data' => 'Pengurangan Point sebesar '. $pointawal . ' Karena Penjualan ID ' .$addpenjualan->penjualan_id,
                'date' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d')]);

        }
    }


        toast('Penjualan Berhasil Ditambahkan','success');

        return redirect('/penjualan/detail/'.$updatepenjualan->penjualan_id);
        $pdf->save($path.$fileName);
    }
}
