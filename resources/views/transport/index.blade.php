@extends('layouts.app')
@section('title','Transport - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Transport</span>
</h3>
<div class="card-toolbar">

<button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#kirpaket">
   Tambah Transport
</button>
<a href="{{url('transport/laporan')}}" class="btn btn-secondary">Laporan Transport</a>
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
                <h5 class="modal-title" id="kirpaketLabel">Transport</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{url('transport/kirim')}}">
        @csrf
        <input type="hidden" class="form-control" name="kirimpaket_user" value="{{Auth::user()->id}}">
        <div class="form-group row mt-4">
            <label class="col-md-4">Kegiatan</label>
            <div class="col-md-6">
            <select class="form-control" id="kegiatanselector" name="kirimpaket_kegiatan">
             <option value="1">Kirim Paket</option>
             <option value="2">Transport</option>
              </select>
            </div>
          </div>
        <div class="form-group row mt-4" id="jumlahbarang">
            <label class="col-md-4">Jumlah Barang</label>
            <div class="col-md-6">
            <input type="number" class="form-control" name="kirimpaket_jumlahpaket" required>
            </div>
          </div>
          <div class="form-group row mt-4" id="tanggal">
            <label class="col-md-4">Tanggal</label>
            <div class="col-md-6">
                <p>{{\Carbon\Carbon::now()->format('d M Y')}}</p>
            <input type="hidden" class="form-control" name="kirimpaket_tanggal" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}}">

            </div>
          </div>
          <div class="form-group row mt-4" id="kendaraan">
            <label class="col-md-4">Kendaraan</label>
            <div class="col-md-6">
            <select class="form-control" id="waktu" name="kirimpaket_kendaraan">
             <option value="Sepeda">Sepeda</option>
             <option value="Kendaraan Pribadi">Kendaraan Pribadi</option>
             <option value="Lainnya">Lainnya</option>
              </select>
            </div>
          </div>
          <div class="form-group row mt-4" id="waktupengiriman">
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
            <label class="col-md-4">Keterangan</label>
            <div class="col-md-6">
          <textarea class="form-control" name="kirimpaket_keterangan"></textarea>
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
<th style="min-width: 50px"><span class="text-dark-75">Kegiatan</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Kendaraan</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Keterangan</span></th>
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
    {{$kirimpaket->kirimpaket_kegiatan == 1 || $kirimpaket->kirimpaket_kegiatan == NULL ?"Kirim Paket":"Transport"}}
    </div>
    </td>

    <td>
        <div class="d-flex align-items-center">
        {{$kirimpaket->kirimpaket_kendaraan}}
        </div>
        </td>
<td>
    <div class="d-flex align-items-center">
        @if($kirimpaket->kirimpaket_kegiatan == 1 || $kirimpaket->kirimpaket_kegiatan == NULL)

   <p>Jumlah Paket: {{$kirimpaket->kirimpaket_jumlahpaket}} <br> Waktu Pengiriman: {{$kirimpaket->kirimpaket_waktupengiriman}} </p>
   &nbsp;
   @endif
   {{$kirimpaket->kirimpaket_keterangan}}
    </div>
    </td>
@if(Auth::user()->role == 1 || Auth::user()->role == 6)
<td>
    <a href="{{url('/transport/edit/'.$kirimpaket->kirimpaket_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/transport/delete/'.$kirimpaket->kirimpaket_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
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
        $('#kegiatanselector').on('change', function() {
          if ( this.value == '1')
          {
            $("#jumlahbarang").show();
            $("#waktupengiriman").show();
            $("#kendaraan").show();
            $("#ekspedisi").show();
          }
          else
          {
            $("#jumlahbarang").hide();
            $("#waktupengiriman").hide();
            $("#kendaraan").hide();
            $("#ekspedisi").hide();
          }
        });
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
