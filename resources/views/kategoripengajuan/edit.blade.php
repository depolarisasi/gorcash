@extends('layouts.app')
@section('title','Edit Kategori Pengajuan - ') 
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
<span class="card-label font-weight-bolder text-dark">Edit Kategori Pengajuan</span>
</h3>
<div class="card-toolbar">
<a href="{{url('kategoripengajuan/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('kategoripengajuan/update')}}">
        @csrf
        <input type="hidden" name="catpengajuan_id" value="{{$edit->catpengajuan_id}}">
        <div class="form-group row mt-4">
            <label class="col-md-2">Nama Pengajuan</label>
            <div class="col-md-4"> 
            <input type="text" class="form-control" name="catpengajuan_nama" value="{{$edit->catpengajuan_nama}}">
            </div>
          </div>
          

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Ubah Kategori Pengajuan</button>
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
