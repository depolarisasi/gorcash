@extends('layouts.app')
@section('title','Detail Penjualan - ')
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
        <div class="card-body p-0">
            <!-- begin: Invoice-->
            <!-- begin: Invoice header-->
            <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                <div class="col-md-10">
                    <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                        <h1 class="display-4 font-weight-boldest mb-10">Detail Penjualan</h1>
                        <div class="d-flex flex-column align-items-md-end px-0">
                            <!--begin::Logo-->
                            <a href="#" class="mb-5">
                                <img src="{{asset('assets/media/logos/logo-light.png')}}" alt="">
                            </a>
                            <!--end::Logo-->
                            <span class="d-flex flex-column align-items-md-end opacity-70">
                                <span>Jl Guntursari Wetan No 1,  Jl. Guntursari Wetan No.1, Turangga, Kec. Lengkong</span>
                                <span>Kota Bandung, Jawa Barat 40264</span>
                            </span>
                        </div>
                    </div>
                    <div class="border-bottom w-100"></div>
                    <div class="d-flex justify-content-between pt-6">
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">Tanggal Penjualan</span>
                            <span class="opacity-70">{{$penjualan->penjualan_tanggalpenjualan}}</span>
                        </div>
                        
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">Informasi Penjualan.</span>
                            <span>Invoice No : {{$penjualan->penjualan_invoice}}</span>
                            <span>Channel : {{$penjualan->penjualan_channel}}</span>
                                <span>Nama Customer : {{$penjualan->penjualan_customername}}</span>
                                <span>Kasir : {{$penjualan->name}}</span> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: Invoice header-->
            <!-- begin: Invoice body-->
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pl-0 font-weight-bold text-muted text-uppercase">Item yang Dibeli</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangterjual as $b)
                                <tr class="font-weight-boldest">
                                    <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                      <img src="{{asset($b->product_foto?$b->product_foto:"/assets/nopicture.png")}}" class="img-fluid" style="width:50px !important; height:50px !important;">
                                    </div>
                                    <!--end::Symbol-->
                                    {{$b->product_nama}}</td>
                                    <td class="text-right pt-7 align-middle">{{$b->barangterjual_qty}}</td>
                                    <td class="text-right pt-7 align-middle">{{$b->product_hargajual}}</td>
                                    <td class="text-primary pr-0 pt-7 text-right align-middle">{{$b->barangterjual_totalbarangterjual}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end: Invoice body-->
            <!-- begin: Invoice footer-->
            <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-muted text-uppercase">PAYMENT TYPE</th>  
                                    <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL PAID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-weight-bolder">
                                    <td>{{$penjualan->penjualan_paymentype}}</td> 
                                    <td class="text-primary font-size-h3 font-weight-boldest text-right">{{$penjualan->penjualan_paymenttotal}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end: Invoice footer-->
            <!-- begin: Invoice action-->
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                <div class="col-md-10">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Order Details</button>
                        <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Order Details</button>
                    </div>
                </div>
            </div>
            <!-- end: Invoice action-->
            <!-- end: Invoice-->
        </div>
    </div>
<!--begin::Advance Table Widget 4-->
 
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
