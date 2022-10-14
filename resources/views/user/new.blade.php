@extends('layouts.app')
@section('title','User Baru - ')
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
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Buat Pengguna Baru</span>
</h3>
<div class="card-toolbar">
<a href="{{url('user/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('user/store')}}">
        @csrf
        <div class="form-group row mt-4">
          <label class="col-md-2">Nama</label>
          <div class="col-md-3">
          <input id="name" type="text" class="form-control" name="name"  required autocomplete="name" autofocus>
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Email</label>
          <div class="col-md-3">
          <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
          </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-md-2">Jabatan / Peran</label>
            <div class="col-md-3">
                <select class="multisteps-form__input form-control" name="role">
                <option value="1">Admin Owner</option>
                <option value="2">Online</option>
                <option value="3">Sosmed</option>
                <option value="4">Gudang</option>
                <option value="5">Kasir</option>
                <option value="6">Administrator</option>
              </select>
            </div>
          </div>
        <div class="form-group row mt-4">
            <label class="col-md-2" >Password</label>
            <div class="col-md-3">
                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2" >Konfirmasi Ulang Password</label>
            <div class="col-md-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
          </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Tambah Pengguna</button>
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
@endsection
