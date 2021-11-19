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
                    <label class="col-md-2">Master SKU</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_mastersku"  required >
                    </div>
                  </div>
                <div class="form-group row mt-4">
                    <label class="col-md-2">Product SKU</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_sku"  required >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Nama Produk</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_nama" required>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                      <label class="col-md-2">Vendor</label>
                      <div class="col-md-10">
                        <select class="form-control select2" id="kt_select2_3" name="product_vendor[]" multiple="multiple">
                            @foreach($vendor as $v)
                            <option value="{{$v->vendor_id}}">{{$v->vendor_nama}}</option>
                            @endforeach
                           </select>
                      </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Warna</label>
                        <div class="col-md-10">
                          <select class="multisteps-form__input form-control" name="product_color" required>
                            @foreach($color as $s)
                            <option value="{{$s->color_id}}">{{$s->color_nama}} ({{$s->color_code}})</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Size</label>
                        <div class="col-md-10">
                          <select class="multisteps-form__input form-control" name="product_idsize" required>
                            @foreach($size as $s)
                            <option value="{{$s->size_id}}">{{$s->size_nama}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-2">Band</label>
                        <div class="col-md-10">
                          <select class="multisteps-form__input form-control" name="product_idband" required>
                            @foreach($band as $b)
                            <option value="{{$b->band_id}}">{{$b->band_nama}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Stock</label>
                        <div class="col-md-10">
                        <input id="name" type="number" min="0" class="form-control" name="product_stok" required>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-2">Stock Akhir</label>
                        <div class="col-md-10">
                        <input id="name" type="number" min="0" class="form-control" name="product_stokakhir" required>
                        </div>
                      </div>

            </div>
            <div class="col-md-6">
                <div class="form-group row mt-4">
                    <label class="col-md-2">Harga Beli</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_hargabeli" >
                    </div>
                  </div>
                <div class="form-group row mt-4">
                    <label class="col-md-2">Harga Jual</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_hargajual" >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Material</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_material" >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Tag</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_tag" >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Made</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_madein" >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Condition</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_condition" >
                    </div>
                  </div>
                    <div class="form-group row mt-4">
                      <label class="col-md-2">Foto</label>
                      <div class="col-md-10">
                            <input  class="custom-file-input" name="product_foto" id="fotoproduk" accept="image/*" type="file"/>
                            <label class="custom-file-label" for="fotoproduk">Choose file</label>
                      </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Tanggal Beli</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" name="product_tanggalbeli"/>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-2">Tanggal Publish (kosongkan jika belum)</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" name="product_tanggalpublish"/>
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
@section('js')
<script>
     // multi select
  $('#kt_select2_3').select2({
   placeholder: "Select Vendor",
  });

</script>
@endsection
@endsection
