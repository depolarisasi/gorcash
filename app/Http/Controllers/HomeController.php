<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Notes;
use App\Models\Penjualan;
use App\Models\Agenda;
use App\Models\Product;
use App\Models\BarangTerjual;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
class HomeController extends Controller
{
    public function dashboard(){
        $produkstokrendah = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product_stok','=',0)->orderBy('updated_at','DESC')->limit(10)->get();
        $note = Notes::where('note_judul','NOT LIKE','%Workflow%')->limit(9)->get();
        $agenda = Agenda::limit(9)->get();
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->isoFormat('dddd');
        $todaydate = Carbon::now()->setTimezone('Asia/Jakarta');
       // $today = "Saturday";
        // if($today == "Sunday"){
        //  $workflow = Notes::where('note_judul','LIKE','%Workflow Minggu%')->first();
        // }elseif($today == "Monday"){
        //  $workflow = Notes::where('note_judul','LIKE','%Workflow Senin%')->first();
        // }elseif($today == "Tuesday"){
        //  $workflow = Notes::where('note_judul','LIKE','%Workflow Selasa%')->first();
        // }elseif($today == "Wednesday"){
        //  $workflow = Notes::where('note_judul','LIKE','%Workflow Rabu%')->first();
        // }elseif($today == "Thursday"){
        //  $workflow = Notes::where('note_judul','LIKE','%Workflow Kamis%')->first();
        // }elseif($today == "Friday"){
        //  $workflow = Notes::where('note_judul','LIKE','%Workflow Jumat%')->first();
        // }elseif($today == "Saturday"){
        //  $workflow = Notes::where('note_judul','LIKE','%Workflow Sabtu%')->first();
        // }



        $periodweek = CarbonPeriod::create(Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $periodmonth = CarbonPeriod::create(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $weeklydates = [];
        $monthlydates = [];
        $dateweek = [];
        $datemonth = [];
        foreach($periodweek as $p){
            array_push($weeklydates, $p->format('d M Y'));
            array_push($dateweek, $p->format('Y-m-d'));
        }
        foreach($periodmonth as $pm){

            array_push($monthlydates, $pm->format('d M Y'));
            array_push($datemonth, $pm->format('Y-m-d'));
        }

        $weeklydate = json_encode($weeklydates);
        $monthlydate = json_encode($monthlydates);

        $weeklysales = [];
        $monthlysales = [];
        $weeklyproductsales = BarangTerjual::whereIn(DB::raw("DATE(barangterjual_tanggalwaktubarangterjual)"),$dateweek)->sum('barangterjual_qty');
        $weeklyproduct = [];
        $monthlyproduct = [];
        $totaltoday = Penjualan::whereDate('penjualan_tanggalwaktupenjualan', $todaydate)->sum('penjualan_paymenttotal');
        $totalweekly = Penjualan::whereBetween(DB::raw('DATE(penjualan_tanggalwaktupenjualan)'),[Carbon::now()->setTimezone('Asia/Jakarta')->startOfWeek()->format('Y-m-d'),Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')])->sum('penjualan_totalpendapatan');
        $totalmonthly = Penjualan::whereBetween(DB::raw('DATE(penjualan_tanggalwaktupenjualan)'),[Carbon::now()->setTimezone('Asia/Jakarta')->startOfMonth()->format('Y-m-d'),Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')])->sum('penjualan_totalpendapatan');
        $weeklypendapatan = 0;
        $monthlypendapatan = 0;
        $producttoday = BarangTerjual::whereDate('barangterjual_tanggalwaktubarangterjual', $todaydate)->sum('barangterjual_qty');
        $totproductweek = BarangTerjual::whereBetween(DB::raw('DATE(barangterjual_tanggalwaktubarangterjual)'),[Carbon::now()->setTimezone('Asia/Jakarta')->startOfWeek()->format('Y-m-d'),Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')])->sum('barangterjual_qty');
        $totproductmonth = BarangTerjual::whereBetween(DB::raw('DATE(barangterjual_tanggalwaktubarangterjual)'),[Carbon::now()->setTimezone('Asia/Jakarta')->startOfMonth()->format('Y-m-d'),Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')])->sum('barangterjual_qty');


        $productweek = 0;
        $productmonth = 0;
        foreach($dateweek as $dw){
            $sales = Penjualan::whereDate('penjualan_tanggalwaktupenjualan',$dw)->get();
            $products = BarangTerjual::whereDate('barangterjual_tanggalwaktubarangterjual',$dw)->get();
            array_push($weeklysales, $sales?$sales->sum('penjualan_totalpendapatan'):0);
            array_push($weeklyproduct, $products?$products->sum('barangterjual_qty'):0);
        }
        foreach($datemonth as $dw){
            $sales = Penjualan::whereDate('penjualan_tanggalwaktupenjualan',$dw)->get();
            $products = BarangTerjual::whereDate('barangterjual_tanggalwaktubarangterjual',$dw)->get();
            array_push($monthlysales, $sales?$sales->sum('penjualan_totalpendapatan'):0);
            array_push($monthlyproduct, $products?$products->sum('barangterjual_qty'):0);
        }

        $salesweekly = json_encode($weeklysales);
        $productweekly = json_encode($weeklyproduct);
        $productmonthly = json_encode($monthlyproduct);
        $salesmonthly= json_encode($monthlysales);

        $recentsales = BarangTerjual::join('product','product.product_id','=','barangterjual.barangterjual_idproduk')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.product_nama','product.product_foto','product.product_hargajual','barangterjual.*','band.band_nama')
        ->orderBy('barangterjual.barangterjual_tanggalwaktubarangterjual','DESC')->limit(10)->get();
        $pendapatanthismonth = Penjualan::whereMonth('penjualan_tanggalwaktupenjualan',Carbon::now()->setTimezone('Asia/Jakarta')->format('m'))->sum('penjualan_totalpendapatan');
        $diskonthismonth = Penjualan::whereMonth('penjualan_tanggalwaktupenjualan',Carbon::now()->setTimezone('Asia/Jakarta')->format('m'))->sum('penjualan_diskon');
        $potonganthismonth = Penjualan::whereMonth('penjualan_tanggalwaktupenjualan',Carbon::now()->setTimezone('Asia/Jakarta')->format('m'))->sum('penjualan_totalpotongan');
        $dataproporsi = json_encode([$pendapatanthismonth, $diskonthismonth, $potonganthismonth]);

        return view('index')->with(compact('note','agenda','produkstokrendah','totaltoday','totproductweek','totproductmonth','producttoday','weeklyproduct','productmonthly','productweek','monthlyproduct','dataproporsi','weeklydate','salesweekly','totalweekly','monthlydate','salesmonthly','totalmonthly','recentsales','productweekly','weeklyproductsales','recentsales'));
    //   return $dateweek;
    }

    public function salesreport(){

        $periodweek = CarbonPeriod::create(Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $periodmonth = CarbonPeriod::create(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $weeklydates = [];
        $monthlydates = [];
        $dateweek = [];
        $datemonth = [];
        foreach($periodweek as $p){
            array_push($weeklydates, $p->format('d M Y'));
            array_push($dateweek, $p->format('Y-m-d'));
        }
        foreach($periodmonth as $pm){

            array_push($monthlydates, $pm->format('d M Y'));
            array_push($datemonth, $pm->format('Y-m-d'));
        }

        $weeklydate = json_encode($weeklydates);
        $monthlydate = json_encode($monthlydates);

        $weeklysales = [];
        $monthlysales = [];
        $weeklyproductsales = BarangTerjual::whereIn('barangterjual_tanggalwaktubarangterjual',$dateweek)->sum('barangterjual_qty');
        $weeklyproduct = [];
        $monthlyproduct = [];
        $totaltoday = Penjualan::where('penjualan_tanggalwaktupenjualan',Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->sum('penjualan_paymenttotal');
        $totalweekly = Penjualan::whereBetween('penjualan_tanggalwaktupenjualan',[Carbon::now()->setTimezone('Asia/Jakarta')->startOfWeek()->format('Y-m-d'),Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')])->sum('penjualan_totalpendapatan');
        $totalmonthly = Penjualan::whereBetween('penjualan_tanggalwaktupenjualan',[Carbon::now()->setTimezone('Asia/Jakarta')->startOfMonth()->format('Y-m-d'),Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')])->sum('penjualan_totalpendapatan');
        $weeklypendapatan = 0;
        $monthlypendapatan = 0;
        $producttoday = BarangTerjual::where('barangterjual_tanggalwaktubarangterjual',Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->sum('barangterjual_qty');
        $totproductweek = BarangTerjual::whereBetween('barangterjual_tanggalwaktubarangterjual',[Carbon::now()->setTimezone('Asia/Jakarta')->startOfWeek()->format('Y-m-d'),Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')])->sum('barangterjual_qty');
        $totproductmonth = BarangTerjual::whereBetween('barangterjual_tanggalwaktubarangterjual',[Carbon::now()->setTimezone('Asia/Jakarta')->startOfMonth()->format('Y-m-d'),Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')])->sum('barangterjual_qty');


        $productweek = 0;
        $productmonth = 0;
        foreach($dateweek as $dw){
            $sales = Penjualan::where('penjualan_tanggalwaktupenjualan',$dw)->get();
            $products = BarangTerjual::where('barangterjual_tanggalwaktubarangterjual',$dw)->get();
            array_push($weeklysales, $sales?$sales->sum('penjualan_totalpendapatan'):0);
            array_push($weeklyproduct, $products?$products->sum('barangterjual_qty'):0);
        }
        foreach($datemonth as $dw){
            $sales = Penjualan::where('penjualan_tanggalwaktupenjualan',$dw)->get();
            $products = BarangTerjual::where('barangterjual_tanggalwaktubarangterjual',$dw)->get();
            array_push($monthlysales, $sales?$sales->sum('penjualan_totalpendapatan'):0);
            array_push($monthlyproduct, $products?$products->sum('barangterjual_qty'):0);
        }

        $salesweekly = json_encode($weeklysales);
        $productweekly = json_encode($weeklyproduct);
        $productmonthly = json_encode($monthlyproduct);
        $salesmonthly= json_encode($monthlysales);

        $recentsales = BarangTerjual::join('product','product.product_id','=','barangterjual.barangterjual_idproduk')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.product_nama','product.product_foto','product.product_hargajual','barangterjual.*','band.band_nama')
        ->orderBy('barangterjual.barangterjual_tanggalwaktubarangterjual','DESC')->limit(10)->get();
        $pendapatanthismonth = Penjualan::whereMonth('penjualan_tanggalwaktupenjualan',Carbon::now()->setTimezone('Asia/Jakarta')->format('m'))->sum('penjualan_totalpendapatan');
        $diskonthismonth = Penjualan::whereMonth('penjualan_tanggalwaktupenjualan',Carbon::now()->setTimezone('Asia/Jakarta')->format('m'))->sum('penjualan_diskon');
        $potonganthismonth = Penjualan::whereMonth('penjualan_tanggalwaktupenjualan',Carbon::now()->setTimezone('Asia/Jakarta')->format('m'))->sum('penjualan_totalpotongan');
        $dataproporsi = json_encode([$pendapatanthismonth, $diskonthismonth, $potonganthismonth]);

        return view('laporan')->with(compact('totaltoday','totproductweek','totproductmonth','producttoday','weeklyproduct','productmonthly','productweek','monthlyproduct','dataproporsi','weeklydate','salesweekly','totalweekly','monthlydate','salesmonthly','totalmonthly','recentsales','productweekly','weeklyproductsales','recentsales'));
        // return $weeklyproduct;
    }
}
