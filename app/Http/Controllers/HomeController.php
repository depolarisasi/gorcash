<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \Carbon\Carbon;
use App\Models\Notes;
use RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    public function dashboard(){
        $note = Notes::limit(9)->get();
        // $today = Carbon::now()->setTimezone('Asia/Jakarta')->isoFormat('dddd');
        $today = "Saturday";
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
        return view('index')->with(compact('note','workflow'));
    }
}
