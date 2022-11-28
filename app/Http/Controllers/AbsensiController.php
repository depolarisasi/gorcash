<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Product;
use App\Models\Karyawan;
use App\Models\User;
use DB;
use \Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        if($request->get('bulan') != "" | !empty($request->get('bulan'))){
            $bulan = $request->get('bulan');
        }else {
            $bulan = "All";
        }

        if($request->get('tahun') != "" | !empty($request->get('tahun'))){
            $tahun = $request->get('tahun');
        }else {
            $tahun = "All";
        }

        $selected_month =  $bulan == "All"? Carbon::now()->format('m'):$bulan;
        $selected_year =  $tahun == "All"? Carbon::now()->format('Y'):$tahun;

        $absensi = Absensi::join('karyawan','karyawan_id','=','absensi_karyawanid')
        ->select('karyawan.karyawan_nama','absensi.*')
        ->get();
        $karyawan = Karyawan::get();
        return view('absensi.index')->with(compact('absensi','selected_month','selected_year','tahun','bulan','karyawan'));
    }

    public function create(Request $request)
    {
        $karyawan = Karyawan::get();
        if($request->get('absensi_karyawanid') != NULL || !empty($request->get('absensi_karyawanid'))){
        $selected_karyawan = Karyawan::where('karyawan_id',$request->absensi_karyawanid)->first();
        }else {
            $selected_karyawan = Null;
        }

        return view('absensi.new')->with(compact('karyawan','selected_karyawan'));
    }


    public function store(Request $request)
    {
        $store = collect($request->all());
        foreach($request->index as $id){
            $product = Product::where('product_id',$pid)->first();
            $product->product_tag = $request->product_tag[$key]??null;
            $product->product_material = $request->product_material[$key]??null;
            $product->product_madein = $request->product_madein[$key]??null;
            $product->product_condition = $request->product_condition[$key]??null;
            $product->product_keterangan = $request->product_keterangan[$key]??null;
            $product->product_tanggalpublish = $request->publish_tanggal;
            $product->product_stok = $request->product_stok[$key];
            $product->product_stokakhir = $request->product_stokakhir[$key];
            $product->product_stokgudang = $request->product_stokgudang[$key];
            $product->product_stoktoko = $request->product_stoktoko[$key];
            $editpublish = BarangPublish::where('publish_id',$request->publish_id[$key])->first();
            $editpublish->publish_stok = $request->product_stok[$key];
            $editpublish->publish_stokakhir = $request->product_stokakhir[$key];
            $editpublish->publish_selisih = $request->publish_selisih[$key];
            $editpublish->publish_name = $request->publish_name;
            $editpublish->publish_tanggal = $request->publish_tanggal;
            try {
                $product->update();
                $editpublish->update();
                if($pub->wasChanged()){
                    Logs::create(['log_name' => '[PUB] Produk Stok Berubah', 'log_msg' => "Stok Akhir Produk ".$produk->product_nama." di Publish ".$editpublish->publish_name." berubah karena edit publish mingguan, stok awal lama ".$product->product_stok." menjadi ". $request->publish_stok[$key]." dan stok akhir lama ".$product->product_stokakhir." menjadi " . $request->product_stokakhir[$key], 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);
                }else {
                    Logs::create(['log_name' => '[PUB] Produk Stok GAGAL Berubah', 'log_msg' => "Stok Akhir Produk ".$produk->product_nama." di Publish ".$editpublish->publish_name." GAGAL berubah karena edit publish mingguan, stok awal lama ".$product->product_stok." menjadi ". $request->publish_stok[$key]." dan stok akhir lama ".$product->product_stokakhir." menjadi " . $request->product_stokakhir[$key], 'log_userid' => Auth::user()->id, 'log_tanggal' => Carbon::now()->setTimezone('Asia/Jakarta')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s')]);
                }
                    } catch (QE $e) {
                        toast('Database error','error');
                        return $e;
                    }
        }

        try {
        Absensi::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }


        toast('Berhasil Membuat Riwayat Kirim Paket','success');
        return $request->all();
    }


    public function edit($id)
    {
        $edit = Absensi::where('absensi_id', $id)->first();
        $user = User::get();

        return view('absensi.edit')->with(compact('edit','user'));
    }

    public function update(Request $request)
    {
        $absensi = Absensi::where('absensi_id', $request->absensi_id)->first();
        $update = collect($request->all());
        try {
        $absensi->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Status Kirim Paket Berhasil','success');
        return redirect('absensi');
    }


    public function delete($id)
    {
        $absensi = Absensi::where('absensi_id', $id)->first();

        try {
            $absensi->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Status Kirim Paket Berhasil Dihapus!','success');

        return redirect('absensi');
    }

    public function laporan(Request $request){
        if($request->get('bulan') != "" | !empty($request->get('bulan'))){
            $bulan = $request->get('bulan');
        }else {
            $bulan = "All";
        }

        if($request->get('tahun') != "" | !empty($request->get('tahun'))){
            $tahun = $request->get('tahun');
        }else {
            $tahun = "All";
        }

        $selected_month =  $bulan == "All"? Carbon::now()->format('m'):$bulan;
        $selected_year =  $tahun == "All"? Carbon::now()->format('Y'):$tahun;

        $data = DB::table('absensi')
        ->join('users','id','=','absensi_user')
        ->select('absensi.absensi_user','users.name', DB::raw('sum(absensi.absensi_jumlahpaket) as totalpaket'))
        ->whereMonth('absensi_tanggal', $selected_month)
        ->whereYear('absensi_tanggal', $selected_year)
        ->groupBy('absensi_user')
        ->get();
        $tahun = Absensi::select(DB::Raw('YEAR(absensi_tanggal) as year'))->groupBy('year')->get();
        return view('absensi.laporan')->with(compact('data', 'tahun'));
        // return $selected_year;
    }

}
