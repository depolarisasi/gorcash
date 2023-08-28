@extends('layouts.app')
@section('title','Ubah Customer - ')
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
<span class="card-label font-weight-bolder text-dark">Ubah Customer</span>
</h3>
<div class="card-toolbar">
<a href="{{url('customer/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('customer/update')}}">
        @csrf
        <input type="hidden" name="customer_id" value="{{$edit->customer_id}}">
        <div class="form-group">
            <label>Nama</label>
            <input class="form-control" type="text" name="customer_nama" value="{{$edit->customer_nama}}">
        </div>
        <div class="form-group">
            <label>No HP</label>
            <input class="form-control" type="text" name="customer_nohp" value="{{$edit->customer_nohp}}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="customer_email" value="{{$edit->customer_email}}">
        </div>
        <div class="form-group">
            <label>Points</label>
            <input class="form-control" type="number" name="customer_points" value="{{$edit->customer_points}}">
        </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Ubah Customer</button>
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
