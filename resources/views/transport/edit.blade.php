@extends('layouts.app')
@section('title','Ubah Riwayat Transport - ')
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
<span class="card-label font-weight-bolder text-dark">Ubah Riwayat Transport</span>
</h3>
<div class="card-toolbar">
<a href="{{url('transport/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<form method="POST" action="{{url('transport/update')}}">
        @csrf
        <input type="hidden" name="kirimpaket_id" value="{{$edit->kirimpaket_id}}">
        <div class="form-group row mt-4">
            <label class="col-md-4">Kegiatan</label>
            <div class="col-md-6">
            <select class="form-control" id="kegiatanselector" name="kirimpaket_kegiatan">
             <option value="1"  @if($edit->kirimpaket_kegiatan == "1") selected='selected' @endif>Kirim Paket</option>
             <option value="2"  @if($edit->kirimpaket_kegiatan == "2") selected='selected' @endif>Transport</option>
              </select>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">Nama Petugas</label>
            <div class="col-md-6">
                <select class="form-control" name="kirimpaket_user" required>
    @foreach($user as $u)
    <option value="{{$u->id}}" @if($edit->kirimpaket_user == $u->id) selected="selected" @endif>{{$u->name}} ({{$u->email}})</option>
    @endforeach
    </select>
            </div>
          </div>
          @if($edit->kirimpaket_kegiatan == "1" || $edit->kirimpaket_kegiatan == NULL)
        <div class="form-group row mt-4" id="jumlahbarang">
            <label class="col-md-4">Jumlah Paket</label>
            <div class="col-md-6">
            <input type="text" class="form-control" name="kirimpaket_jumlahpaket" value="{{$edit->kirimpaket_jumlahpaket}}">
            </div>
          </div>
          <div class="form-group row mt-4" id="ekspedisi">
            <label class="col-md-4">Ekspedisi</label>
            <div class="col-md-6">
            <select class="form-control" id="waktu" name="kirimpaket_ekspedisi">
             <option value="JNE" @if($edit->kirimpaket_ekspedisi == "JNT") selected='selected' @endif>JNE</option>
             <option value="J&T" @if($edit->kirimpaket_ekspedisi == "J&T") selected='selected' @endif>J&T</option>
             <option value="SiCepat" @if($edit->kirimpaket_ekspedisi == "SiCepat") selected='selected' @endif>SiCepat</option>
             <option value="Lainnya" @if($edit->kirimpaket_ekspedisi == "Lainnya") selected='selected' @endif>Lainnya</option>
              </select>
            </div>
          </div>
          <div class="form-group row mt-4" id="kendaraan">
            <label class="col-md-4">Kendaraan</label>
            <div class="col-md-6">
            <select class="form-control" id="waktu" name="kirimpaket_kendaraan">
             <option value="Sepeda" @if($edit->kirimpaket_kendaraan == "Sepeda") selected='selected' @endif>Sepeda</option>
             <option value="Kendaraan Pribadi" @if($edit->kirimpaket_kendaraan == "Kendaraan Pribadi") selected='selected' @endif>Kendaraan Pribadi</option>
             <option value="Lainnya" @if($edit->kirimpaket_kendaraan == "Lainnya") selected='selected' @endif>Lainnya</option>
              </select>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">Tanggal Kirim</label>
            <div class="col-md-6">
            <input type="date" class="form-control" name="kirimpaket_tanggal" value="{{$edit->kirimpaket_tanggal}}">
            </div>
          </div>
          <div class="form-group row mt-4" id="waktupengiriman">
            <label class="col-md-4">Waktu Pengiriman</label>
            <div class="col-md-6">
            <select class="form-control" id="waktu" name="kirimpaket_waktupengiriman">
             <option value="Pagi" @if($edit->kirimpaket_waktupengiriman == "Pagi") selected='selected' @endif>Pagi</option>
             <option value="Sore" @if($edit->kirimpaket_waktupengiriman == "Sore") selected='selected' @endif>Sore</option>
             <option value="Malam" @if($edit->kirimpaket_waktupengiriman == "Malam") selected='selected' @endif>Malam</option>
              </select>
            </div>
          </div>
          @endif
          <div class="form-group row mt-4">
            <label class="col-md-4">Keterangan</label>
            <div class="col-md-6">
          <textarea class="form-control" name="kirimpaket_keterangan">{{$edit->kirimpaket_keterangan}}</textarea>
            </div>
          </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Edit</button>
        </div>
    </div>

      </form>
      </form>
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

    $('#productlist').select2({
        placeholder: "Scan SKU disini",
        allowClear: true
    });

    $( document ).ready(function() {

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

$('#productlist').val("");
});
    </script>
@endsection
@endsection
