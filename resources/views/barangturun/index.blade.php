@extends('layouts.app')
@section('title','Barang - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
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
<span class="card-label font-weight-bolder text-dark">Daftar Barang</span>
</h3>
<div class="card-toolbar">
<a href="{{url('turunbarang/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Buat </a>
{{-- <a href="{{url('turunbarang/kembali')}}" class="btn btn-primary btn-md font-size-sm ml-3"><i class="fas fa-plus"></i> Kembalikan Barang </a> --}}
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<!--begin::Table-->
<div class="row">
    <div class="col-md-12">
        <div class="form-group row mt-4">
            <label class="col-md-2">Add Product SKU</label>
            <div class="col-md-6">
                <select class="form-control select2" id="productlist" name="param">
                    @foreach($product as $p)
                    <option value="{{$p->product_id}}">@if($p->product_productlama == 1) {{$p->product_barcodelama}} @endif{{$p->product_sku}} - {{$p->product_nama}} ({{$p->size_nama}})</option>
                    @endforeach
                   </select>
            </div>
          </div>
    </div>
     
</div>
<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered mt-5" style="width:100%">
<thead>
<tr class="text-left">
<th style="min-width: 50px"><span class="text-dark-75">Nama Barang</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Petugas</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Tanggal Ambil</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Tanggal Kembali</span></th>
<th style="min-width: 80px">Action</th>
</tr>
</thead>
<tbody>
    @foreach($barangturun as $barangturun)
<tr>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
    <a href="#" class="text-dark-75 mb-1">{{$barangturun->product_nama}} ({{$barangturun->size_nama}})</a>
</div>
</td>
<td class="pl-3 py-3">
    <div class="d-flex align-items-center">
        <a href="#" class="text-dark-75 mb-1">{{$barangturun->barangturun_namapetugas}}</a>
    </div>
    </td>
<td class="pl-3 py-3">
    <div class="d-flex align-items-center">
        <a href="#" class="text-dark-75 mb-1">{{$barangturun->barangturun_tanggalambil}}</a>
    </div>
    </td>

<td class="pl-3 py-3">
    <div class="d-flex align-items-center">
        <a href="#" class="text-dark-75 mb-1">{{$barangturun->barangturun_tanggalkembali}}</a>
    </div>
    </td>
<td>
    @if($barangturun->barangturun_tanggalkembali == NULL)
    <a href="{{url('/turunbarang/kembali/'.$barangturun->barangturun_id)}}" class="btn btn-xs btn-icon btn-primary"><i class="fas fa-arrow-right nopadding"></i></a>
   @endif
    <a href="{{url('/turunbarang/edit/'.$barangturun->barangturun_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/turunbarang/delete/'.$barangturun->barangturun_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
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

        var table = $("#table").DataTable({
            "paging":   true,
            "ordering": true,
            "order": [[ 2, "desc" ]]
           });

        $("#productlist").val(null).trigger('change');

        $('#productlist').select2({
   placeholder: "Masukan SKU Produk",
   allowClear: true, 
   language: {
        inputTooShort: function (args) {

            return "2 or more symbol.";
        },
        noResults: function () {
            return "Not Found.";
        },
        searching: function () {
            return "Searching...";
        }
    },
    minimumInputLength: 2,
  });

  $('#productlist').on('select2:select', function (e) {
    e.preventDefault();
    var select_val = $(e.currentTarget).val();
    $.ajax({
                url: '/api/turunbarang',
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'sku' : select_val, 
                },
                success: function (data) {
                    if (data['success']) {
                        table.row.add( [  counter +'.1',  ] ).draw( false );
                    } else if (data['error']) {
                         Swal.fire(
                         'Error',
                         'SKU tersebut tidak ada dalam daftar publish ini',
                         'error'
                         )
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
});  
  
$('#productlist').val('');

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
 
                            </script>
@endsection
@endsection
