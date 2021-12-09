@extends('layouts.app')
@section('content')
	<!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
<div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
<div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
<!--begin::Info-->
<div class="d-flex align-items-center flex-wrap mr-2">

<!--begin::Page Title-->
<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
Dashboard Gorilla Coach </h5>
<!--end::Page Title-->



<!--end::Actions-->
</div>
<!--end::Info-->


</div>
</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class=" container ">
<!--begin::Dashboard-->
<!--begin::Row-->

<!--begin::Row-->
<div class="row">
<div class="col-lg-6">
<!--begin::Mixed Widget 14-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0">
<h3 class="card-title font-weight-bolder text-dark">Agenda Promo</h3>
</div>
<!--end::Header-->
<!--begin::Body-->
<div class="card-body pt-2">
<!--begin::Item-->
<!--begin::Item-->
@foreach($agenda as $ag)
<div class="d-flex align-items-center mt-3">
<!--begin::Bullet-->
<span class="bullet bullet-bar bg-danger align-self-stretch"></span>
<!--end::Bullet-->
<!--begin::Text-->
<div class="d-flex flex-column flex-grow-1 mx-4">
<a href="{{url('agenda/detail/'.$ag->agenda_id)}}" class="text-dark-75 text-hover-primary font-weight-boldest font-size-lg mb-1">{{$ag->agenda_judul}}</a>
<span class="font-weight-boldest">{{\Carbon\Carbon::parse($ag->agenda_startdate)->format('d-m-Y')}} - {{\Carbon\Carbon::parse($ag->agenda_enddate)->format('d-m-Y')}}</span>
</div>
<!--end::Text-->
</div>
@endforeach

</div>
<!--end::Body-->
</div>
<!--end::Mixed Widget 14-->
</div>
<div class="col-lg-6">
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Produk Habis</span>
</h3>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<!--begin::Table-->
<div class="table-responsive">
<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
<thead>
<tr class="text-left text-uppercase">
<th class="pl-7"><span class="text-dark-75">Nama Produk</span></th>
<th><span class="text-dark-75">Sisa Stok</span></th>
</tr>
</thead>
<tbody>
@foreach($produkstokrendah as $ps)
<tr>
<td class="pl-0 py-1">
<div class="d-flex align-items-center">
<div>
    <a href="{{url('produk/detail/'.$ps->product_id)}}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$ps->product_nama}}</a>
    <span class="text-muted font-weight-bold d-block">Size {{$ps->size_nama}} - {{$ps->band_nama}}</span>
</div>
</div>
</td>
<td>
<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
{{$ps->product_stok}}
</span>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
<!--end::Table-->
</div>
</div>
<!--end::Body-->
</div>
<!--end::Advance Table Widget 4-->
</div>

</div>
<div class="row">

<div class="col-lg-12">
    <!--begin::Mixed Widget 14-->
    <div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
    <h3 class="card-title font-weight-bolder">Workflow Hari Ini</h3>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-0 mt-0">
        <div data-scroll="true" data-height="450">
            {!! $workflow->note_isi !!}
        </div>
    </div>
    <!--end::Body-->
    </div>
    <!--end::Mixed Widget 14-->
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
