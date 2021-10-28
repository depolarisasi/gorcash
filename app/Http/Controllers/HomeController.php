<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    public function dashboard(){
        return view('index');
    }
}
