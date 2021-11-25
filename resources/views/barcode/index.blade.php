@extends('layouts.app')
@section('title','Barcode - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
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
<span class="card-label font-weight-bolder text-dark">Daftar Barcode</span>
</h3>
<div class="card-toolbar">
<a href="{{url('barcode/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Buat</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<!--begin::Table-->
<div class="table-responsive">
    <table id="barcode" class="table dt-responsive table-bordered nowrap" style="width:100%">
<thead>
<tr class="text-left">
<th style="min-width: 50px"><span class="text-dark-75">Master SKU</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Product Name</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Product Band</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Product Type Produk</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Product Desain</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Product Color</span></th>
<th style="min-width: 80px">Action</th>
</tr>
</thead>
<tbody>
    @foreach($barcode as $barcode)
<tr>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">{{$barcode->barcode_mastersku}}</div>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">{{$barcode->barcode_productname}}</div>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">{{$barcode->band_nama}}</div>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">{{$barcode->type_name}}</div>
</td>

<td class="pl-3 py-3">
<div class="d-flex align-items-center">{{$barcode->barcode_productseri}}</div>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">{{$barcode->color_nama}}</div>
</td>
<td>
    <a href="{{url('/barcode/edit/'.$barcode->barcode_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>

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

            tabel = $('#barcode').DataTable({
    dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdfHtml5',
        ],
        "paging":   true,
        "ordering": true,
    } );


                            </script>
@endsection
@endsection
