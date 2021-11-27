@extends('layouts.app')
@section('title','Select Stok Opname - ')
@section('content')
	<!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class="container">
<!--begin::Dashboard-->

<!--begin::Row-->
<div class="row">
<div class="col-lg-12">
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Stok Opname</span>
</h3>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<!--end::Search Form-->
<div class="row">
    <div class="offset-md-4 col-md-2 col-sm-6 col-xs-6">
        <a href="{{url('/stokopname/mingguan')}}" class="btn btn-md btn-primary">SO Mingguan</a>
    </div>
    <div class="col-md-2 col-xs-6">
        <a href="{{url('/stokopname/bulanan')}}" class="btn btn-md btn-primary">SO Bulanan</a>
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
