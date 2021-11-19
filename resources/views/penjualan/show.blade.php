@extends('layouts.app')
@section('title','Detail Produk - ')
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
    <div class="card card-custom gutter-b">
        <!--begin::Card Body-->
        <div class="card-body d-flex rounded bg-danger p-12 flex-column flex-md-row flex-lg-column flex-xxl-row">
            <!--begin::Image-->
            <div class="bgi-no-repeat bgi-position-center bgi-size-cover h-300px h-md-auto h-lg-300px h-xxl-auto mw-100 w-550px" style="background-image: url('{{url($show->produk_foto)}}')"></div>
            <!--end::Image-->
            <!--begin::Card-->
            <div class="card card-custom w-auto w-md-300px w-lg-auto w-xxl-300px ml-auto">
                <!--begin::Card Body-->
                <div class="card-body px-12 py-10">
                    <h3 class="font-weight-bolder font-size-h2 mb-1">
                        <a href="#" class="text-dark-75">{{$show->produk_nama}}</a>
                    </h3>
                    <div class="text-primary font-size-h4">Harga Jual Rp {{$show->produk_hargajual}}</div>
                    <div class="text-primary font-size-h4 mb-9">Harga Beli Rp {{$show->produk_hargabeli}}</div>
                    <!--begin::Info-->
                    <div class="d-flex mb-3">
                        <span class="text-dark-50 flex-root font-weight-bold">SKU</span>
                        <span class="text-dark flex-root font-weight-bold">{{$show->produk_sku}}</span>
                    </div>
                    <div class="d-flex mb-3">
                        <span class="text-dark-50 flex-root font-weight-bold">Size</span>
                        <span class="text-dark flex-root font-weight-bold">{{$show->size_nama}}</span>
                    </div>
                    <div class="d-flex mb-3">
                        <span class="text-dark-50 flex-root font-weight-bold">Band</span>
                        <span class="text-dark flex-root font-weight-bold">{{$show->band_nama}}</span>
                    </div>
                    <div class="d-flex mb-3">
                        <span class="text-dark-50 flex-root font-weight-bold">Vendor</span>
                        <span class="text-dark flex-root font-weight-bold">{{$show->vendor_nama}}</span>
                    </div>
                    <div class="d-flex">
                        <span class="text-dark-50 flex-root font-weight-bold">In Stock</span>
                        <span class="text-dark flex-root font-weight-bold">{{$show->produk_stok}}</span>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Card Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Card Body-->
    </div>
<!--begin::Advance Table Widget 4-->
<div class="card card-custom gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Riwayat Penjualan Produk (Keluar)</span>
</h3>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
    <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
        <thead>
            <tr>
                <th>Foto</th>
                <th>SKU</th>
                <th>Nama Produk</th>
                <th>Size</th>
                <th>Vendor</th>
                <th>Band</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="#" class="img-fluid w-50 h-100"></td>
                <td>{{$show->produk_sku}}</td>
                <td>{{$show->produk_nama}}</td>
                <td>
                    @if($show->produk_idsize == 1)
                    S
                    @elseif($show->produk_idsize == 2)
                    M
                    @elseif($show->produk_idsize == 3)
                    L
                    @elseif($show->produk_idsize == 4)
                    XL
                    @elseif($show->produk_idsize == 5)
                    XXL
                    @elseif($show->produk_idsize == 6)
                    XXXL
                    @elseif($show->produk_idsize == 7)
                    ALL SIZE
                    @endif
                   </td>
                <td>{{$show->vendor_nama}}</td>
                <td>{{$show->band_nama}}</td>
                <td>{{$show->produk_hargajual}}</td>
                <td>{{$show->produk_stok}}</td>
                <td>
                    <a href="{{url('/produk/detail/'.$show->produk_id)}}" class="btn btn-sm btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
                    <a href="{{url('/produk/edit/'.$show->produk_id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit nopadding"></i></a>
                    <button type="button" href="{{url('/produk/delete/'.$show->produk_id)}}" class="deletebtn btn btn-sm btn-danger"><i class="fas fa-trash nopadding"></i></button>
                </td>
            </tr>

        </tbody>
    </table>

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
    "use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
    // Private functions

    // demo initializer
    var demo = function() {

		var datatable = $('#kt_datatable').KTDatatable({});



    };

    return {
        // Public functions
        init: function() {
            // init dmeo
            demo();
        },
    };
}();

jQuery(document).ready(function() {
	KTDatatableHtmlTableDemo.init();
});

</script>
@endsection
@endsection
