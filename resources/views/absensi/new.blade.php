@extends('layouts.app')
@section('title','Absensi Baru - ')
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
<span class="card-label font-weight-bolder text-dark">Absensi Baru</span>
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

    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-8 col-xl-8">
                <form method="get" action="{{url('absensi/new')}}">
                    <input type="hidden" name="absensi_karyawanid" value="{{$selected_karyawan->karyawan_id}}">
                <div class="row align-items-center">
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Bulan:</label>
                            <select class="form-control" name="bulan_selected" id="bulan">
                                <option value="1"  @if(Request::get('bulan_selected') == "1") selected="selected" @endif>Januari</option>
                                <option value="2"  @if(Request::get('bulan_selected') == "2") selected="selected" @endif>Februari</option>
                                <option value="3"  @if(Request::get('bulan_selected') == "3") selected="selected" @endif>Maret</option>
                                <option value="4"  @if(Request::get('bulan_selected') == "4") selected="selected" @endif>April</option>
                                <option value="5"  @if(Request::get('bulan_selected') == "5") selected="selected" @endif>Mei</option>
                                <option value="6"  @if(Request::get('bulan_selected') == "6") selected="selected" @endif>Juni</option>
                                <option value="7"  @if(Request::get('bulan_selected') == "7") selected="selected" @endif>Juli</option>
                                <option value="8"  @if(Request::get('bulan_selected') == "8") selected="selected" @endif>Agustus</option>
                                <option value="9"  @if(Request::get('bulan_selected') == "9") selected="selected" @endif>Desember</option>
                                <option value="10"  @if(Request::get('bulan_selected') == "10") selected="selected" @endif>Oktober</option>
                                <option value="11"  @if(Request::get('bulan_selected') == "11") selected="selected" @endif>November</option>
                                <option value="12"  @if(Request::get('bulan_selected') == "12") selected="selected" @endif>Desember</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Tahun:</label>
                            <select class="form-control" name="tahun_selected" id="band">
                                <option value="2022" @if(Request::get('tahun_selected') == "2022") selected="selected" @endif>2022</option>
                                <option value="2023" @if(Request::get('tahun_selected') == "2023") selected="selected" @endif>2023</option>
                                <option value="2024" @if(Request::get('tahun_selected') == "2024") selected="selected" @endif>2024</option>
                                <option value="2025" @if(Request::get('tahun_selected') == "2025") selected="selected" @endif>2025</option>
                                <option value="2026" @if(Request::get('tahun_selected') == "2026") selected="selected" @endif>2026</option>
                                <option value="2027" @if(Request::get('tahun_selected') == "2027") selected="selected" @endif>2027</option>
                                <option value="2028" @if(Request::get('tahun_selected') == "2028") selected="selected" @endif>2028</option>
                                <option value="2029" @if(Request::get('tahun_selected') == "2029") selected="selected" @endif>2029</option>
                                <option value="2030" @if(Request::get('tahun_selected') == "2030") selected="selected" @endif>2030</option>



                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 mt-5 mt-lg-0">
                        <button href="#" class="btn btn-light-primary px-6 font-weight-bold">
                            Filter
                        </button>
                    </div>
                                </div>
                            </form>
            </div>

        </div>
    </div>
<div class="tab-content">
    <form method="POST" action="{{url('absensi/store')}}" >
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
					<th width="10%">KEHADIRAN</th>
					<th width="10%">KETERANGAN</th>
				</tr>
			</thead>
			<tbody>
                @for($i=1; $i <= \Carbon\Carbon::createFromDate(Request::get('tahun_selected'), Request::get('bulan_selected'), 1)->daysInMonth; $i++)
				<tr>
                    <td>{{$i}}
                        <input type="hidden" name="index[]" value="{{$i}}">
                    </td>
                    @php
                        $trail = $i<10?"0".$i:$i;
                        $month = Request::get('bulan_selected')<10?"0".Request::get('bulan_selected'):Request::get('bulan_selected');
                    @endphp
                    <td>{{$trail.'-'.Request::get('bulan_selected').'-'.Request::get('tahun_selected')}}
                        <input type="hidden" name="absensi_tanggal[]" value="{{Request::get('tahun_selected').'-'.Request::get('bulan_selected').'-'.$trail}}"></td>
                    <td><input id="jammasuk{{$i}}" data-hari="{{$i}}" class="jammasuk form-control"  onchange="jammasuk(this);" name="absensi_jammasuk[]" type="time"></td>
                    <td><input id="jampulang{{$i}}" data-hari="{{$i}}" class="jampulang form-control" onchange="jampulang(this);"name="absensi_jampulang[]" type="time"></td>
                    <td><span class="lamakerja" id="textlamakerja{{$i}}">0</span>
                        <input type="hidden"  id="lamakerja{{$i}}" name="absensi_lamakerja[]" value="0">
                    </td>
                    <td><span class="lamalembur" id="textlamalembur{{$i}}">0</span>
                        <input type="hidden" id="lamalembur{{$i}}" name="absensi_lembur[]" value="0"></td>
                    <td><select class="form-control" id="type{{$i}}" name="absensi_type[]">
                                <option value="1">Masuk</option>
                                <option value="2">Tidak Masuk</option>
                                <option value="3">Cuti</option>
                                <option value="4">Izin Sakit</option>
                                <option value="6">Tanpa Keterangan</option>
                                <option value="7">Libur</option>
                            </select></td>
                    <td><input type="text" id="keterangan{{$i}}" class="form-control" name="absensi_keterangan[]"></td>
				</tr>
                @endfor
			</tbody>
		</table>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-4">
                <button class="btn btn-md btn-primary" type="submit">Tambah Absensi</button>
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
