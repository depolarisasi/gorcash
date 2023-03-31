@extends('layouts.app')
@section('title','Profil Karyawan - ')
@section('content')
	<!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class=" container ">
<!--begin::Dashboard-->

<!--begin::Row-->
<div class="row">
<div class="col-lg-12">
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h2 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Profil Saya</span>
</h2>
<div class="card-toolbar">
<a href="{{url('profil-karyawan/edit')}}" class="btn btn-warning btn-md font-size-sm"><i class="fas fa-edit"></i> Ubah Profil Saya</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<div class="row">
    <div class="col-md-6">
        @if(!is_null($show))
        @if(!is_null($show->karyawan_foto))
<img src="{{asset($show->karyawan_foto)}}" class="img-fluid" style="width: 150px; height: 150px;">
@else
<img src="{{asset('/foto/no-profile.png')}}" class="img-fluid" style="width: 150px; height: 150px;">
@endif
@endif
    </div>
    <div class="col-md-6">
        <p><b>Nama : </b> {{$show->karyawan_nama}}</p>
        @php
        $time = \Carbon\Carbon::now()->diff($show->karyawan_tanggalbekerja);
        @endphp
        <p><b>Tanggal Pertama Bekerja : </b> {{$show->karyawan_tanggalbekerja}},  {{$time->y}} Tahun, {{$time->m}} Bulan, {{$time->d}} Hari</p>
        <p><b>Jabatan : </b> {{$show->karyawan_jabatan}}</p>
        <p><b>Nomor Induk Karyawan : </b> {{$show->karyawan_noinduk}}</p>
    </div>
</div>
</br>
<div class="row">
    <div class="col-md-2">
        <p><b>NIK </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_nik}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Kelamin</b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_kelamin}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Tempat, Tanggal Lahir </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_tempatlahir}}, {{$show->karyawan_tanggallahir}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Kewarganegaraan </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_kewarganegaraan}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Kewarganegaraan </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_kewarganegaraan}}</p>
    </div>

    <div class="col-md-2">
        <p><b>No BPJS </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_bpjs}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Status Perkawinan </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_status}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Agama </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_agama}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Alamat Sekarang </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_alamatsekarang}}, {{$show->karyawan_kotasekarang}}, {{$show->karyawan_provinsisekarang}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Alamat KTP </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_alamatktp}}, {{$show->karyawan_kotaktp}}, {{$show->karyawan_provinsiktp}}</p>
    </div>

    <div class="col-md-2">
        <p><b>No HP </b></p>
    </div>
    <div class="col-md-10">

<p> {{$show->karyawan_nohp}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Email </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_email}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Rekening </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_namabank}}, {{$show->karyawan_cabangbank}}, {{$show->karyawan_norekbank}}, {{$show->karyawan_namarekbank}}</p>
    </div>
    <div class="col-md-12 mt-5">
    <h2>Pendidikan & Bahasa</h2>
    </div>
    <div class="col-md-2">
        <p><b>Pendidikan Terakhir </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_pendidikanterakhir}}</p>
    </div>

    @if(!is_null($show->karyawan_pendidikan1))
    <div class="col-md-2">
        <p><b>Pendidikan 1 </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_pendidikan1}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Jurusan Pendidikan 1 </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_jurusanpendidikan1}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Tahun Pendidikan 1 </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_tahunpendidikan1}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Kualifikasi Pendidikan 1 </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_kualifikasipendidikan1}}</p>
    </div>
    @endif

    @if(!is_null($show->karyawan_pendidikan2))
    <div class="col-md-2">
        <p><b>Pendidikan 2 </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_pendidikan2}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Jurusan Pendidikan 2 </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_jurusanpendidikan2}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Tahun Pendidikan 2 </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_tahunpendidikan2}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Kualifikasi Pendidikan 2 </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_kualifikasipendidikan2}}</p>
    </div>
    @endif
</div>
<br>

@if(!is_null($show->karyawan_bahasa1))
<div class="row">
<div class="col-md-4">
<p><b>{{$show->karyawan_bahasa1}}</b></p>
</div>

<div class="col-md-2">
<p><b>Membaca : {{$show->karyawan_membacabahasa1}}</b></p>
</div>

<div class="col-md-2">
<p><b>Berbicara : {{$show->karyawan_berbicarabahasa1}}</b></p>
</div>

<div class="col-md-2">
<p><b>Mendengar : {{$show->karyawan_mendengarbahasa1}}</b></p>
</div>

<div class="col-md-2">
<p><b>Menulis : {{$show->karyawan_menulisbahasa1}}</b></p>
</div>
</div>
@endif
@if(!is_null($show->karyawan_bahasa2))
<div class="row">
<div class="col-md-4">
<p><b>{{$show->karyawan_bahasa2}}</b></p>
</div>

<div class="col-md-2">
<p><b>Membaca : {{$show->karyawan_membacabahasa2}}</b></p>
</div>

<div class="col-md-2">
<p><b>Berbicara : {{$show->karyawan_berbicarabahasa2}}</b></p>
</div>

<div class="col-md-2">
<p><b>Mendengar : {{$show->karyawan_mendengarbahasa2}}</b></p>
</div>

<div class="col-md-2">
<p><b>Menulis : {{$show->karyawan_menulisbahasa2}}</b></p>
</div>
</div>
@endif

<h2>Riwayat Pengalaman Kerja</h2>

@if(!is_null($show->karyawan_employment1))
<div class="row">
<div class="col-md-3">
<p><b>{{$show->karyawan_employment1}}</b></p>
</div>

<div class="col-md-3">
<p><b>Periode : {{$show->karyawan_employmentperiode1}}</b></p>
</div>

<div class="col-md-3">
<p><b>Jabatan : {{$show->karyawan_employmentjabatan1}}</b></p>
</div>

<div class="col-md-3">
<p><b>Gaji : {{$show->karyawan_employmentgaji1}}</b></p>
</div>
</div>
@endif
@if(!is_null($show->karyawan_employment2))
<div class="row">
<div class="col-md-3">
<p><b>{{$show->karyawan_employment2}}</b></p>
</div>

<div class="col-md-3">
<p><b>Periode : {{$show->karyawan_employmentperiode2}}</b></p>
</div>

<div class="col-md-3">
<p><b>Jabatan : {{$show->karyawan_employmentjabatan2}}</b></p>
</div>

<div class="col-md-3">
<p><b>Gaji : {{$show->karyawan_employmentgaji2}}</b></p>
</div>
</div>
@endif
</br>
<h2>Informasi Lain</h2>
<div class="row">
    <div class="col-md-2">
        <p><b>Cacat</b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_cacat}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Merokok </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_merokok}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Tidak Bisa Bekerja Di Hari </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_haritertentu}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Jenis SIM </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_jenissim}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Masa Berlaku SIM </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_berlakusim}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Pernah Diberhentikan </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_pernahdiberhentikan}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Pernah Dihukum </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_pernahdihukum}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Nama Ayah </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_namaayah}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Alamat Ayah </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_alamatayah}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Telp Ayah </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_telpayah}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Nama Ibu</b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_namaibu}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Alamat Ibu</b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_alamatibu}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Telp Ibu</b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_telpibu}}</p>
    </div>
    <div class="col-md-2">
        <p><b>Nama Saudara</b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_namasdr}}</p>
    </div>
    <div class="col-md-2">
        <p><b>Telp Saudara</b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_telpsdr}}</p>
    </div>
    <div class="col-md-2">
        <p><b>Alamat Saudara</b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_alamatsdr}}</p>
    </div>

    <div class="col-md-2">
        <p><b>Nama Kontak Darurat </b> </p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_kontakdrt1}}</p>
    </div>
    <div class="col-md-2">
        <p><b>Telp Kontak Darurat </b></p>
    </div>
    <div class="col-md-10">

<p>{{$show->karyawan_nokontakdrt1}}</p>
    </div>


    <div class="col-md-2">
        <p><b>KTP Karyawan</b></p>
    </div>
    <div class="col-md-10">
    @if($show->karyawan_foto)
<img src="{{asset($show->karyawan_fotoktp)}}" class="img-fluid">
@else
<img src="#" class="img-fluid">
@endif
    </div>

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
@endsection
