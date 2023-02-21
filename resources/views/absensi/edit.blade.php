@extends('layouts.app')
@section('title','Ubah Absensi - ')
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
<span class="card-label font-weight-bolder text-dark">Ubah Absensi</span>
</h3>
<div class="card-toolbar">
<a href="{{url('absensi/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
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
    <form method="POST" action="{{url('absensi/update')}}" >
        @csrf
        <input type="hidden" name="absensi_karyawanid" value="{{$selected_karyawan->karyawan_id}}">
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
					<th width="10%">TYPE KEHADIRAN</th>
					<th width="10%">KETERANGAN</th>
				</tr>
			</thead>
			<tbody>

            @php
            $i = 1;
            @endphp
            @foreach($edit as $e)
            <tr>
                    <td>{{$i}}
                    <input type="hidden" name="index[]" value="{{$i}}">
                    <input type="hidden" name="id[]" value="{{$e->absensi_id}}">
                    </td>
                    <td>{{$e->absensi_tanggal}}
                        <input type="hidden" name="absensi_tanggal[]" value="{{$e->absensi_tanggal}}"></td>
                    <td><input id="jammasuk{{$i}}" data-hari="{{$i}}" class="jammasuk form-control"  onchange="jammasuk(this);" name="absensi_jammasuk[]"
                    value="{{$e->absensi_jammasuk}}" type="time"></td>
                    <td><input id="jampulang{{$i}}" data-hari="{{$i}}" class="jampulang form-control" onchange="jampulang(this);"name="absensi_jampulang[]"
                    value="{{$e->absensi_jampulang}}" type="time"></td>
                    <td><span class="lamakerja"  data-tgl="{{$i}}" data-minute="{{$e->absensi_lamakerja}}"  id="textlamakerja{{$i}}">0</span>
                        <input type="hidden"  id="lamakerja{{$i}}" data-tgl="{{$i}}" data-minute="{{$e->absensi_lamakerja}}" class="lamakerja" name="absensi_lamakerja[]" value="{{$e->absensi_lamakerja}}">
                    </td>
                    <td><span class="lamalembur" id="textlamalembur{{$i}}">0</span>
                        <input type="hidden" id="lamalembur{{$i}}"  data-tgl="{{$i}}" data-minute="{{$e->absensi_lembur}}" data-tgl="{{$i}}" class="lamalembur"  name="absensi_lembur[]" value="{{$e->absensi_lembur}}"></td>
                    <td><select class="form-control" id="type{{$i}}" name="absensi_type[]">
                                <option value="1" @if($e->absensi_type == 1) selected="selected" @endif>Masuk</option>
                                <option value="2" @if($e->absensi_type == 2) selected="selected" @endif>Tidak Masuk</option>
                                <option value="3" @if($e->absensi_type == 3) selected="selected" @endif>Cuti</option>
                                <option value="4" @if($e->absensi_type == 4) selected="selected" @endif>Izin Sakit</option>
                                <option value="6" @if($e->absensi_type == 6) selected="selected" @endif>Tanpa Keterangan</option>
                                <option value="7" @if($e->absensi_type == 7) selected="selected" @endif>Libur</option>
                            </select></td>
                    <td><input type="text" id="keterangan{{$i}}" class="form-control" name="absensi_keterangan[]" value="{{$e->absensi_keterangan}}"></td>
				</tr>
                @php
            $i = $i+1;
            @endphp
                @endforeach
			</tbody>
		</table>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-4">
                <button class="btn btn-md btn-primary" type="submit">Ubah Absensi</button>
            </div>
        </div>
    </form>
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
    var jammasuk = DateTime.fromISO(document.getElementById("jammasuk"+select_val).value != null?document.getElementById("jammasuk"+select_val).value:0);
    var jampulang = DateTime.fromISO(document.getElementById("jampulang"+select_val).value != null?document.getElementById("jampulang"+select_val).value:0);
    var durasijam = jampulang.diff(jammasuk).shiftTo('hours','minutes').toObject();
    document.getElementById('textlamakerja'+select_val).innerHTML = durasijam.hours+" Jam, " +durasijam.minutes+" Menit";
        if(durasijam.hours > 8){
        var jamlembur = durasijam.hours-8;
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
var jamlembur = durasijam.hours-8;
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
var jamlembur = durasijam.hours-8;
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
