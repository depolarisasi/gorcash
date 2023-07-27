@extends('layouts.app')
@section('title','Tambah Resi - ')
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
<span class="card-label font-weight-bolder text-dark">Tambah Resi</span>
</h3>
<div class="card-toolbar">
<a href="{{url('penjualan/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('ongkir/tambahresi')}}">
        @csrf
        <input type="hidden" name="p" value="{{$edit->penjualan_id}}">
        <div class="form-group row mt-4">
            <label class="col-md-2">Nomor Resi</label>
            <div class="col-md-3">
            <input type="text" class="form-control" name="penjualan_resi" value="{{$edit->penjualan_resi}}" required autofocus>
            </div>
          </div>

          <div class="form-group row mt-4">
              <label class="col-md-2">Kurir</label>
              <div class="col-md-3">
                <select class="multisteps-form__input form-control" id="kurir" name="penjualan_kurir" required>
                    <option value="-" @if($edit->penjualan_kurir == "-") selected @endif>None</option>
                    <option value="GoSend" @if($edit->penjualan_kurir == "GoSend") selected @endif>GoSend</option>
                    <option value="GrabExpress" @if($edit->penjualan_kurir == "GrabExpress") selected @endif>GrabExpress</option>
                    <option value="JNE" @if($edit->penjualan_kurir == "JNE") selected @endif>JNE</option>
                    <option value="J&T" @if($edit->penjualan_kurir == "J&T") selected @endif>J&T</option>
                    <option value="SiCepat" @if($edit->penjualan_kurir == "SiCepat") selected @endif>SiCepat</option>
                    <option value="Anteraja" @if($edit->penjualan_kurir == "Anteraja") selected @endif>Anteraja</option>
                    <option value="Ninja Express" @if($edit->penjualan_kurir == "Ninja Express") selected @endif>Ninja Express</option>
                    <option value="ID Express" @if($edit->penjualan_kurir == "ID Express") selected @endif>ID Express</option>
                    <option value="Pos Indonesia" @if($edit->penjualan_kurir == "Pos Indonesia") selected @endif>Pos Indonesia</option>
                    <option value="Shopee Express" @if($edit->penjualan_kurir == "Shopee Express") selected @endif>Shopee Express</option>
                  </select>
              </div>
            </div>
            <div class="form-group row mt-4">
              <label class="col-md-2">Ongkos Kirim</label>
              <div class="col-md-3">
              <input type="text" class="form-control" name="penjualan_ongkoskirim" value="{{$edit->penjualan_ongkoskirim}}">
              </div>
            </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Tambah Resi</button>
        </div>
    </div>

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
@endsection
