@extends('layouts.app')
@section('title','User - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Pengguna</span>
</h3>
<div class="card-toolbar">
<a href="{{url('user/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Tambah</a>
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
<th style="min-width: 50px"><span class="text-dark-75">User</span></th>
<th style="min-width: 100px">Email</th>
<th style="min-width: 100px">Role</th>
<th style="min-width: 80px">Action</th>
</tr>
</thead>
<tbody>
    @foreach($user as $u)
<tr>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
    <a href="#" class="text-dark-75 mb-1">{{$u->name}}</a>
</div>
</td>
<td>
<span class="text-dark-75 d-block">
{{$u->email}}
</span>
</td>
<td>
@if($u->role == 1)
<span class="label label-lg label-rounded label-danger label-jabatan">Admin Owner</span>
@elseif($u->role == 2)
<span class="label label-lg label-rounded label-primary label-jabatan">Toko</span>
@elseif($u->role == 3)
<span class="label label-lg label-rounded label-primary label-jabatan">Sosmed</span>
@elseif($u->role == 4)
<span class="label label-lg label-rounded label-primary label-jabatan">Gudang</span>
@elseif($u->role == 5)
<span class="label label-lg label-rounded label-primary label-jabatan">Kasir</span>
@endif
</td>
<td>
    <a href="{{url('/user/detail/'.$u->id)}}" class="btn btn-xs btn-icon btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
    <a href="{{url('/user/edit/'.$u->id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/user/delete/'.$u->id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
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
       title: 'Yakin untuk menghapus akun ini ? ',
       text: 'SEMUA DATA mengenai akun ini akan dihapus dan tidak dapat dikembalikan!',
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
