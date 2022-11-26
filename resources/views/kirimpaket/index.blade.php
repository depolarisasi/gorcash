@extends('layouts.app')
@section('title','Kirim Paket - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Kirim Paket</span>
</h3>
<div class="card-toolbar">

<button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#kirpaket">
   Tambah Kirim Paket
</button>
<a href="{{url('kirimpaket/laporan')}}" class="btn btn-secondary">Laporan Kirim Paket</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<!--begin::Table-->
<div class="row">
    <div class="col-md-12 mb-5">
 <!-- Button trigger modal-->

<!-- Modal-->
<div class="modal fade" id="kirpaket" tabindex="-1" role="dialog" aria-labelledby="kirpaketLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kirpaketLabel">Kirim Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{url('kirimpaket/kirim')}}">
        @csrf
        <div class="form-group row mt-4">
            <label class="col-md-4">Jumlah Barang</label>
            <div class="col-md-6">
            <input type="text" class="form-control" name="kirimpaket_jumlahpaket" required>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">Nama Petugas</label>
            <div class="col-md-6">
            <p>{{Auth::user()->name}}</p>
            <input type="hidden" class="form-control" name="kirimpaket_user" value="{{Auth::user()->id}}">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">Tanggal Kirim</label>
            <div class="col-md-6">
                <p>{{\Carbon\Carbon::now()->format('d M Y')}}</p>
            <input type="hidden" class="form-control" name="kirimpaket_tanggal" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}}">

            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">Waktu Pengiriman</label>
            <div class="col-md-6">
            <select class="form-control" id="waktu" name="kirimpaket_waktupengiriman">
             <option value="Pagi">Pagi</option>
             <option value="Sore">Sore</option>
             <option value="Malam">Malam</option>
              </select>
            </div>
          </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Submit</button>
        </div>
    </div>

      </form>
            </div>
        </div>
    </div>
</div>
    </div>

</div>
<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered mt-5" style="width:100%">
<thead>
<tr class="text-left">
<th style="min-width: 10px"><span class="text-dark-75">Tanggal</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Petugas</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Jumlah Paket</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Waktu Pengiriman</span></th>
@if(Auth::user()->role == 1 || Auth::user()->role == 6)
<th style="min-width: 80px">Action</th>
@endif
</tr>
</thead>
<tbody>
    @foreach($kirimpaket as $kirimpaket)
<tr>
<td>
<div class="d-flex align-items-center">
{{$kirimpaket->kirimpaket_tanggal}}
</div>
</td>
<td>
<div class="d-flex align-items-center">
{{$kirimpaket->name}}
</div>
</td>
<td>
    <div class="d-flex align-items-center">
    {{$kirimpaket->kirimpaket_jumlahpaket}}
    </div>
    </td>

<td>
    <div class="d-flex align-items-center">
    {{$kirimpaket->kirimpaket_waktupengiriman}}
    </div>
    </td>
@if(Auth::user()->role == 1 || Auth::user()->role == 6)
<td>
    <a href="{{url('/kirimpaket/edit/'.$kirimpaket->kirimpaket_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/kirimpaket/delete/'.$kirimpaket->kirimpaket_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
</td>
@endif
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
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script>


    $(document).ready(function(){

        $('#datepicker1').datepicker({
        format: "yyyy-mm-dd",
    });
        var table = $("#table").DataTable({
            "paging":   true,
            "ordering": true,
            "order": [[ 0, "desc" ]]
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
                        table.row.add( [
            data['id'],
            data['sku']+' : '+data['namaproduk']+' ('+data['size']+')',
            data['namapetugas'],
            data['tanggalambil'],
            '<a href="/turunbarang/kembali/'+data['id']+'" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a><button type="button" href="/turunbarang/kembali/'+data['id']+'" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>'
        ] ).draw( false );
                    } else if (data['error']) {
                         Swal.fire(
                         'Error',
                         'SKU tersebut tidak ada dalam daftar publish ini',
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
