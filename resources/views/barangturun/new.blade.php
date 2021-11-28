@extends('layouts.app')
@section('title','Status Barang Turun Baru - ')
@section('css')
<link rel="stylesheet" type="text/css" id="mce-u0" href="{{asset('assets/js/tinymce/skins/ui/oxide/skin.min.css')}}">
@endsection
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
<span class="card-label font-weight-bolder text-dark">Status Barang Turun Baru</span>
</h3>
<div class="card-toolbar">
<a href="{{url('turunbarang/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('turunbarang/store')}}">
        @csrf
        <div class="form-group row mt-4">
            <label class="col-md-2">SKU Barang</label>
            <div class="col-md-3">
                <select class="form-control select2" id="productlist" name="barangturun_sku">
                    @foreach($product as $p)
                    <option value="{{$p->product_sku}}">{{$p->product_sku}} - {{$p->product_nama}} ({{$p->size_nama}})</option>
                    @endforeach
                   </select>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Nama Petugas</label>
            <div class="col-md-3">
            <input type="text" class="form-control" name="barangturun_namapetugas">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Tanggal Ambil</label>
            <div class="col-md-3">
            <input type="text" class="form-control" id="datepicker1" name="barangturun_tanggalambil" placeholder="Select date">
            </div>
          </div>




      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Tambah Status Barang Turun</button>
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
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script>
    $('#datepicker1').datepicker({
        format: "yyyy-mm-dd",
    });

    $('#productlist').select2({
        placeholder: "Scan SKU disini",
        allowClear: true
    });

    $( document ).ready(function() {

$('#productlist').val("");
});
    </script>
@endsection
@endsection
