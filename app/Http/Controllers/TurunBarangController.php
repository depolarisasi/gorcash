<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TurunBarang;
use App\Models\Product;

class TurunBarangController extends Controller
{
    public function index()
    {
        $barangturun = TurunBarang::join('product','product.product_sku','=','barangturun_sku')
        ->join('size','size.size_id','=','product.product_idsize')
        ->select('barangturun.*','product.*','size.size_nama')
        ->get();
        return view('barangturun.index')->with(compact('barangturun'));
    }

    public function create()
    {

        $product = Product::join('size','size.size_id','=','product.product_idsize')
        ->select('product.*','size.size_nama')
        ->get();
        return view('barangturun.new')->with(compact('product'));
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        TurunBarang::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Berhasil Membuat Status Barang Baru','success');
        return redirect('turunbarang');
    }

    public function show($id)
    {
        $show = TurunBarang::join('product','product.product_sku','=','barangturun_sku')
        ->select('barangturun.*','product.*')
        ->where('barangturun.barangturun_id', $id)->first();

        return view('barangturun.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = TurunBarang::where('barangturun_id', $id)->first();
        $product = Product::join('size','size.size_id','=','product.product_idsize')
        ->select('product.*','size.size_nama')
        ->get();

        return view('barangturun.edit')->with(compact('edit','product'));
    }

    public function update(Request $request)
    {
        $barangturun = TurunBarang::where('barangturun_id', $request->barangturun_id)->first();
        $update = collect($request->all());
        try {
        $barangturun->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Status Barang Berhasil','success');
        return redirect('turunbarang');
    }

    public function kembali($id)
    {
        $kembali = TurunBarang::join('product','product.product_sku','=','barangturun.barangturun_sku')
        ->join('size','size.size_id','=','product.product_idsize')
        ->where('barangturun_id', $id)->first();
        $product = Product::join('size','size.size_id','=','product.product_idsize')
        ->select('product.*','size.size_nama')
        ->get();

        return view('barangturun.kembali')->with(compact('kembali','product'));
    }

    public function kembalikan(Request $request)
    {
        $barangturun = TurunBarang::where('barangturun_id', $request->barangturun_id)->first();
        $update = collect($request->all());
        try {
        $barangturun->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Status Barang Berhasil','success');
        return redirect('turunbarang');
    }

    public function delete($id)
    {
        $barangturun = TurunBarang::where('barangturun_id', $id)->first();

        try {
            $barangturun->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Status Barang Berhasil Dihapus!','success');

        return redirect('turunbarang');
    }
}
