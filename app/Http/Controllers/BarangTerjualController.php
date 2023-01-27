<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Product;
use App\Models\Penjualan;
use App\Models\BarangPublish;
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
use DB;
class BarangTerjualController extends Controller
{
    public function index(){
        $barangterjual = BarangTerjual::join('penjualan','penjualan.penjualan_id','=','barangterjual.barangterjual_idpenjualan')
        ->join('product','product.product_id','=','barangterjual.barangterjual_idproduk')
        ->join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','penjualan.*','barangterjual.*','size.size_nama','band.band_nama')
        ->where('barangterjual.barangterjual_tanggalwaktubarangterjual', '!=', null)
        ->where('barangterjual.barangterjual_idpenjualan', '!=', null)
        ->get();

        return view('barangterjual.index')->with(compact('barangterjual'));

    }
    public function laporan(Request $request){
        if($request->get('bulan') != "" | !empty($request->get('bulan'))){
            $bulan = $request->get('bulan');
        }else {
            $bulan = "Now";
        }

        if($request->get('tahun') != "" | !empty($request->get('tahun'))){
            $tahun = $request->get('tahun');
        }else {
            $tahun = "Now";
        }

        if($request->get('bulan') == "All"){
            $bulan = "All";
        }

        if($request->get('tahun') == "All"){
            $tahun = "All";
        }

        $selected_month =  $bulan == "Now"? Carbon::now()->format('m'):$bulan;
        $selected_year =  $tahun == "Now"? Carbon::now()->format('Y'):$tahun;

        $laporanproduk = BarangTerjual::join('product','product.product_id','=','barangterjual.barangterjual_idproduk')
        ->join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.product_nama', 'size.size_nama','band.band_nama', DB::Raw('SUM(barangterjual.barangterjual_qty) as jumlahterjual'), 'product.product_sku')
        ->where('product.product_idband', '!=', '627')
        ->where('product.product_idband', '!=', '628');
        if($selected_month && $selected_month != "All"){
            $laporanproduk->whereRaw('MONTH(barangterjual.created_at) = '.$selected_month);
        }
        if($selected_year && $selected_year != "All"){
            $laporanproduk->whereRaw('YEAR(barangterjual.created_at) = '.$selected_year);
        }
        $laporanproduk->groupBy('barangterjual.barangterjual_idproduk');
        $laporanproduk->orderBy('jumlahterjual','DESC');
        $laporanproduk->limit(50);
        $laporanproduk = $laporanproduk->get();

        $laporanband = BarangTerjual::join('product','product.product_id','=','barangterjual.barangterjual_idproduk')
        ->join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('band.band_nama','band.band_code', DB::Raw('SUM(barangterjual.barangterjual_qty) as jumlahterjual'))
        ->where('product.product_idband', '!=', '627')
        ->where('product.product_idband', '!=', '628');

        if($selected_month && $selected_month != "All"){
            $laporanband->whereRaw('MONTH(barangterjual.created_at) = '.$selected_month);
        }
        if($selected_year && $selected_year != "All"){
            $laporanband->whereRaw('YEAR(barangterjual.created_at) = '.$selected_year);
        }
        $laporanband->groupBy('band.band_id');
        $laporanband->orderBy('jumlahterjual','DESC');

        $laporanband->limit(50);
        $laporanband = $laporanband->get();

        return view('barangterjual.laporan')->with(compact('selected_month','selected_year','laporanproduk','laporanband'));
        // return $laporanband;
    }
}
