@extends('layouts.app')
@section('title','Kategori Pengajuan Dana - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Kategori Pengajuan Dana</span>
</h3>
<div class="card-toolbar">
<a href="{{url('kategoripengajuan/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Tambah</a>
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
<th style="min-width: 100px">Nama Pengajuan</th> 
<th style="min-width: 100px">Action</th>
</tr>
</thead>
<tbody>
    @foreach($kategoripengajuan as $k)
<tr> 
<td>
<span class="text-dark-75 d-block">
{{$k->catpengajuan_nama}}
</span>
</td>  

<td> 
    <a href="{{url('/kategoripengajuan/edit/'.$k->catpengajuan_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/kategoripengajuan/delete/'.$k->catpengajuan_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
  
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
 
<script>
    $(document).ready(function(){


      $(document).on('click', '.deletebtn', function(e) {
           var href = $(this).attr('href');
           Swal.fire({
       title: 'Yakin untuk menghapus riwayat ini ? ',
       text: 'SEMUA DATA mengenai riwayat ini akan dihapus dan tidak dapat dikembalikan!',
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

                            </script>
@endsection
@endsection
