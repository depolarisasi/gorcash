@extends('layouts.app')
@section('title','Vendor Baru - ')
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
<span class="card-label font-weight-bolder text-dark">Vendor Baru</span>
</h3>
<div class="card-toolbar">
<a href="{{url('vendors/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('vendors/store')}}">
        @csrf
        <div class="form-group row mt-4">
            <label class="col-md-2">Nama Vendor</label>
            <div class="col-md-3">
            <input id="name" type="text" class="form-control" name="vendor_nama"  required autofocus>
            </div>
          </div>

          <div class="form-group row mt-4">
              <label class="col-md-2">Asal</label>
              <div class="col-md-3">
                  <select class="multisteps-form__input form-control" name="vendor_asal">
                  <option value="1">🇺🇸  Amerika Serikat (US)</option>
                  <option value="2">🇪🇺 Eropa</option>
                  <option value="3">🇬🇧 Inggris (UK)</option>
                </select>
              </div>
            </div>
            <div class="form-group row mt-4">
              <label class="col-md-2">Website</label>
              <div class="col-md-3">
              <input id="name" type="text" class="form-control" name="vendor_web" >
              </div>
            </div>


      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Tambah Vendor</button>
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
