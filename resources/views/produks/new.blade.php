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
        <input type="hidden" name="ajaxurl" id="ajax" value="{{url('api/getproductmastersku')}}">
        <div id="wrapperinput">
        </div>
        <div class="row">
            <div class="col-md-6">
                  <div id="skulama" class="form-group row mt-4 collapse">
                    <label class="col-md-2">SKU Lama</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_barcodelama" >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">SKU/Barcode Vendor</label>
                    <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="product_barcodevendor" >
                    </div>
                  </div>
                <div class="form-group row mt-4">
                    <label class="col-md-2">Master SKU <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control select2" name="product_mastersku" id="selectsku" required>
                          @foreach($barcode as $barcode)
                          <option value="{{$barcode->barcode_mastersku}}">{{$barcode->barcode_mastersku}} : {{$barcode->band_nama}} - {{$barcode->barcode_productname}}</option>
                          @endforeach
                          <option value="NEW" selected>Buat Baru</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group row mt-4">
                    <label class="col-md-2">Nama Produk <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                    <input id="product_name" type="text" class="form-control" name="product_nama" required>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-2">Tipe Produk <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                      <select class="form-control select2" name="product_typeid" id="selecttype" required>
                        @foreach($type as $type)
                        <option value="{{$type->type_id}}" data-category="{{$type->type_category}}">({{$type->type_category}}) {{$type->type_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row mt-4">
                      <label class="col-md-2">Vendor <span class="text-danger">*</span></label>
                      <div class="col-md-10">
                        <select class="form-control select2" id="selectvendor" name="product_vendor[]" multiple="multiple" required>
                            @foreach($vendor as $v)
                            <option value="{{$v->vendor_id}}">{{$v->vendor_nama}}</option>
                            @endforeach
                           </select>
                      </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-2">Warna <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                          <select class="form-control select2" name="product_color" id="selectcolor" required>
                            @foreach($color as $s)
                            <option value="{{$s->color_id}}">{{$s->color_nama}} ({{$s->color_code}})</option>
                            @endforeach
                          </select>

                        </div>
                      </div>

                    {{-- <div class="form-group row mt-4">
                        <label class="col-md-2">Size <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                          <select class="form-control select2" id="selectsize" name="product_idsize" required>
                             foreach($size as $s)
                            <option value="{{$s->size_id}}">{{$s->size_nama}}</option>
                             endforeach
                          </select>
                        </div>
                      </div> --}}
                      <div class="form-group row mt-4">
                        <label class="col-md-2">Band <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                          <select class="form-control select2" name="product_idband" id="selectband" required>
                            @foreach($band as $b)
                            <option value="{{$b->band_id}}">{{$b->band_nama}}</option>
                            @endforeach

                          </select>

                        </div>
                      </div>


            </div>
            <div class="col-md-6">
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

        <div id="sizedewasa" class="row collapse">
            <div class="col-md-12">
            <table class="table table-bordered mt-5" id="product">
                <thead>
                    <tr>
                        <th width="10%">Size</th>
                        <th width="15%">Harga Beli</th>
                        <th width="15%">Harga Jual</th>
                        <th width="15%">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sizedewasa as $sd)
                    <tr>
                        <input type="hidden" name="sized_id[]" value="{{$sd->size_id}}">
                        <td>{{$sd->size_nama}}</td>
                        <td><input type="number" value="0" class="form-control" name="hargabelid[]"></td>
                        <td><input type="number" value="0" class="form-control" name="hargajuald[]"></td>
                        <td><input type="number" value="0" class="form-control" name="stokawald[]"></td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>

        <div id="sizeanakanak" class="row collapse">
            <div class="col-md-12">
            <table class="table table-bordered mt-5" id="product">
                <thead>
                    <tr>
                        <th width="10%">Size</th>
                        <th width="15%">Harga Beli</th>
                        <th width="15%">Harga Jual</th>
                        <th width="15%">Stok</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($sizeanak as $sa)
                    <tr>
                        <input type="hidden" name="sizea_id[]" value="{{$sa->size_id}}">
                        <td>{{$sa->size_nama}}</td>
                        <td><input type="number" value="0" class="form-control" name="hargabelia[]"></td>
                        <td><input type="number" value="0" class="form-control" name="hargajuala[]"></td>
                        <td><input type="number" value="0" class="form-control" name="stokawala[]"></td>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            </div>
        </div>

        <div id="sizebarang" class="row collapse">
            <div class="col-md-12">
            <table class="table table-bordered mt-5" id="product">
                <thead>
                    <tr>
                        <th width="10%">Size</th>
                        <th width="15%">Harga Beli</th>
                        <th width="15%">Harga Jual</th>
                        <th width="15%">Stok</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($sizebarang as $sb)
                    <tr>
                        <input type="hidden" name="sizeb_id[]" value="{{$sb->size_id}}">
                        <td>{{$sb->size_nama}}</td>
                        <td><input type="number" value="0" class="form-control" name="hargabelib[]"></td>
                        <td><input type="number" value="0" class="form-control" name="hargajualb[]"></td>
                        <td><input type="number" value="0" class="form-control" name="stokawalb[]"></td>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
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
    // A $( document ).ready() block.
$( document ).ready(function() {
    kategori = $('#selecttype option:selected').attr('data-category');
    if(kategori == "Dewasa") {
                    $('#sizedewasa').collapse('show');
                    $('#sizeanakanak').collapse('hide');
                    $('#sizebarang').collapse('hide');

                }else if(kategori == "Anak Anak") {
                    $('#sizedewasa').collapse('hide');
                    $('#sizeanakanak').collapse('show');
                    $('#sizebarang').collapse('hide');

                }else if(kategori == "Barang") {
                    $('#sizedewasa').collapse('hide');
                    $('#sizeanakanak').collapse('hide');
                    $('#sizebarang').collapse('show');

                }

    selected = $("#selectsku").val();
            console.log(selected);
                if(selected == "NEW") {
                    $('#selecttype').prop("disabled", false);
                    $('#selectband').prop("disabled", false);
                    $('#selectcolor').prop("disabled", false);
                    $('#productname').prop("readonly", false);
                    $('#hiddencolor').remove();
                    $('#hiddentype').remove();
                    $('#hiddenband').remove();
                }
                else {
                $.ajax({
                url: "{{url('api/getproductmastersku')}}",
                type: 'GET',
                data: {'mastersku' : selected},
                success: function (data) {
                    if (data['status'] == "Success") {
                        $('#selecttype').val(data['product_type']).trigger('change');
                        $('#selectcolor').val(data['product_color']).trigger('change');
                        $('#selectband').val(data['product_band']).trigger('change');
                        $('#product_name').val(data['product_nama']);
                        $('#hiddencolor').remove();
                    $('#hiddentype').remove();
                    $('#hiddenband').remove();
                        $('#wrapperinput').append(`<input type="hidden" name="product_color" id="hiddencolor" value="${data['product_color']}">`);
                        $('#wrapperinput').append(`<input type="hidden" name="product_typeid" id="hiddentype" value="${data['product_type']}">`);
                        $('#wrapperinput').append(`<input type="hidden" name="product_idband" id="hiddenband" value="${data['product_band']}">`);
                        $('#selecttype').prop("disabled", true);
                    $('#selectband').prop("disabled", true);
                    $('#selectcolor').prop("disabled", true);
                    $('#product_name').prop("readonly", true);
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

$("#selecttype").change(function() {
            selected = $("#selecttype").val();
            kategori = $('#selecttype option:selected').attr('data-category');
            console.log(selected);
                if(kategori == "Dewasa") {
                    $('#sizedewasa').collapse('show');
                    $('#sizeanakanak').collapse('hide');
                    $('#sizebarang').collapse('hide');
                    console.log(kategori);
                }else if(kategori == "Anak Anak") {
                    $('#sizedewasa').collapse('hide');
                    $('#sizeanakanak').collapse('show');
                    $('#sizebarang').collapse('hide');
                    console.log(kategori);
                }else if(kategori == "Barang") {
                    $('#sizedewasa').collapse('hide');
                    $('#sizeanakanak').collapse('hide');
                    $('#sizebarang').collapse('show');
                    console.log(kategori);
                }

});

$("#selectsku").change(function() {
            selected = $("#selectsku").val();
            console.log(selected);
                if(selected == "NEW") {
                    $('#selecttype').prop("disabled", false);
                    $('#selectband').prop("disabled", false);
                    $('#selectcolor').prop("disabled", false);
                    $('#productname').prop("readonly", false);
                    $('#hiddencolor').remove();
                    $('#hiddentype').remove();
                    $('#hiddenband').remove();
                }
                else {
                $.ajax({
                url: $('#ajax').val(),
                type: 'GET',
                data: {'mastersku' : selected},
                success: function (data) {
                    if (data['status'] == "Success") {
                        $('#selecttype').val(data['product_type']).trigger('change');
                        $('#selectcolor').val(data['product_color']).trigger('change');
                        $('#selectband').val(data['product_band']).trigger('change');
                        $('#product_name').val(data['product_nama']);
                        $('#hiddencolor').remove();
                    $('#hiddentype').remove();
                    $('#hiddenband').remove();
                        $('#wrapperinput').append(`<input type="hidden" name="product_color" id="hiddencolor" value="${data['product_color']}">`);
                        $('#wrapperinput').append(`<input type="hidden" name="product_typeid" id="hiddentype" value="${data['product_type']}">`);
                        $('#wrapperinput').append(`<input type="hidden" name="product_idband" id="hiddenband" value="${data['product_band']}">`);
                        $('#selecttype').prop("disabled", true);
                    $('#selectband').prop("disabled", true);
                    $('#selectcolor').prop("disabled", true);
                    $('#product_name').prop("readonly", true);
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
