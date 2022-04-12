<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\BarangPublish;
use App\Models\Product;
use App\Models\StokOpname;
use App\Models\Penjualan;
use App\Models\BarangTerjual;
use App\Models\Size;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use PDF;

class StokOpnameController extends Controller
{
    public function generateRandomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

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

    public function pilihso(){
        return view('stokopname.select');
    }

    public function indexbulanan()
    {
        $riwayatso = StokOpname::where('so_type', 2)
        ->groupBy('so_pubgroupname')
        ->orderBy('so_date', 'DESC')->get();
        foreach($riwayatso as $key => $pub){
            $productcount = StokOpname::where('so_pubgroupname',$pub->so_pubgroupname)->count();
            $riwayatso[$key]['count'] = $productcount;
        }
         return view('stokopname.indexbulanan')->with(compact('riwayatso'));
    }

    public function sobulanan(Request $request){

        $query = Product::join('size','size.size_id','product.product_idsize')
        ->join('band','band.band_id','product.product_idband')
        ->select('product.*','size.size_nama','band.band_id','band.band_nama')
        ->where('product.product_stokakhir', '>', 0);

        if($request->get('band') == '' || $request->get('band') == NULL || $request->get('band') == 'All')
        {
        $band_selected = "";
        $query->whereRaw('band.band_nama LIKE "'.$band_selected.'%"');
        }else {
         $band_selected =  $request->get('band');
         if($band_selected == '0-9'){
            $query->whereRaw('band.band_nama LIKE "0%"');
            $query->orWhereRaw('band.band_nama LIKE "1%"');
            $query->orWhereRaw('band.band_nama LIKE "2%"');
            $query->orWhereRaw('band.band_nama LIKE "3%"');
            $query->orWhereRaw('band.band_nama LIKE "4%"');
            $query->orWhereRaw('band.band_nama LIKE "5%"');
            $query->orWhereRaw('band.band_nama LIKE "6%"');
            $query->orWhereRaw('band.band_nama LIKE "7%"');
            $query->orWhereRaw('band.band_nama LIKE "8%"');
            $query->orWhereRaw('band.band_nama LIKE "9%"');
         }else {
            $query->whereRaw('band.band_nama LIKE "'.$band_selected.'%"');
         }
        }

        if($request->get('size') == '' || $request->get('size') == NULL || $request->get('size') == 'All')
        {
        $size_selected = "";
        $query->whereRaw('size.size_nama LIKE "'.$size_selected.'%"');
        }else {
         $size_selected =  $request->get('size');
            $query->whereRaw('size.size_nama LIKE "'.$size_selected.'%"');
        }


        $product = $query->orderBy('band_nama','ASC')->get();
        foreach($product as $key => $p){
            $penjualan = BarangTerjual::where('barangterjual_idproduk',$p->product_id)->get();
            $count = 0;
            foreach($penjualan as $pp){
                $count = $count + (int) $pp->barangterjual_qty;
            }
            $product[$key]["stokterjual"] = $count;
        }

        foreach($product as $key => $p){
            $penjualan = BarangTerjual::where('barangterjual_idproduk',$p->product_id)->get();

            $count = 0;
            foreach($penjualan as $pp){
                $count = $count + (int) $pp->barangterjual_qty;
            }
            $product[$key]["stokterjual"] = $count;
        }

        $size = Size::get();

        return view('stokopname.sobulanan')->with(compact('product','band_selected','size','size_selected'));
        // return $product->toSql();
    }

    // public function somingguan($pubgroup){
    //     $pubdata = BarangPublish::join('product','product.product_id','publish.publish_productid')
    //     ->join('size','size.size_id','product.product_idsize')
    //     ->join('band','band.band_id','product.product_idband')
    //     ->select('publish.*','product.product_id','product.product_nama','band.band_id','band.band_nama','product.product_stoktoko','product.product_stok','product.product_stokakhir','size.size_id','size.size_nama','product.product_mastersku','product.product_sku')
    //     ->where('publish_groupid',$pubgroup)
    //     ->orderBy('product.product_nama','ASC')
    //     ->orderBy('size.size_id','ASC')->get();
    //     foreach($pubdata as $key => $p){
    //         $from = Carbon::parse($p->publish_tanggal)->format('Y-m-d');
    //         $to = Carbon::parse($p->publish_tanggal)->addDays(7)->format('Y-m-d');
    //         $penjualan = BarangTerjual::where('barangterjual_idproduk',$p->product_id)
    //         ->whereBetween('barangterjual_tanggalwaktubarangterjual', [$from, $to])->get();

    //         $count = 0;
    //         foreach($penjualan as $pp){
    //             $count = $count + (int) $pp->barangterjual_qty;
    //         }
    //         $pubdata[$key]["stokterjual"] = $count;
    //     }

    //     $pub = $pubgroup;
    //     return view('stokopname.somingguan')->with(compact('pubdata','pub'));
    //  }

    //  public function resumesomingguan($pubgroup){
    //     $pubdata = StokOpname::join('product','product.product_sku','stokopname.so_sku')
    //     ->join('size','size.size_id','product.product_idsize')
    //     ->join('band','band.band_id','product.product_idband')
    //     ->select('stokopname.*','product.product_id','product.product_nama','product.product_stok','product.product_stokakhir','size.size_id','size.size_nama','product.product_mastersku','product.product_sku','band.band_id','band.band_nama')
    //     ->where('stokopname.so_pubgroupname',$pubgroup)
    //     ->orderBy('product.product_nama','ASC')
    //     ->orderBy('size.size_id','ASC')->get();
    //     foreach($pubdata as $key => $p){
    //         $from = Carbon::parse($p->publish_tanggal)->format('Y-m-d');
    //         $to = Carbon::parse($p->publish_tanggal)->addDays(7)->format('Y-m-d');
    //         $penjualan = BarangTerjual::where('barangterjual_idproduk',$p->product_id)
    //         ->whereBetween('barangterjual_tanggalwaktubarangterjual', [$from, $to])->get();

    //         $count = 0;
    //         foreach($penjualan as $pp){
    //             $count = $count + (int) $pp->barangterjual_qty;
    //         }
    //         $pubdata[$key]["stokterjual"] = $count;
    //     }
    //     $soinfo = StokOpname::where('stokopname.so_pubgroupname',$pubgroup)->first();
    //     $pub = $pubgroup;
    //     return view('stokopname.resumemingguan')->with(compact('pubdata','pub','soinfo'));
    //  }

     public function resumesobulanan($pubgroup){
        $pubdata = StokOpname::join('product','product.product_sku','stokopname.so_sku')
        ->join('size','size.size_id','product.product_idsize')
        ->join('band','band.band_id','product.product_idband')
        ->select('stokopname.*','product.product_id','product.product_nama','product.product_stok','product.product_stokakhir','size.size_nama','product.product_mastersku','product.product_sku','band.band_id','band.band_nama')
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
        return view('stokopname.resumebulanan')->with(compact('pubdata','pub'));
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
        $info = StokOpname::where('stokopname.so_pubgroupname', $pubgroup)->first();
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
        $pdf = PDF::loadView('stokopname.laporanpdf', compact('data','info'));
        return $pdf->download('laporan-so-'.$pubgroup.'-'.$info->so_date.$info->so_type.'.pdf');

        // return view('stokopname.laporanpdf')->with(compact('product','info'));
    }
    // public function storesomingguan(Request $request)
    // {
    //     foreach($request->product_skus as $key => $p){
    //         $so = new StokOpname;
    //         $date = Carbon::parse($request->so_date)->format('Y-m-d');
    //         $so->so_date = $date;
    //         $so->so_pubgroupname = $request->publishgroup;
    //         $product = Product::where('product_sku', $p)->first();
    //         $publish = BarangPublish::where('publish_productid', $product->product_id)->where('publish_groupid', $request->publishgroup)->first();
    //         $so->so_mastersku = $product->product_mastersku;
    //         $so->so_sku = $p;
    //         $so->so_stok = $publish->publish_stok;
    //         $so->so_stokakhir = $publish->publish_stokakhir;
    //         $so->so_stokterjual = $request->stokterjual[$key];
    //         $so->so_selisih = (int) $publish->publish_stokakhir - (int) $request->stokril[$key];
    //         $so->so_stokakhirreal = $request->stokril[$key];
    //         $so->so_type = 1;
    //         $so->so_userid = $request->so_userid;
    //         $so->so_status = 1;
    //         if($request->stokril[$key] == $request->stokakhir[$key]){
    //             $so->so_keterangan = "Ada";

    //         }elseif($request->stokril[$key] < $request->stokakhir[$key]){
    //             $from = Carbon::parse($publish->publish_tanggal)->format('Y-m-d');
    //             $to = Carbon::parse($publish->publish_tanggal)->addDays(7)->format('Y-m-d');
    //             $checkpenjualan = BarangTerjual::where('barangterjual_idproduk',$product->product_id)
    //             ->whereBetween('barangterjual_tanggalwaktubarangterjual', [$from, $to])->get();
    //             if(count($checkpenjualan) > 0){
    //                 $qtyterjual = 0;
    //                 $channelterjual = array();
    //                 foreach($checkpenjualan as $cp){
    //                     $qtyterjual = $qtyterjual+$cp->barangterjual_qty;
    //                     $channelpenjualan = Penjualan::where('penjualan_id',$cp->barangterjual_idpenjualan)->get();
    //                     foreach($channelpenjualan as $ccp){
    //                         array_push($channelterjual, $ccp->penjualan_channel);
    //                     }
    //                 }
    //                     $so->so_keterangan = "Terjual ".$qtyterjual." di ".implode(',',$channelterjual);
    //             }else {
    //                 $so->so_keterangan = "Missing";
    //             }
    //         }
    //         $so->save();


    //     }

    //     return redirect('stokopname/laporan/'.$request->publishgroup);
    // }

    public function updatesobulanan(Request $request){

        $rand = mt_rand(1,9999).$this->generateRandomString(5);
        foreach($request->product_skus as $key => $p){
            $product = StokOpname::where('so_sku', $p)->where('so_type',2)->where('so_date',$request->so_date)->where('so_status')->first();
            if(!$product && $product != NULL){
                $so = new StokOpname;
                $date = Carbon::now()->format('Y-m-d');
                $so->so_date = $date;
                $so->so_pubgroupname = $rand;
                $product = Product::where('product_sku', $p)->first();
                $so->so_mastersku = $product->product_mastersku;
                $so->so_sku = $p;
                $so->so_stok = $product->product_stok;
                $so->so_stokakhir = $product->product_stokakhir;
                $so->so_stokterjual = $request->stokterjual[$key];
                $so->so_selisih = (int)$product->publish_stokakhir - (int) $request->stokril[$key];
                $so->so_stokakhirreal = $request->stokril[$key];
                $so->so_type = 2;
                $so->so_userid = $request->so_userid;
                $so->so_namaso = $request->so_namaso;
                $so->so_char = $request->so_char;
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
                        $so->so_keterangan = "Missing";
                    }
                }
                $so->save();
            }else {
                $so = StokOpname::where('so_sku',$p)->first();
                $product = Product::where('product_sku', $p)->first();
                $so->so_stokterjual = $request->stokterjual[$key];
                $so->so_stokakhirreal = $request->stokril[$key];
                $so->so_selisih = (int) $product->publish_stokakhir - (int) $request->stokril[$key];
                $so->so_status = 1;
                $so->so_type = 2;
                $so->so_namaso = $request->so_namaso;
                $so->so_char = $request->so_char;
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
                        $so->so_keterangan = "Missing";
                    }
                }
            $so->update();
            }



        }

        return redirect('stokopname/laporan/'.$so->so_pubgroupname);
    }

    public function storesobulanan(Request $request)
    {
        $rand = mt_rand(1,9999).$this->generateRandomString(5);
        foreach($request->product_skus as $key => $p){
            $product = StokOpname::where('so_sku', $p)->where('so_type',2)->where('so_date',$request->so_date)->where('so_status')->first();
            if(!$product){
                $so = new StokOpname;
                $date = Carbon::now()->format('Y-m-d');
                $so->so_date = $date;
                $so->so_pubgroupname = $rand;
                $product = Product::where('product_sku', $p)->first();
                $so->so_mastersku = $product->product_mastersku;
                $so->so_sku = $p;
                $so->so_stok = $product->product_stok;
                $so->so_stokakhir = $product->product_stokakhir;
                $so->so_stokterjual = $request->stokterjual[$key];
                $so->so_selisih = (int)$product->publish_stokakhir - (int) $request->stokril[$key];$request->selisih[$key];
                $so->so_stokakhirreal = $request->stokril[$key];
                $so->so_type = 2;
                $so->so_userid = Auth::user()->id;
                $so->so_namaso = $request->so_namaso;
                $so->so_char = $request->so_char;
                $so->so_size = $request->so_size;
                $so->so_stoktoko = $request->so_stoktoko;
                $so->so_stokgudang = $request->so_stokgudang;
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
                        $so->so_keterangan = "Missing";
                    }
                }
                $so->save();
            }else {
                $so = StokOpname::where('so_sku',$p)->first();
                $product = Product::where('product_sku', $p)->first();
                $so->so_selisih = (int)$product->publish_stokakhir - (int) $request->stokril[$key];
                $so->so_stokterjual = $request->stokterjual[$key];
                $so->so_stokakhirreal = $request->stokril[$key];
                $so->so_status = 1;
                $so->so_namaso = $request->so_namaso;
                $so->so_char = $request->so_char;
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
                        $so->so_keterangan = "Missing";
                    }
                }
            $so->update();
            }



        }

        return redirect('stokopname/laporan/'.$so->so_pubgroupname);
    }

    public function updatesomingguan(Request $request)
    {
        foreach($request->product_skus as $key => $p){
                $updateso = StokOpname::where('so_sku',$p)->first();
                $product = Product::where('product_sku', $p)->first();
                $updateso->so_selisih = (int)$product->publish_stokakhir - (int) $request->stokril[$key];
                $updateso->so_stokterjual = $request->stokterjual[$key];
                $updateso->so_stokakhirreal = $request->stokril[$key];
                $updateso->so_status = 1;
                $date = Carbon::parse($request->so_date)->format('Y-m-d');
                $updateso->so_date = $date;
                $updateso->so_userid = $request->so_userid;
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
                        $updateso->so_keterangan = "Missing";
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
                $updateso->so_selisih = (int)$product->publish_stokakhir - (int) $request->stokril[$key];
                $updateso->so_stokterjual = $request->stokterjual[$key];
                $updateso->so_stokakhirreal = $request->stokril[$key];
                if($updateso->so_status == 1){
                $updateso->so_status = 1;
                }else {
                    $updateso->so_status = 2;
                }
                $date = Carbon::parse($request->so_date)->format('Y-m-d');
                $updateso->so_date = $date;
                $updateso->so_userid = $request->so_userid;
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
                       $updateso->so_keterangan = "Missing";
                    }
                }
            $updateso->update();
            }
            }else {
                foreach($request->product_skus as $key => $p){
                    $so = new StokOpname;
                    $date = Carbon::parse($request->so_date)->format('Y-m-d');
                    $so->so_date = $date;
                    $so->so_pubgroupname = $request->publishgroup;
                    $product = Product::where('product_sku', $p)->first();
                    $so->so_mastersku = $product->product_mastersku;
                    $so->so_sku = $p;
                    $so->so_stok = $product->product_stok;
                    $so->so_stokakhir = $product->product_stokakhir;
                    $so->so_stokterjual = $request->stokterjual[$key];
                    $so->so_selisih = (int)$product->publish_stokakhir - (int) $request->stokril[$key];
                    $so->so_stokakhirreal = $request->stokril[$key];
                    $so->so_type = 1;
                    $so->so_userid = $request->so_userid;
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
                            $so->so_keterangan = "Missing";
                        }
                    }
                $so->save();
                }
            }

        return response()->json(['success'=>"SO Saved."]);
    }

    public function pausesobulanan(Request $request)
    {
        $rand = mt_rand(1,9999).$this->generateRandomString(5);
        foreach($request->product_skus as $key => $p){
            $product = StokOpname::where('so_sku', $p)->where('so_type',2)->where('so_date',$request->so_date)->where('so_status')->first();
            if($product){
                $product->so_selisih = (int)$product->publish_stokakhir - (int) $request->stokril[$key];
                $product->so_stokterjual = $request->stokterjual[$key];
                $product->so_stokakhirreal = $request->stokril[$key];
                $product->so_status = 2;
                if($request->stokril[$key] == $request->stoksisa[$key]){
                    $product->so_keterangan = "Ada";

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
                        $product->so_keterangan = "Terjual ".$qtyterjual." di ".implode(',',$channelterjual);
                    }else {
                        $product->so_keterangan = "Missing";
                    }
                }
            $product->update();
            }else {
                $so = new StokOpname;
                $date = Carbon::now()->format('Y-m-d');
                $so->so_date = $date;
                $so->so_pubgroupname = $rand;
                $product = Product::where('product_sku', $p)->first();
                $so->so_mastersku = $product->product_mastersku;
                $so->so_sku = $p;
                $so->so_stok = $product->product_stok;
                $so->so_stokakhir = $product->product_stokakhir;
                $so->so_stokterjual = $request->stokterjual[$key];
                $so->so_selisih = (int)$product->publish_stokakhir - (int) $request->stokril[$key];
                $so->so_stokakhirreal = $request->stokril[$key];
                $so->so_type = 2;
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
                        $so->so_keterangan = "Missing";
                    }
                }
            $so->save();
            }
        }

        return response()->json(['success'=>"SO Saved."]);
    }
    public function laporan($pubgroup)
    {
        $info = StokOpname::select('stokopname.*')
        ->where('stokopname.so_pubgroupname', $pubgroup)->first();
        $product = StokOpname::join('product','product.product_sku','stokopname.so_sku')
        ->join('size','size.size_id','product.product_idsize')
        ->join('band','band.band_id','product.product_idband')
        ->select('stokopname.*','band.band_id','band.band_nama','product.product_id','product.product_nama','product.product_stok','product.product_stokakhir','size.size_id','size.size_nama','product.product_mastersku','product.product_sku')
        ->where('stokopname.so_pubgroupname',$pubgroup)
        ->orderBy('product.product_nama','ASC')
        ->orderBy('size.size_id','ASC')
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
