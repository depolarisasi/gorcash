@extends('layouts.app')
@section('title','Ubah Barcode - ')
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
<span class="card-label font-weight-bolder text-dark">Ubah Barcode</span>
</h3>
<div class="card-toolbar">
<a href="{{url('barcode/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('barcode/update')}}">
        @csrf
        <input type="hidden" name="barcode_id" value="{{$edit->barcode_id}}">
        <div class="form-group row mt-4">
            <label class="col-md-2">Master SKU <span class="text-danger">*</span></label>
            <div class="col-md-6">
            <p>{{$edit->barcode_mastersku}}</p>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Nama Produk <span class="text-danger">*</span></label>
            <div class="col-md-6">
            <input id="barcode_productname" type="text" class="form-control" name="barcode_productname" value="{{$edit->barcode_productname}}" required>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Tipe Produk <span class="text-danger">*</span></label>
            <div class="col-md-6">
              <select class="form-control select2" name="barcode_producttype" id="selecttype" required>
                <option value="{{$edit->barcode_producttype}}">{{$edit->type_name}}</option>
                @foreach($type as $type)
                <option value="{{$type->type_id}}" data-category="{{$type->type_category}}">({{$type->type_category}}) {{$type->type_name}}</option>
                @endforeach
              </select>
            </div>
          </div>

            <div class="form-group row mt-4">
                <label class="col-md-2">Warna <span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <select class="form-control select2" name="barcode_productcolor" id="selectcolor" required>
                    <option value="{{$edit->barcode_productcolor}}">{{$edit->color_nama}} ({{$edit->color_code}})</option>
                    @foreach($color as $s)
                    <option value="{{$s->color_id}}">{{$s->color_nama}} ({{$s->color_code}})</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row mt-4">
                <label class="col-md-2">Band <span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <select class="form-control select2" name="barcode_productband" id="selectband" required>
                    <option value="{{$edit->barcode_productband}}">{{$edit->band_nama}}</option>
                    @foreach($band as $b)
                    <option value="{{$b->band_id}}">{{$b->band_nama}}</option>
                    @endforeach

                  </select>
                </div>
              </div>
      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Ubah Barcode</button>
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
@section('js')
<script>
   $('#selecttype').select2();
   $('#selectcolor').select2();
   $('#selectband').select2();
    </script>
@endsection
@endsection
