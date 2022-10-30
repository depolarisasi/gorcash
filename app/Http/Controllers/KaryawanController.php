<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Auth;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::join('users','users.id','=','karyawan.karyawan_userid')
        ->select('karyawan.*','users.name','users.email')
        ->get();
        return view('karyawan.index')->with(compact('karyawan'));
    }

    public function create()
    {
        $use = User::get();
        return view('karyawan.new')->with(compact('use'));
    }

    public function store(Request $request)
    { 
        $data = collect($request->all());

        try {
            Karyawan::create($data->all()); 
        } catch (QE $e) {
            toast('Database Error','error');

            return redirect()->back();
        } 
        toast('Karyawan Berhasil Dibuat','success'); 
        return redirect('karyawan');
    }

    public function show($id)
    {
        $show = Karyawan::where('id', $id)->first();

        return view('karyawan.show')->with(compact('show'));
    }

    public function edit($id)
    {
        
        $use = User::get();
        $edit = Karyawan::where('karyawan_id', $id)->first();

        return view('karyawan.edit')->with(compact('edit','use'));
    }

    public function update(Request $request)
    {
        $user = Karyawan::where('email', $request->email)->first();
        $update = collect($request->all());
        $passlama = $user->password;
        $passbaru = $request->password;

        if (!is_null($request->password) && !is_null($request->password_confirmation)) {
            if (Hash::check($passbaru, $passlama)) {
                $update->put('password', $user->password);

                try {
                    $user->update($update->all());
                } catch (QE $e) {
                   alert()->warning('Database Error');

                    return redirect()->back();
                }

               alert()->success('Akun berhasil diubah');

                return redirect('user');
            } else {
                if ($request->password == $request->password_confirmation) {
                    $newpass = $request->password;
                    $update->put('password', Hash::make($passbaru));

                    try {
                        $user->update($update->all());
                    } catch (QE $e) {

                toast('Database Error','error');

                        return redirect()->back();
                    }

                    toast('Akun Berhasil Diubah','success');

                    return redirect('user');
                } else {
                    toast('Konfirmasi Password Tidak Cocok','error');


                    return redirect()->back();
                }
            }
        } else {
            try {
                $update->put('password', $user->password);
                $user->update($update->all());
            } catch (QE $e) {

                toast('Database Error','error');

                return redirect()->back();
            }
            toast('Akun Berhasil Diubah','success');


            return redirect('user');
        }
    }

    public function delete($id)
    {
        $user = Karyawan::where('id', $id)->first();

        try {
            $user->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Akun Berhasil Dihapus','success');


        return redirect('user');
    }

    public function setting()
    {
        return view('karyawan.setting');
    }

    public function userupdate(Request $request)
    {
        $user = Karyawan::where('id', $request->id)->first();
        $passbaru = $request->password;

        $passlama = $request->passwordlama;
        if (Hash::check($passlama, $user->password)) {
            if ($request->password == $request->password_confirmation) {
                $newpass = $request->password;
                $user->password = Hash::make($newpass);

                try {
                    $user->update();
                } catch (QE $e) {
                    toast('Perubahan Gagal Disimpan, Coba Lagi','error');

                    return redirect()->back();
                }
            } else {
                toast('Password Baru Tidak Cocok','error');

                return redirect()->back();
            }
        } else {
            toast('Password Lama Tidak Cocok','error');

            return redirect()->back();
        }

        toast('Perubahan User Berhasil Disimpan!','error');

        return redirect('user');
    }
 
}
