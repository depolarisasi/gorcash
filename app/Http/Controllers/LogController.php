<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;
use App\Models\User;
use Auth;
class LogController extends Controller
{
    public function index(){
        $logs = Logs::join('users','users.id','=','log.log_userid')
        ->select('log.*','users.*')
        ->orderBy('log.log_tanggal','DESC')
        ->get();
        return view('log.index')->with(compact('logs'));
    }
}
