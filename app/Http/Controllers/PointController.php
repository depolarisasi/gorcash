<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Point;
use App\Models\PointLog;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use PDF;


class PointController extends Controller
{
    public function index(){
        $point = PointLog::join('customer', 'points_log.user_id', '=', 'customer.customer_id')
        ->orderBy('points_log.date','DESC')->get();
        return view('point.index')->with(compact('point'));
    }

    public function customer(){
        $customer = Customer::orderBy('customer.created_at','DESC')->get();
        return view('point.customer')->with(compact('customer'));
    }

    public function customeradd(Request $request){
        $store = collect($request->all());
        try {
        Customer::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Member Berhasil');
        return redirect('customer');
    }


    public function show($id)
    {
        $show = Color::where('color_id', $id)->first();

        return view('color.show')->with(compact('show'));
    }

    public function customeredit($id)
    {
        $edit = Customer::where('customer_id', $id)->first();

        return view('point.editcustomer')->with(compact('edit'));
    }

    public function customerupdate(Request $request)
    {
        $customer = Customer::where('customer_id', $request->customer_id)->first();
        $update = collect($request->all());
        try {
        $admin = User::where('id',Auth::user()->id)->first();
        if($customer->customer_points > $request->customer_points)
        {
            $point =  $request->customer_points - $customer->customer_points;
        }else {
            $point = $request->customer_points - $customer->customer_points ;
        }
        $status = $point > 0?' menambahkan':' mengurangi';
        PointLog::create([
        'user_id' => $request->customer_id,
        'points' => $point,
        'type' => 2,
        'admin_user_id' => Auth::user()->id,
        'data' => 'Admin '. $admin->name . $status.' point sebesar '. $point,
        'date' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d')]);

        $customer->update($update->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Pengubahan Member Berhasil');
        return redirect('customer');
    }

    public function deletecustomer($id)
    {
        $customer = Customer::where('customer_id', $id)->first();

        try {
            $customer->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Member telah sukses dihapus !');

        return redirect('customer');
    }

}
