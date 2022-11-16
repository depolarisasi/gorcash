<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\KirimPaket;
use App\Models\Product;
use App\Models\User; 

class KirimPaketController extends Controller
{
    
    public function index()
    {
        $kirimpaket = KirimPaket::join('users','id','=','kirimpaket_user')
        ->select('users.name','kirimpaket.*')
        ->get(); 
        return view('kirimpaket.index')->with(compact('kirimpaket'));
    }
  

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        KirimPaket::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Berhasil Membuat Riwayat Kirim Paket','success');
        return redirect('kirimpaket');
    }
 

    public function edit($id)
    {
        $edit = KirimPaket::where('kirimpaket_id', $id)->first(); 
        $user = User::get();

        return view('kirimpaket.edit')->with(compact('edit','user'));
    }

    public function update(Request $request)
    {
        $kirimpaket = KirimPaket::where('kirimpaket_id', $request->kirimpaket_id)->first();
        $update = collect($request->all());
        try {
        $kirimpaket->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Status Kirim Paket Berhasil','success');
        return redirect('kirimpaket');
    }
 
 
    public function delete($id)
    {
        $kirimpaket = KirimPaket::where('kirimpaket_id', $id)->first();

        try {
            $kirimpaket->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Status Kirim Paket Berhasil Dihapus!','success');

        return redirect('kirimpaket');
    }
    
}
