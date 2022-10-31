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
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File; 
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class KaryawanController extends Controller
{
    
    public function uploadKTP($image){
        if ($image == '') {
            $fileurl = '';
    } else {
        $file = $image;
        $fileArray = ['karyawan_fotoktp' => $file];
        $rules = ['karyawan_fotoktp' => 'mimes:jpeg,jpg,png,gif|required|max:100000'];
        $validator = Validator::make($fileArray, $rules);
        if ($validator->fails()) {
            // Redirect or return json to frontend with a helpful message to inform the user
            // that the provided file was not an adFile bukan gambar

         toast('File bukanlah gambar','error');
            return redirect()->back();
        } else {
            $img_id = mt_rand(1, 10000);
            $fileName = $img_id.time().'.'.$file->getClientOriginalName();
            Image::make($file)->encode('jpg', 90)->save('fotoktp/'.$fileName);
            $filektp = 'fotoktp/'.$fileName;
        }
    }
    return $filektp;
    }

    public function uploadFoto($image){
        if ($image == '') {
            $fileurl = '';
    } else {
        $file = $image;
        $fileArray = ['karyawan_foto' => $file];
        $rules = ['karyawan_foto' => 'mimes:jpeg,jpg,png,gif|required|max:100000'];
        $validator = Validator::make($fileArray, $rules);
        if ($validator->fails()) {
            // Redirect or return json to frontend with a helpful message to inform the user
            // that the provided file was not an adFile bukan gambar

         toast('File bukanlah gambar','error');
            return redirect()->back();
        } else {
            $img_id = mt_rand(1, 10000);
            $fileName = $img_id.time().'.'.$file->getClientOriginalName();
            Image::make($file)->encode('jpg', 90)->save('foto/'.$fileName);
            $filefoto = 'foto/'.$fileName;
        }
    }
    return $filefoto;
    }


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

        if ($request->file('karyawan_foto') == '') {
            $filefoto = '/foto/nophoto.png';
    } else {
            $filefoto =  $this->uploadFoto($request->file('karyawan_foto'));
    }

    
    if ($request->file('karyawan_fotoktp') == '') {
        $filektp = '/fotoktp/nophoto.png';
} else {
        $filektp =  $this->uploadKTP($request->file('karyawan_fotoktp'));
}

    $data->put('karyawan_foto',$filefoto);
    $data->put('karyawan_fotoktp',$filektp);

        try {
            Karyawan::create($data->all()); 
        } catch (QE $e) {
            toast('Database Error','error');

            return $e;
        } 
        toast('Karyawan Berhasil Dibuat','success'); 
        return redirect('karyawan');
    }

    public function show($id)
    {
        $show = Karyawan::where('karyawan_id', $id)->first();

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
        $user = Karyawan::where('karyawan_id', $request->karyawan_id)->first();
        $update = collect($request->all());
      
        if ($request->file('karyawan_foto') == '') {
            $filefoto = $user->karyawan_foto;
    } else {
            $filefoto =  $this->uploadFoto($request->file('karyawan_foto'));
    }

    
    if ($request->file('karyawan_fotoktp') == '') {
        $filektp = $user->karyawan_fotoktp;
} else {
        $filektp =  $this->uploadKTP($request->file('karyawan_fotoktp'));
}

    $update->put('karyawan_foto',$filefoto);
    $update->put('karyawan_fotoktp', $filektp);
 
            try { 
                $user->update($update->all());
            } catch (QE $e) {

                toast('Database Error','error');

                return redirect()->back();
            }
            toast('Karyawan Berhasil Diubah','success'); 

            return redirect('karyawan'); 
    }

    public function delete($id)
    {
        $user = Karyawan::where('karyawan_id', $id)->first();

        try {
            $user->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Karyawan Berhasil Dihapus','success');


        return redirect('karyawan');
    }
 
}
