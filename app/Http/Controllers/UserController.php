<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();
        return view('user.index')->with(compact('user'));
    }

    public function create()
    {
        return view('user.new');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            // Redirect or return json to frontend with a helpful message to inform the user
            // that the provided file was not an adequate type

           alert()->warning('Terdapat kesalahan input, silahkan periksa ulang data yang anda masukan');

            return redirect()->back();
        } else {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);
        }
       alert()->success('Akun berhasil dibuat');

        return redirect('user');
    }

    public function show($id)
    {
        $show = User::where('id', $id)->first();

        return view('user.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = User::where('id', $id)->first();

        return view('user.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $user = User::where('email', $request->email)->first();
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
                       alert()->warning('Database Error');

                        return redirect()->back();
                    }

                   alert()->success('Akun berhasil diubah');

                    return redirect('user');
                } else {
                   alert()->warning('Password konfirmasi tidak cocok');

                    return redirect()->back();
                }
            }
        } else {
            try {
                $update->put('password', $user->password);
                $user->update($update->all());
            } catch (QE $e) {
               alert()->warning('Database Error');

                return redirect()->back();
            }

           alert()->success('Akun berhasil diubah');

            return redirect('user');
        }
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();

        try {
            $user->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

       alert()->success('Akun telah sukses dihapus !');

        return redirect('user');
    }

    public function setting()
    {
        return view('user.setting');
    }

    public function userupdate(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $passbaru = $request->password;

        $passlama = $request->passwordlama;
        if (Hash::check($passlama, $user->password)) {
            if ($request->password == $request->password_confirmation) {
                $newpass = $request->password;
                $user->password = Hash::make($newpass);

                try {
                    $user->update();
                } catch (QE $e) {
                   alert()->warning('Oh No! Perubahan gagal disimpan, coba lagi', 'alert');

                    return redirect()->back();
                }
            } else {
               alert()->warning('Oh No! Perubahan gagal disimpan, password baru tidak cocok', 'alert');

                return redirect()->back();
            }
        } else {
           alert()->warning('Oh No! Perubahan gagal disimpan, password lama tidak cocok', 'alert');

            return redirect()->back();
        }

       alert()->success('Berhasil! Perubahan berhasil disimpan', 'alert');

        return redirect('user');
    }
}
