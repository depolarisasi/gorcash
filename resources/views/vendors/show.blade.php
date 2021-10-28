@extends('layouts.app')
@section('title','Detail Vendor - ')
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
<span class="card-label font-weight-bolder text-dark">Informasi Vendor</span>
</h3>
<div class="card-toolbar">
<a href="{{url('/vendors')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <p><b>Nama Vendor </b> : {{$show->vendor_nama}} </p>
</br>
    <p><b>Website Vendor </b> : {{$show->vendor_web}} </p>

</br>
    <p><b>Asal Vendor </b> :
        @if($show->vendor_asal == 1)
    🇺🇸  Amerika Serikat (US)
    @elseif($show->vendor_asal == 2)
    <option value="2">🇪🇺 Eropa
    @elseif($show->vendor_asal == 3)
    <option value="3">🇬🇧 Inggris (UK)
    @endif</p>

</br>
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
