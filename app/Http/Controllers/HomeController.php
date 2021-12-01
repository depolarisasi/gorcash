<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \Carbon\Carbon;
use App\Models\Notes;
use App\Models\Agenda;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    public function dashboard(){
        $produkstokrendah = Product::join('size','size.size_id','=','product.product_idsize')
        ->join('band','band.band_id','=','product.product_idband')
        ->select('product.*','size.size_id','size.size_nama','band.band_id','band.band_nama')
        ->where('product_stok','=',0)->limit(10)->get();
        $note = Notes::where('note_judul','NOT LIKE','%Workflow%')->limit(9)->get();
        $agenda = Agenda::limit(9)->get();
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->isoFormat('dddd');
       // $today = "Saturday";
        if($today == "Sunday"){
         $workflow = Notes::where('note_judul','LIKE','%Workflow Minggu%')->first();
        }elseif($today == "Monday"){
         $workflow = Notes::where('note_judul','LIKE','%Workflow Senin%')->first();
        }elseif($today == "Tuesday"){
         $workflow = Notes::where('note_judul','LIKE','%Workflow Selasa%')->first();
        }elseif($today == "Wednesday"){
         $workflow = Notes::where('note_judul','LIKE','%Workflow Rabu%')->first();
        }elseif($today == "Thursday"){
         $workflow = Notes::where('note_judul','LIKE','%Workflow Kamis%')->first();
        }elseif($today == "Friday"){
         $workflow = Notes::where('note_judul','LIKE','%Workflow Jumat%')->first();
        }elseif($today == "Saturday"){
         $workflow = Notes::where('note_judul','LIKE','%Workflow Sabtu%')->first();
        }
        return view('index')->with(compact('note','workflow','agenda','produkstokrendah'));
      //return $produkstokrendah;
    }

    public function salesreport(){

    }
}
