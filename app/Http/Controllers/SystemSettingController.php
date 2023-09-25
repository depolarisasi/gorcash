<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;

class SystemSettingController extends Controller
{
    public function index()
    {
        $setting = SystemSetting::orderBy('setting_id','ASC')->get();
        return view('setting.index')->with(compact('setting'));
    }

    public function create()
    {
        return view('setting.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        SystemSetting::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Berhasil Membuat Setting Baru','success');
        return redirect('setting');
    }

    public function show($id)
    {
        $show = SystemSetting::where('setting_id', $id)->first();

        return view('setting.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = SystemSetting::where('setting_id', $id)->first();

        return view('setting.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $setting = SystemSetting::where('setting_id', $request->setting_id)->first();
        $update = collect($request->all());
        try {
        $setting->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Setting Berhasil','success');
        return redirect('setting');
    }

    public function delete($id)
    {
        $setting = SystemSetting::where('setting_id', $id)->first();

        try {
            $setting->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Setting Berhasil Dihapus!','success');

        return redirect('setting');
    }
}
