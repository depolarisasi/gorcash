@extends('layouts.app')
@section('title','Ubah Produk - ')
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
<span class="card-label font-weight-bolder text-dark">Ubah Produk</span>
</h3>
<div class="card-toolbar">
<a href="{{url('produk/select/'.$edit->product_mastersku)}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('produk/update')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{$edit->product_id}}">
        <input type="hidden" name="ajaxurl" id="ajax" value="{{url('api/getproductmastersku')}}">
        <div class="row">
            <div class="col-md-6">

                  <div id="skulama" class="form-group row mt-4 collapse">
                    <label class="col-md-2">SKU Lama</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_barcodelama" value="{{$edit->product_barcodelama}}">
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">SKU/Barcode Vendor</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_barcodevendor" value="{{$edit->product_barcodevendor}}">
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Master SKU <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control select2" name="product_mastersku" id="selectsku" disabled>
                          <option value="{{$edit->product_mastersku}}">{{$edit->product_mastersku}}</option>
                        </select>
                      </div>
                  </div>
                <div class="form-group row mt-4">
                    <label class="col-md-2">SKU <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                    <input type="text" class="form-control" name="product_sku" value="{{$edit->product_sku}}" disabled>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Nama Produk <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                    <input type="text" class="form-control" name="product_nama" value="{{$edit->product_nama}}" disabled>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Vendor <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                      <select class="form-control select2" id="selectvendor" name="product_vendor[]" multiple="multiple">
                        @foreach($edit->product_vendor as $key => $val)
                        <option value="{{$key}}" selected>-- {{$val}} -- </option>
                        @endforeach
                        @foreach($vendor as $v)
                        <option value="{{$v->vendor_id}}">{{$v->vendor_nama}}</option>
                        @endforeach
                         </select>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Warna <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                      <select class="select2 form-control" name="product_color" id="selectcolor" disabled>
                        <option value="{{$edit->color_id}}" selected>-- {{$edit->color_nama}} ({{$edit->color_code}}) --</option>
                      </select>
                    </div>
                  </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Size <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                          <select class="select2 form-control" name="product_idsize" id="selectsize" disabled>
                            <option value="{{$edit->size_id}}" selected>-- {{$edit->size_nama}} --</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row mt-4">
                        <label class="col-md-2">Band <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                          <select class="select2 form-control" name="product_idband" id="selectband" disabled>
                            <option value="{{$edit->product_idband}}" selected>-- {{$edit->band_nama}} --</option>
                          </select>
                        </div>
                      </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Stock Awal <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                        <input type="number" min="0" class="form-control" name="product_stok" value="{{$edit->product_stok}}" @if(Auth::user()->role == 1 || Auth::user()->role == 6) required @endif @if(Auth::user()->role != 1 || Auth::user()->role != 6 ) disabled @endif>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-2">Stock Akhir <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                        <input type="number" min="0" class="form-control" name="product_stokakhir" value="{{$edit->product_stokakhir}}"  @if(Auth::user()->role == 1 || Auth::user()->role == 6) required @endif @if(Auth::user()->role != 1 || Auth::user()->role != 6 ) disabled @endif>
                        </div>
                      </div>


            </div>
            <div class="col-md-6">
              @if(Auth::user()->role == 1 || Auth::user()->role == 6 )
                <div class="form-group row mt-4">
                    <label class="col-md-2">Harga Beli <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                    <input type="text" class="form-control" name="product_hargabeli" value="{{$edit->product_hargabeli}}" >
                    </div>
                  </div>
                <div class="form-group row mt-4">
                    <label class="col-md-2">Harga Jual <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                    <input type="text" class="form-control" name="product_hargajual" value="{{$edit->product_hargajual}}" >
                    </div>
                  </div>
                  @endif
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Material</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_material" value="{{$edit->product_material}}" >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Tag</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_tag" value="{{$edit->product_tag}}"  >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Made</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_madein" value="{{$edit->product_madein}}"  >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Condition</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_condition"  value="{{$edit->product_condition}}" >
                    </div>
                  </div>


                    <div class="form-group row mt-4">
                      <label class="col-md-2">Foto</label>
                      <div class="col-md-10">
                        <img src="{{asset($edit->product_foto)}}" class="img-fluid w-50 h-75">
                        <div class="custom-file mt-2">
                            <input  class="custom-file-input" name="product_foto" id="fotoproduk" accept="image/*" type="file"/>
                            <label class="custom-file-label" for="fotoproduk">Choose file</label>
                           </div>
                      </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Tanggal Beli</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" name="product_tanggalbeli" value="{{$edit->product_tanggalbeli}}" />
                        </div>
                      </div>
                      @if($edit->product_status == 0)
                      <div class="form-group row mt-4">
                        <label class="col-md-2">Tanggal Publish (kosongkan jika belum)</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" name="product_tanggalpublish" />
                        </div>
                      </div>
                      @else
                      <div class="form-group row mt-4">
                        <label class="col-md-2">Tanggal Publish (kosongkan jika belum)</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" name="product_tanggalpublish" value="{{$edit->product_tanggalpublish}}"/>
                        </div>
                      </div>
                      @endif

            </div>
        </div>



      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Edit Produk</button>
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
    // A $( document ).ready() block.
$( document ).ready(function() {
    selected = $("#selectsku").val();
            console.log(selected);
                if(selected == "NEW") {
                    $('#selecttype').prop("disabled", false);
                    $('#selectband').prop("disabled", false);
                    $('#selectcolor').prop("disabled", false);
                    $('#productname').prop("disabled", false);
                }
                else {
                $.ajax({
                url: $('#ajax').val(),
                type: 'GET',
                data: {'mastersku' : selected},
                success: function (data) {
                    if (data['status'] == "Success") {
                        $('#selecttype option:contains(' + data['product_type'] + ')').prop({selected: true});
                        $('#selectband option:contains(' + data['product_band'] + ')').prop({selected: true});
                        $('#selectcolor option:contains(' + data['product_color'] + ')').prop({selected: true});
                        $('#product_name').val( data['product_nama']);
                        $('#selecttype').prop("disabled", true);
                    $('#selectband').prop("disabled", true);
                    $('#selectcolor').prop("disabled", true);
                    $('#product_name').prop("disabled", true);
                    } else if (data['status'] == "Failed") {
                      console.log("No Product Selected");
                    } else {
                      console.log(data);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });

                }
});

         $(".produklama").change(function() {
            checked =  $('input:checkbox:checked').length;
            console.log(checked);
                if(checked > 0) {
                    $('#skulama').collapse('show');
                }
                else {
                    $('#skulama').collapse('hide');
                }
});

$("#selectsku").change(function() {
            selected = $("#selectsku").val();
            console.log(selected);
                if(selected == "NEW") {
                    $('#selecttype').prop("disabled", false);
                    $('#selectband').prop("disabled", false);
                    $('#selectcolor').prop("disabled", false);
                    $('#productname').prop("disabled", false);
                }
                else {
                $.ajax({
                url: $('#ajax').val(),
                type: 'GET',
                data: {'mastersku' : selected},
                success: function (data) {
                    if (data['status'] == "Success") {
                        $('#selecttype option:contains(' + data['product_type'] + ')').prop({selected: true});
                        $('#selectband option:contains(' + data['product_band'] + ')').prop({selected: true});
                        $('#selectcolor option:contains(' + data['product_color'] + ')').prop({selected: true});
                        $('#product_name').val( data['product_nama']);
                        $('#selecttype').prop("disabled", true);
                    $('#selectband').prop("disabled", true);
                    $('#selectcolor').prop("disabled", true);
                    $('#product_name').prop("disabled", true);
                    } else if (data['status'] == "Failed") {
                      console.log("No Product Selected");
                    } else {
                      console.log(data);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });

                }
});


   $('#selectsku').select2();
   $('#selecttype').select2();
   $('#selectvendor').select2();
   $('#selectcolor').select2();
   $('#selectsize').select2();
   $('#selectband').select2();


</script>
@endsection
@endsection
