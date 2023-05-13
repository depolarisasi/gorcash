@extends('layouts.app')
@section('title','Absensi '.$selected_karyawan->karyawan_nama.' Bulan '. \Carbon\Carbon::parse($show[0]->absensi_tanggal)->format('M').' - ')
@section('content')
	<!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class="container-fluid">
<!--begin::Dashboard-->

<!--begin::Row-->
<div class="row">
<div class="col-lg-12">
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Absensi</span>
</h3>
<div class="card-toolbar">
<a href="{{url('absensi/')}}" class="btn btn-primary btn-md font-size-sm mr-3"><i class="fas fa-arrow-left"></i> Kembali</a>
<a href="{{url('absensi/pdf/?bulan='.Request::get('bulan').'&tahun='.Request::get('tahun').'&karyawan='.$selected_karyawan->karyawan_id)}}" class="btn btn-success btn-sm font-size-sm"><i class="fas fa-file-pdf"></i> Save PDF</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

    @if(!is_null($selected_karyawan))
    <div class="row mb-5">
        <div class="col-md-3">
            @if(!is_null($selected_karyawan->karyawan_foto))
    <img src="{{asset($selected_karyawan->karyawan_foto)}}" class="img-fluid">
    @else
    <img src="{{asset('/foto/no-profile.png')}}" class="img-fluid">
    @endif
        </div>
        <div class="col-md-9">
            <p><b>Nama : </b> {{$selected_karyawan->karyawan_nama}}</p>
            @php
            $time = \Carbon\Carbon::now()->diff($selected_karyawan->karyawan_tanggalbekerja);
            @endphp
            <p><b>Tanggal Pertama Bekerja : </b> {{$selected_karyawan->karyawan_tanggalbekerja}},  {{$time->y}} Tahun, {{$time->m}} Bulan, {{$time->d}} Hari</p>
            <p><b>Jabatan : </b> {{$selected_karyawan->karyawan_jabatan}}</p>
            <p><b>Nomor Induk Karyawan : </b> {{$selected_karyawan->karyawan_noinduk}}</p>
        </div>
    </div>
    @endif

<div class="tab-content">

		<!--begin: Datatable-->
        <div class="table-responsive">

		<table class="table table-bordered mt-5" id="product">
			<thead>
				<tr>
					<th width="3%">No</th>
					<th width="10%">TANGGAL</th>
					<th width="10%">JAM MASUK</th>
					<th width="10%">JAM PULANG</th>
					<th width="5%">LAMA KERJA</th>
					<th width="5%">LAMA LEMBUR</th>
					<th width="10%">TIPE KEHADIRAN</th>
					<th width="10%">KETERANGAN</th>
				</tr>
			</thead>
			<tbody>

            @php
            $i = 1;
            @endphp
            @foreach($show as $e)
            <tr>
                    <td>{{$i}}</td>
                    <td>{{\Carbon\Carbon::parse($e->absensi_tanggal)->format('d-m-Y')}}</td>
                    <td><span id="jammasuk{{$i}}" data-hari="{{$i}}" class="jammasuk">{{$e->absensi_jammasuk}}</span></td>
                    <td><span id="jampulang{{$i}}" data-hari="{{$i}}" class="jampulang">{{$e->absensi_jampulang}}</span></td>
                    <td><span class="lamakerja"  data-tgl="{{$i}}" data-minute="{{$e->absensi_lamakerja}}"  id="textlamakerja{{$i}}">0</span></td>
                    <td><span class="lamalembur" id="textlamalembur{{$i}}">0</span></td>
                    <td>@if($e->absensi_type == 1)
                        Masuk @if ($e->absensi_jammasuk >= $e->karyawan_jammasukkerja)
                        , <span class="badge badge-danger">Terlambat</span>
                        {{$e->absensi_jammasuk}} dan {{$e->karyawan_jammasukkerja}}
                        @else
                        , <span class="badge badge-success"> Tepat Waktu</span>
                    @endif
                        @elseif($e->absensi_type == 2)
                        Tidak Masuk
                        @elseif($e->absensi_type == 3)
                        Cuti
                        @elseif($e->absensi_type == 4)
                        Izin Sakit
                        @elseif($e->absensi_type == 5)
                        Izin Telat @if ($e->absensi_jammasuk >= $e->karyawan_jammasukkerja)
                        , <span class="badge badge-danger">Terlambat</span>
                        @else
                        , <span class="badge badge-success"> Tepat Waktu</span>
                    @endif
                        @elseif($e->absensi_type == 6)
                        Tanpa Keterangan
                        @elseif($e->absensi_type == 7)
                        Libur
                        @endif </td>
                    <td>{{$e->absensi_keterangan}}</td>
				</tr>
                @php
            $i = $i+1;
            @endphp
                @endforeach
			</tbody>
		</table>
        </div>
</div>
</div>
<!--end::Body-->
</div>
<!--end::Advance Table Widget 4-->
</div>
</div>
<!--end::Row-->
<!--end::Dashboard-->
</div>
<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->
@section('js')
<script src="https://cdn.jsdelivr.net/npm/luxon@3.1.0/build/global/luxon.min.js"></script>
<script>


     var DateTime = luxon.DateTime;
$(document).ready(function(){

  $(".lamakerja").each(function(){
     var select_val = $(this).attr('data-tgl');
    var jammasuk = DateTime.fromISO(document.getElementById("jammasuk"+select_val).innerHTML != null?document.getElementById("jammasuk"+select_val).innerHTML:0);
    var jampulang = DateTime.fromISO(document.getElementById("jampulang"+select_val).innerHTML != null?document.getElementById("jampulang"+select_val).innerHTML:0);
    var durasijam = jampulang.diff(jammasuk).shiftTo('hours','minutes').toObject();
    var jam = durasijam.hours != undefined?durasijam.hours:0;
    var menit = durasijam.minutes != undefined?durasijam.minutes:0;
    document.getElementById('textlamakerja'+select_val).innerHTML =  jam +" Jam, " + menit +" Menit";
        if(durasijam.hours > 8){
        var jamlembur = (durasijam.hours)-9;
        var menitlembur = durasijam.minutes;
        }else {
        var jamlembur = 0
        var menitlembur = 0;
        }
        document.getElementById('textlamalembur'+select_val).innerHTML = jamlembur+" Jam, " + menitlembur +" Menit";
});
});

function jammasuk(e) {
var jammasuk = DateTime.fromISO(e.value);
var id = e.dataset.hari;
var jampulang = DateTime.fromISO(document.getElementById("jampulang"+id).value);
var durasijam = jampulang.diff(jammasuk).shiftTo('hours','minutes').toObject();

document.getElementById('textlamakerja'+id).innerHTML = durasijam.hours+" Jam, " +durasijam.minutes+" Menit";
$('#lamakerja'+id).val(jampulang.diff(jammasuk).as('minutes'));
if(durasijam.hours > 8){
var jamlembur = (durasijam.hours)-9;
var menitlembur = durasijam.minutes;
}else {
var jamlembur = 0
var menitlembur = 0;
}

document.getElementById('textlamalembur'+id).innerHTML = jamlembur+" Jam, " + menitlembur +" Menit";
$('#lamalembur'+id).val(jamlembur*60+menitlembur);
      };

      function jampulang(e) {
var jampulang = DateTime.fromISO(e.value);
var id = e.dataset.hari;
var jammasuk = DateTime.fromISO(document.getElementById("jammasuk"+id).value);
var durasijam = jampulang.diff(jammasuk).shiftTo('hours','minutes').toObject();

document.getElementById('textlamakerja'+id).innerHTML = durasijam.hours+" Jam, " +durasijam.minutes+" Menit";
$('#lamakerja'+id).val(jampulang.diff(jammasuk).as('minutes'));
if(durasijam.hours > 8){
var jamlembur = (durasijam.hours)-9;
var menitlembur = durasijam.minutes;
}else {
var jamlembur = 0
var menitlembur = 0;
}

document.getElementById('textlamalembur'+id).innerHTML = jamlembur+" Jam, " + menitlembur +" Menit";
$('#lamalembur'+id).val(jamlembur*60+menitlembur);
      };

</script>
@endsection
@endsection
