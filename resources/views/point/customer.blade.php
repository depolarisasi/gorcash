@extends('layouts.app')
@section('title','Member - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Member</span>
</h3>
<div class="modal fade" id="modalcustomer" tabindex="-1" role="dialog" aria-labelledby="modalcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('customer/new')}}">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" type="text" name="customer_nama">
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input class="form-control" type="text" name="customer_nohp">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="customer_email">
                    </div>
                <button type="submit" class="btn btn-primary font-weight-bold">Tambah</button>
            </form>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="card-toolbar">
    <button type="button" class="btn btn-primary btn-md font-size-sm" data-toggle="modal" data-target="#modalcustomer">
        <i class="fas fa-plus"></i> Tambah
     </button>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

<div class="mb-7">

</div>
<div class="tab-content">
<!--begin::Table-->
<div class="table-responsive">
    <table id="basic-datatable" class="table dt-responsive table-bordered nowrap" style="width:100%">
<thead>
<tr class="text-left">
<th style="min-width: 50px"><span class="text-dark-75">Nama</span></th>
<th style="min-width: 100px">No HP</th>
<th style="min-width: 100px">Email</th>
<th style="min-width: 100px">Points</th>
<th style="min-width: 80px">Action</th>
</tr>
</thead>
<tbody>
    @foreach($customer as $c)
<tr>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  {{$c->customer_nama}}
</div>
</td>
<td>
<span class="text-dark-75 d-block">
{{$c->customer_nohp}}
</span>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  {{$c->customer_email}}
</div>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  {{$c->customer_points}}
</div>
</td>
<td>
    <a href="{{url('/customer/detail/'.$c->customer_id)}}" class="btn btn-xs btn-icon btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
    <a href="{{url('/customer/edit/'.$c->customer_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/customer/delete/'.$c->customer_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
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


        $(document).on('click', '.deletebtn', function(e) {
           var href = $(this).attr('href');
           Swal.fire({
       title: 'Yakin untuk menghapus Member ini ? ',
       text: 'SEMUA DATA mengenai Member ini akan dihapus dan tidak dapat dikembalikan!',
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
