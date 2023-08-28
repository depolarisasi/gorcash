@extends('layouts.app')
@section('title','Log Point - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Log Point</span>
</h3>
<div class="card-toolbar">
<a href="{{url('slipgaji/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Tambah</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

<div class="tab-content">
<!--begin::Table-->
<div class="table-responsive">
    <table id="basic-datatable" class="table dt-responsive table-bordered nowrap" style="width:100%">
<thead>
<tr class="text-left">
<th style="min-width: 50px"><span class="text-dark-75">Tanggal</span></th>
<th style="min-width: 100px">Member</th>
<th style="min-width: 100px">Point</th>
<th style="min-width: 100px">Type</th>
<th style="min-width: 100px">Keterangan</th>
</tr>
</thead>
<tbody>
    @foreach($point as $c)
<tr>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  {{\Carbon\Carbon::parse($c->date)->format('d-m-Y')}}
</div>
</td>
<td>
<span class="text-dark-75 d-block">
{{$c->customer_nama}}
</span>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  {{$c->points}}
</div>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  @if($c->type == 1) by Order @else Manual by Admin @endif
</div>
</td>

<td class="pl-3 py-3">
    <div class="d-flex align-items-center">
      {{$c->data}}
    </div>
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
<!--end::Row-->
<!--end::Dashboard-->
</div>
<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->
@section('js')

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
<script>
    $(document).ready(function(){


        var table = $("#basic-datatable").DataTable({

language: { paginate: {
   previous: "<i class='uil uil-angle-left'>",
   next: "<i class='uil uil-angle-right'>" } },
drawCallback: function () {
$(".dataTables_paginate > .pagination").addClass("pagination-rounded");
}
           });
            });

                            </script>
@endsection
@endsection
