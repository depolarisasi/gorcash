@extends('layouts.app')
@section('title','Status Produk Harian Baru - ')
@section('css')
<link rel="stylesheet" type="text/css" id="mce-u0" href="{{asset('assets/js/tinymce/skins/ui/oxide/skin.min.css')}}">
@endsection
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
<span class="card-label font-weight-bolder text-dark">Status Produk Harian Baru</span>
</h3>
<div class="card-toolbar">
<a href="{{url('turunbarang/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
        @csrf
        <label class="form-label">ISI DAHULU NAMA DAN TANGGAL SEBELUM ISI PRODUK</label>
        <div class="form-group row mt-4">
            <label class="col-md-2">Nama Petugas</label>
            <div class="col-md-3">
            <input type="text" id="namapetugas" class="form-control" name="barangturun_namapetugas">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Tanggal Ambil</label>
            <div class="col-md-3">
            <input type="text" class="form-control" id="datepicker1" name="barangturun_tanggalambil" placeholder="Select date">
            </div>
          </div>
        <div class="form-group row mt-4">
            <label class="col-md-2">SKU Barang</label>
            <div class="col-md-3">
                <select class="form-control select2" id="productlist" name="barangturun_sku">
                    @foreach($product as $p)
                    <option value="{{$p->product_id}}">@if($p->product_productlama == 1) {{$p->product_barcodelama}} @endif{{$p->product_sku}} - {{$p->product_nama}} ({{$p->size_nama}})</option>
                    @endforeach
                   </select>
            </div>
          </div>





      <div class="form-group row mt-4">
        <div class="col-md-6">
        </div>
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
@section('js')
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script>
    $('#datepicker1').datepicker({
        format: "yyyy-mm-dd",
    });

    $(document).ready(function(){


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
var tanggal_val = $('#datepicker1').val();
var namapetugas = $('#namapetugas').val();
$.ajax({
        url: '/api/turunbarang',
        type: 'POST',
        data: {
            _token : "{{csrf_token()}}",
            'sku' : select_val,
            'petugas' : namapetugas,
            'tanggal' : tanggal_val,
        },
        success: function (data) {
            if (data['success']) {
                    t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw( false );
            } else if (data['error']) {
                 Swal.fire(
                 'Error',
                 'Terdapat kesalahan dalam memasukan ke daftar',
                 'error'
                 )
            } else {
                alert(data.responseText);
            }
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
});

$('#productlist').val('');
});
    </script>
@endsection
@endsection
