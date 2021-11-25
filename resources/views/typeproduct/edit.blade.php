@extends('layouts.app')
@section('title','Ubah Tipe Produk - ')
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
<span class="card-label font-weight-bolder text-dark">Ubah Tipe Produk</span>
</h3>
<div class="card-toolbar">
<a href="{{url('type/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('type/update')}}">
        @csrf
        <input type="hidden" name="type_id" value="{{$edit->type_id}}">
        <div class="form-group row mt-4">
            <label class="col-md-2">Nama Tipe Produk</label>
            <div class="col-md-3">
            <input id="name" type="text" class="form-control" name="type_name" value="{{$edit->type_name}}" required autofocus>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Code Tipe Produk</label>
            <div class="col-md-3">
            <input id="name" type="text" class="form-control" name="type_code" value="{{$edit->type_code}}" required autofocus>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Category Type Produk</label>
            <div class="col-md-3">
                <select class="multisteps-form__input form-control" name="type_category" required>
                    <option value="Dewasa" @if($edit->type_category == "Dewasa") selected @endif>Dewasa</option>
                    <option value="Anak Anak" @if($edit->type_category == "Anak Anak") selected @endif>Anak Anak</option>
                    <option value="Barang" @if($edit->type_category == "Barang") selected @endif>Barang</option>
                  </select>
            </div>
          </div>


      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Ubah Tipe Produk</button>
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
