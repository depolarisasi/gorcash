@extends('layouts.app')
@section('title','Detail Karyawan - ')
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
<span class="card-label font-weight-bolder text-dark">Informasi Karyawan</span>
</h2>
<div class="card-toolbar">
<a href="{{url('karyawan/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<div class="row">
    <div class="col-md-6">
<img src="{{asset($show->karyawan_foto)}}" class="img-fluid">
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
<p><b>NIK </b> : {{$show->karyawan_nik}}</p>
<p><b>Kelamin </b> : {{$show->karyawan_kelamin}}</p>
<p><b>Tempat, Tanggal Lahir </b> : {{$show->karyawan_tempatlahir}}, {{$show->karyawan_tanggallahir}}</p>
<p><b>Kewarganegaraan </b> : {{$show->karyawan_kewarganegaraan}}</p>
<p><b>No BPJS </b> : {{$show->karyawan_bpjs}}</p>
<p><b>Status Perkawinan </b> : {{$show->karyawan_status}}</p>
<p><b>Agama </b> : {{$show->karyawan_agama}}</p>
<p><b>Alamat Sekarang </b> : {{$show->karyawan_alamatsekarang}}, {{$show->karyawan_kotasekarang}}, {{$show->karyawan_provinsisekarang}}</p>
<p><b>Alamat KTP </b> : {{$show->karyawan_alamatktp}}, {{$show->karyawan_kotaktp}}, {{$show->karyawan_provinsiktp}}</p>
<p><b>No HP </b> : {{$show->karyawan_nohp}}</p>
<p><b>Email </b> : {{$show->karyawan_email}}</p>
<p><b>Rekening </b> : {{$show->karyawan_namabank}}, {{$show->karyawan_cabangbank}}, {{$show->karyawan_norekbank}}, {{$show->karyawan_namarekbank}}</p>
<br>
<h2>Pendidikan & Bahasa</h2>
<p><b>Pendidikan Terakhir </b> : {{$show->karyawan_pendidikanterakhir}}</p>
<p><b>Pendidikan 1 </b> : {{$show->karyawan_pendidikan1}}</p>
<p><b>Jurusan Pendidikan 1 </b> : {{$show->karyawan_jurusanpendidikan1}}</p>
<p><b>Tahun Pendidikan 1 </b> : {{$show->karyawan_tahunpendidikan1}}</p>
<p><b>Kualifikasi Pendidikan 1 </b> : {{$show->karyawan_kualifikasipendidikan1}}</p>
<p><b>Pendidikan 2 </b> : {{$show->karyawan_pendidikan2}}</p>
<p><b>Jurusan Pendidikan 2 </b> : {{$show->karyawan_jurusanpendidikan2}}</p>
<p><b>Tahun Pendidikan 2 </b> : {{$show->karyawan_tahunpendidikan2}}</p>
<p><b>Kualifikasi Pendidikan 2 </b> : {{$show->karyawan_kualifikasipendidikan2}}</p>
<br>
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

<h2>Riwayat Pengalaman Kerja</h2>
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
</br> 
<h2>Informasi Lain</h2>
<p><b>Cacat</b> : {{$show->karyawan_cacat}}</p>
<p><b>Merokok </b> : {{$show->karyawan_merokok}}</p>
<p><b>Tidak Bisa Bekerja Di Hari </b> : {{$show->karyawan_haritertentu}}</p>
<p><b>Jenis SIM </b> : {{$show->karyawan_jenissim}}</p>
<p><b>Masa Berlaku SIM </b> : {{$show->karyawan_berlakusim}}</p>
<p><b>Pernah Diberhentikan </b> : {{$show->karyawan_pernahdiberhentikan}}</p>
<p><b>Pernah Dihukum </b> : {{$show->karyawan_pernahdihukum}}</p> 
<p><b>Nama Ayah </b> : {{$show->karyawan_namaayah}}</p> 
<p><b>Alamat Ayah </b> : {{$show->karyawan_alamatayah}}</p> 
<p><b>Telp Ayah </b> : {{$show->karyawan_telpayah}}</p> 
<p><b>Nama Ibu </b> : {{$show->karyawan_namaibu}}</p> 
<p><b>Alamat Ibu </b> : {{$show->karyawan_alamatibu}}</p>  
<p><b>Telp Ibu </b> : {{$show->karyawan_telpibu}}</p> 
<p><b>Nama Saudara </b> : {{$show->karyawan_namasdr}}</p> 
<p><b>Alamat Saudara </b> : {{$show->karyawan_alamatsdr}}</p> 
<p><b>Telp Saudara </b> : {{$show->karyawan_telpsdr}}</p> 
<p><b>Nama Kontak Darurat </b> : {{$show->karyawan_kontakdrt1}}</p> 
<p><b>Telp Kontak Darurat </b> : {{$show->karyawan_nokontakdrt1}}</p> 
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
