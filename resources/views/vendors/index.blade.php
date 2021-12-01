@extends('layouts.app')
@section('title','Vendor - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Vendor</span>
</h3>
<div class="card-toolbar">
<a href="{{url('vendors/import')}}" class="btn btn-primary btn-md font-size-sm mr-2"><i class="fas fa-plus"></i> Import</a>
<a href="{{url('vendors/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Buat</a>
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
<th style="min-width: 50px"><span class="text-dark-75">Nama Vendor</span></th>
<th style="min-width: 100px">Asal</th>
<th style="min-width: 100px">Website</th>
<th style="min-width: 80px">Action</th>
</tr>
</thead>
<tbody>
    @foreach($vendor as $vendor)
<tr>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
    <a href="#" class="text-dark-75 mb-1">{{$vendor->vendor_nama}}</a>
</div>
</td>
<td>
<span class="text-dark-75 d-block">
    @if($vendor->vendor_asal == 1)
    🇺🇸  Amerika Serikat (US)
    @elseif($vendor->vendor_asal == 2)
    <option value="2">🇪🇺 Eropa
    @elseif($vendor->vendor_asal == 3)
    <option value="3">🇬🇧 Inggris (UK)
    @endif
</span>
</td>
<td>
<span class="text-dark-75 d-block">
    {{$vendor->vendor_web}}
    </span>
</td>
<td>
    <a href="{{url('/vendors/detail/'.$vendor->vendor_id)}}" class="btn btn-xs btn-icon btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
    <a href="{{url('/vendors/edit/'.$vendor->vendor_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/vendors/delete/'.$vendor->vendor_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
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
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>>
<script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function(){


        $(document).on('click', '.deletebtn', function(e) {
           var href = $(this).attr('href');
           Swal.fire({
       title: 'Yakin untuk menghapus vendor ini ? ',
       text: 'SEMUA DATA mengenai vendor ini akan dihapus dan tidak dapat dikembalikan!',
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#95000c',
       confirmButtonText: 'Ya, Hapus!',
       cancelButtonText: 'Tidak, batalkan'
     }).then((result) => {
       if (result.value) {
          window.location.href = href;

       //  For more information about handling dismissals please visit
       // https://sweetalert2.github.io/#handling-dismissals
       } else if (result.dismiss === Swal.DismissReason.cancel) {
         Swal.fire(
           'Dibatalkan',
           'Data tidak jadi dihapus',
           'error'
         )
       }
     });

          });
            });

           var table = $("#basic-datatable").DataTable({

                 language: { paginate: {
                    previous: "<i class='uil uil-angle-left'>",
                    next: "<i class='uil uil-angle-right'>" } },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                }
                            });

                            </script>
@endsection
@endsection
