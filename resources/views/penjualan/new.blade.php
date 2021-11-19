@extends('layouts.app')
@section('title','Produk Baru - ')
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
<span class="card-label font-weight-bolder text-dark">Produk Baru</span>
</h3>
<div class="card-toolbar">
<a href="{{url('produk/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('produk/store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row mt-4">
                    <label class="col-md-2">SKU</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="produk_sku"  required >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Nama Produk</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="produk_nama" required>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                      <label class="col-md-2">Vendor</label>
                      <div class="col-md-10">
                        <select class="multisteps-form__input form-control" name="produk_idvendor" required>
                          @foreach($vendor as $v)
                          <option value="{{$v->vendor_id}}">{{$v->vendor_nama}}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Size</label>
                        <div class="col-md-10">
                          <select class="multisteps-form__input form-control" name="produk_idsize" required>
                            @foreach($size as $s)
                            <option value="{{$s->size_id}}">{{$s->size_nama}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-2">Band</label>
                        <div class="col-md-10">
                          <select class="multisteps-form__input form-control" name="produk_idband" required>
                            @foreach($band as $b)
                            <option value="{{$b->band_id}}">{{$b->band_nama}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Stock</label>
                        <div class="col-md-10">
                        <input id="name" type="number" min="0" class="form-control" name="produk_stok" required>
                        </div>
                      </div>

            </div>
            <div class="col-md-6">
                <div class="form-group row mt-4">
                    <label class="col-md-2">Harga Beli</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="produk_hargabeli" >
                    </div>
                  </div>
                <div class="form-group row mt-4">
                    <label class="col-md-2">Harga Jual</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="produk_hargajual" >
                    </div>
                  </div>


                    <div class="form-group row mt-4">
                      <label class="col-md-2">Foto</label>
                      <div class="col-md-10">
                            <input  class="custom-file-input" name="produk_foto" id="fotoproduk" accept="image/*" type="file"/>
                            <label class="custom-file-label" for="fotoproduk">Choose file</label>
                      </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Tanggal Beli</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" name="produk_tanggalbeli"/>
                        </div>
                      </div>

            </div>
        </div>



      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Tambah Produk</button>
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
