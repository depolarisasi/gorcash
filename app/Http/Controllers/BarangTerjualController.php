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

class BarangTerjualController extends Controller
{
    public function index(){
        $barangterjual = BarangTerjual::join('penjualan','penjualan.penjualan_id','=','barangterjual.barangterjual_idpenjualan')
        ->join('product','product.product_id','=','barangterjual.barangterjual_idproduk')
        ->select('product.*','penjualan.*','barangterjual.*')
        ->get();

        return view('barangterjual.index')->with(compact('barangterjual'));

    }
}
