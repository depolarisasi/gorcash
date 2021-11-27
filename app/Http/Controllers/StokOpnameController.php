<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\BarangPublish;
use App\Models\Product;
use App\Models\StokOpname;
use App\Models\Penjualan;
use App\Models\BarangTerjual;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use PDF;

class StokOpnameController extends Controller
{
    public function indexmingguan()
    {

        $publish = BarangPublish::groupBy('publish_groupid')->get();
        foreach($publish as $key => $pub){
            $productcount = BarangPublish::where('publish_groupid',$pub->publish_groupid)->count();
            $publish[$key]['count'] = $productcount;
            $statusopname = StokOpname::where('so_pubgroupname',$pub->publish_groupid)->first();
            if($statusopname){
                if($statusopname->so_status == 1){
                    $publish[$key]['status'] =  1;
                }elseif($statusopname->so_status  == 2) {
                $publish[$key]['status'] =  2;
                }else {
                    $publish[$key]['status'] = 0;
                }
            }
        }
        //return $publish;
         return view('stokopname.indexmingguan')->with(compact('publish'));
    }

    public function somingguan($pubgroup){
        $pubdata = BarangPublish::join('product','product.product_id','publish.publish_productid')
        ->join('size','size.size_id','product.product_idsize')
        ->select('publish.*','product.product_id','product.product_nama','product.product_stoktoko','product.product_stok','product.product_stokakhir','size.size_nama','product.product_mastersku','product.product_sku')
        ->where('publish_groupid',$pubgroup)->get();
        foreach($pubdata as $key => $p){
            $penjualan = BarangTerjual::where('barangterjual_idproduk',$p->product_id)->get();

            $count = 0;
            foreach($penjualan as $pp){
                $count = $count + (int) $pp->barangterjual_qty;
            }
            $pubdata[$key]["stokterjual"] = $count;
        }

        $pub = $pubgroup;
        return view('stokopname.somingguan')->with(compact('pubdata','pub'));
     }

     public function resumesomingguan($pubgroup){
        $pubdata = StokOpname::join('product','product.product_sku','stokopname.so_sku')
        ->join('size','size.size_id','product.product_idsize')
        ->select('stokopname.*','product.product_id','product.product_nama','product.product_stok','product.product_stokakhir','size.size_nama','product.product_mastersku','product.product_sku')
        ->where('stokopname.so_pubgroupname',$pubgroup)->get();
        foreach($pubdata as $key => $p){
            $penjualan = BarangTerjual::where('barangterjual_idproduk',$p->product_productid)->get();
            $count = 0;
            foreach($penjualan as $pp){
                $count = $count + (int) $pp->barangterjual_qty;
            }
            $pubdata[$key]["stokterjual"] = $count;
        }

        $pub = $pubgroup;
        return view('stokopname.resumesomingguan')->with(compact('pubdata','pub'));
     }

    public function getso(Request $request){
        $product = Product::where('product_sku',$request->sku)->first();
        $checksku = BarangPublish::where('publish_groupid',$request->pubgroup)->where('publish_productid',$product->product_id)->first();
        if($checksku || $request->sku != "X"){
            return response()->json(['success'=>"Product Scanned."]);
        }else {
            return response()->json(['error'=>"Product Tidak Ada."]);
        }
    }

    public function laporanpdf($pubgroup){
        $info = StokOpname::join('users','users.id','=','stokopname.so_userid')
        ->select('stokopname.*','users.name')
        ->where('stokopname.so_pubgroupname', $pubgroup)->first();
        $product = StokOpname::join('product','product.product_sku','stokopname.so_sku')
        ->join('size','size.size_id','product.product_idsize')
        ->select('stokopname.*','product.product_id','product.product_nama','product.product_stok','product.product_stokakhir','size.size_nama','product.product_mastersku','product.product_sku')
        ->where('stokopname.so_pubgroupname',$pubgroup)
        ->where('so_status',1)->get();
        $info["productcount"] = count($product);
        $data = array();
        array_push($data, $info->toArray());
        array_push($data, $product->toArray());

        // return $data;
        $pdf = PDF::loadView('stokopname.laporanpdf', compact('data'));
        return $pdf->download('laporan-so-'.$pubgroup.'-'.$info->so_date.$info->so_type.'.pdf');

        // return view('stokopname.laporanpdf')->with(compact('product','info'));
    }
    public function storesomingguan(Request $request)
    {
        foreach($request->product_skus as $key => $p){
            $so = new StokOpname;
            $date = Carbon::now()->format('Y-m-d');
            $so->so_date = $date;
            $so->so_pubgroupname = $request->publishgroup;
            $product = Product::where('product_sku', $p)->first();
            $so->so_mastersku = $product->product_mastersku;
            $so->so_sku = $p;
            $so->so_stok = $product->product_stok;
            $so->so_stokakhir = $product->product_stokakhir;
            $so->so_stokterjual = $request->stokterjual[$key];
            $so->so_selisih = $request->selisih[$key];
            $so->so_stokakhirreal = $request->stokril[$key];
            $so->so_type = 1;
            $so->so_userid = Auth::user()->id;
            $so->so_status = 1;
            if($request->stokril[$key] == $request->stoksisa[$key]){
                $so->so_keterangan = "Ada";

            }elseif($request->stokril[$key] < $request->stoksisa[$key]){
                $checkpenjualan = BarangTerjual::where('barangterjual_idproduk',$product->product_id)->get();
                if(count($checkpenjualan) > 0){
                    $qtyterjual = 0;
                    $channelterjual = array();
                    foreach($checkpenjualan as $cp){
                        $qtyterjual = $qtyterjual+$cp->barangterjual_qty;
                        $channelpenjualan = Penjualan::where('penjualan_id',$cp->barangterjual_idpenjualan)->get();
                        foreach($channelpenjualan as $ccp){
                            array_push($channelterjual, $ccp->penjualan_channel);
                        }
                    }
                        $so->so_keterangan = "Terjual ".$qtyterjual." di ".implode(',',$channelterjual);
                }else {
                    $so->so_keterangan = "Product Missing";
                }
            }
            $so->save();


        }

        return redirect('stokopname/laporan/'.$request->publishgroup);
    }
    public function updatesomingguan(Request $request)
    {
        foreach($request->product_skus as $key => $p){
                $updateso = StokOpname::where('so_sku',$p)->first();
                $product = Product::where('product_sku', $p)->first();
                $updateso->so_selisih = $request->selisih[$key];
                $updateso->so_stokterjual = $request->stokterjual[$key];
                $updateso->so_stokakhirreal = $request->stokril[$key];
                $updateso->so_status = 1;
                if($request->stokril[$key] == $request->stoksisa[$key]){
                    $updateso->so_keterangan = "Ada";

                }elseif($request->stokril[$key] < $request->stoksisa[$key]){
                    $checkpenjualan = BarangTerjual::where('barangterjual_idproduk',$product->product_id)->get();
                    if(count($checkpenjualan) > 0){
                        $qtyterjual = 0;
                        $channelterjual = array();
                        foreach($checkpenjualan as $cp){
                            $qtyterjual = $qtyterjual+$cp->barangterjual_qty;
                            $channelpenjualan = Penjualan::where('penjualan_id',$cp->barangterjual_idpenjualan)->get();
                            foreach($channelpenjualan as $ccp){
                                array_push($channelterjual, $ccp->penjualan_channel);
                            }
                        }
                            $updateso->so_keterangan = "Terjual ".$qtyterjual." di ".implode(',',$channelterjual);
                    }else {
                        $updateso->so_keterangan = "Product Missing";
                    }
                }
            $updateso->update();
            }

            return redirect('stokopname/laporan/'.$request->publishgroup);
    }

    public function pausesomingguan(Request $request)
    {

        $soprod = StokOpname::where('so_pubgroupname',$request->publishgroup)->get();
        if(count($soprod) > 0){
        foreach($request->product_skus as $key => $p){
                $updateso = StokOpname::where('so_sku',$p)->first();
                $product = Product::where('product_sku', $p)->first();
                $updateso->so_selisih = $request->selisih[$key];
                $updateso->so_stokterjual = $request->stokterjual[$key];
                $updateso->so_stokakhirreal = $request->stokril[$key];
                $updateso->so_status = 2;
                if($request->stokril[$key] == $request->stoksisa[$key]){
                    $updateso->so_keterangan = "Ada";

                }elseif($request->stokril[$key] < $request->stoksisa[$key]){
                    $checkpenjualan = BarangTerjual::where('barangterjual_idproduk',$product->product_id)->get();
                    if(count($checkpenjualan) > 0){
                        $qtyterjual = 0;
                        $channelterjual = array();
                        foreach($checkpenjualan as $cp){
                            $qtyterjual = $qtyterjual+$cp->barangterjual_qty;
                            $channelpenjualan = Penjualan::where('penjualan_id',$cp->barangterjual_idpenjualan)->get();
                            foreach($channelpenjualan as $ccp){
                                array_push($channelterjual, $ccp->penjualan_channel);
                            }
                        }
                            $so->so_keterangan = "Terjual ".$qtyterjual." di ".implode(',',$channelterjual);
                    }else {
                        $so->so_keterangan = "Product Missing";
                    }
                }
            $updateso->update();
            }
            }else {
                foreach($request->product_skus as $key => $p){
                    $so = new StokOpname;
                    $date = Carbon::now()->format('Y-m-d');
                    $so->so_date = $date;
                    $so->so_pubgroupname = $request->publishgroup;
                    $product = Product::where('product_sku', $p)->first();
                    $so->so_mastersku = $product->product_mastersku;
                    $so->so_sku = $p;
                    $so->so_stok = $product->product_stok;
                    $so->so_stokakhir = $product->product_stokakhir;
                    $so->so_stokterjual = $request->stokterjual[$key];
                    $so->so_selisih = $request->selisih[$key];
                    $so->so_stokakhirreal = $request->stokril[$key];
                    $so->so_type = 1;
                    $so->so_userid = Auth::user()->id;
                    $so->so_status = 2;
                    if($request->stokril[$key] == $request->stoksisa[$key]){
                        $so->so_keterangan = "Ada";

                    }elseif($request->stokril[$key] < $request->stoksisa[$key]){
                        $checkpenjualan = BarangTerjual::where('barangterjual_idproduk',$product->product_id)->get();
                        if(count($checkpenjualan) > 0){
                            $qtyterjual = 0;
                            $channelterjual = array();
                            foreach($checkpenjualan as $cp){
                                $qtyterjual = $qtyterjual+$cp->barangterjual_qty;
                                $channelpenjualan = Penjualan::where('penjualan_id',$cp->barangterjual_idpenjualan)->get();
                                foreach($channelpenjualan as $ccp){
                                    array_push($channelterjual, $ccp->penjualan_channel);
                                }
                            }
                                $so->so_keterangan = "Terjual ".$qtyterjual." di ".implode(',',$channelterjual);
                        }else {
                            $so->so_keterangan = "Product Missing";
                        }
                    }
                $so->save();
                }
            }

        return response()->json(['success'=>"SO Saved."]);
    }
    public function laporan($pubgroup)
    {
        $info = StokOpname::join('users','users.id','=','stokopname.so_userid')
        ->select('stokopname.*','users.name')
        ->where('stokopname.so_pubgroupname', $pubgroup)->first();
        $product = StokOpname::join('product','product.product_sku','stokopname.so_sku')
        ->join('size','size.size_id','product.product_idsize')
        ->select('stokopname.*','product.product_id','product.product_nama','product.product_stok','product.product_stokakhir','size.size_nama','product.product_mastersku','product.product_sku')
        ->where('stokopname.so_pubgroupname',$pubgroup)
        ->where('so_status',1)->get();

       // return $product;
        return view('stokopname.laporan')->with(compact('info','product'));
    }

    public function edit($id)
    {
        $edit = StokOpname::where('stokopname_id', $id)->first();

        return view('stokopname.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $stokopname = StokOpname::where('stokopname_id', $request->stokopname_id)->first();
        $update = collect($request->all());
        try {
        $stokopname->update($update->all());
        } catch (QE $e) {
            return $e;
        }
        notify()->success('Pengubahan Tipe Berhasil');
        return redirect('stokopname');
    }

    public function delete($id)
    {
        $stokopname = StokOpname::where('stokopname_id', $id)->first();

        try {
            $stokopname->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Tipe telah sukses dihapus !');

        return redirect('stokopname');
    }
}
