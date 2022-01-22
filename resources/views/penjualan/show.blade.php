@extends('layouts.app')
@section('title','Detail Transaksi - ')
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
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                <div class="col-md-10">
                    <div class="d-flex justify-content-between pb-5 pb-md-10 flex-column flex-md-row">
                        <h1 class="display-4 font-weight-boldest">Detail Transaksi</h1>
                        <div class="card-toolbar">
                            <a href="{{url('penjualan/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">Tanggal Penjualan</span>
                            <span class="opacity-70">{{$penjualan->penjualan_tanggalwaktupenjualan}}</span>
                        </div>

                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">Informasi Penjualan.</span>
                            <span>Invoice No : @if($penjualan->penjualan_channel == "Toko Offline") {{$penjualan->penjualan_invoicegorilla}} @else {{$penjualan->penjualan_invoice}} @endif</span>
                            <span>Channel : {{$penjualan->penjualan_channel}}</span>
                                <span>Nama Customer : {{$penjualan->penjualan_customername}}</span>
                                <span>Kasir : {{$penjualan->name}}</span>
                                @if($penjualan->penjualan_kurir != "None")
                                <span>Ongkos Kirim : @money($penjualan->penjualan_ongkoskirim)</span>
                                @endif
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
                                    <th class="pl-0 font-weight-bold text-muted text-uppercase">NAMA BARANG</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">HARGA SATUAN</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Diskon</th>
                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">TOTAL</th>
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
                                    {{$b->product_sku}} - {{$b->product_nama}} ({{$b->size_nama}})</td>
                                    <td class="text-right pt-7 align-middle">{{$b->barangterjual_qty}}</td>
                                    <td class="text-right pt-7 align-middle">@money($b->product_hargajual)</td>
                                    <td class="text-right pt-7 align-middle">@money($b->barangterjual_diskon)</td>
                                    <td class="text-primary pr-0 pt-7 text-right align-middle">
                                        @if((int)$b->barangterjual_diskon == 0 || is_null($b->barangterjual_diskon))
                                        @money($b->barangterjual_totalbarangterjual)
                                        @else
                                         @money((int)$b->barangterjual_totalbarangterjual-(int)$b->barangterjual_diskon)
                                    @endif</td>
                                </tr>
                                @endforeach


                                <tr class="font-weight-boldest">
                                    <td colspan="5" class="text-primary font-size-h3 font-weight-boldest text-right">
                                        @money((int)$penjualan->penjualan_totalpenjualan - (int)$penjualan->penjualan_diskon)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($daftarpotongan)
            <div class="row justify-content-center bg-gray-50 py-8 px-8 py-md-10 px-md-0 mx-0">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-muted text-uppercase">POTONGAN</th>
                                    <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL POTONGAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($daftarpotongan as $p)
                                <tr class="font-weight-bolder">
                                    <td>{{$p->riwayatpotongan_namapotongan}}</td>
                                    <td class="text-primary pr-0 pt-7 text-right align-middle">@money($p->riwayatpotongan_jumlahpotongan)</td>
                                </tr>
                                @endforeach
                                <tr class="font-weight-bolder">
                                    <td colspan="2" class="text-primary font-size-h3 font-weight-boldest text-right">@money($penjualan->penjualan_totalpotongan?$penjualan->penjualan_totalpotongan:0)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($penjualan->penjualan_kurir != "None")
            <div class="row justify-content-center bg-gray-50 py-8 px-8 py-md-10 px-md-0 mx-0">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-muted text-uppercase">PENGIRIMAN</th>
                                    <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL ONGKOS KIRIM</th>
                                </tr>
                            </thead>
                            <tb
                                <tr class="font-weight-bolder">
                                    <td>{{$penjualan->penjualan_kurir}}
                                    <br>  Resi :  {{$penjualan->penjualan_resi}}</td>
                                    <td class="text-primary pr-0 pt-7 text-right align-middle">@money($penjualan->penjualan_ongkoskirim)</td>
                                </tr>
                                <tr class="font-weight-bolder">
                                    <td colspan="2" class="text-primary font-size-h3 font-weight-boldest text-right">@money($penjualan->penjualan_ongkoskirim)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 mx-0">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr class="font-weight-bolder">
                                    <td>Total Pendapatan</td>
                                    @php
                                        $total = ((int)$penjualan->penjualan_totalpenjualan - (int) $penjualan->penjualan_totalpotongan - (int) $penjualan->penjualan_diskon) + (int) $penjualan->penjualan_ongkoskirim;
                                    @endphp
                                    <td class="text-primary font-size-h3 font-weight-boldest text-right">@money($total)</td>
                                </tr>
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
                                    <td class="text-primary font-size-h3 font-weight-boldest text-right">@money($penjualan->penjualan_paymenttotal)</td>
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

                        <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();"><i class="fas fa-print"></i> Print Halaman Ini</button>
                        <a href="{{url('penjualan/struk/'.$penjualan->penjualan_id)}}" class="btn btn-primary font-weight-bold"><i class="fas fa-print"></i> Print Struk Pembelian</a>

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
