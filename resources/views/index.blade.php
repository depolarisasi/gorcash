@extends('layouts.app')
@section('content')
	<!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
<div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
<div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
<!--begin::Info-->
<div class="d-flex align-items-center flex-wrap mr-2">

<!--begin::Page Title-->
<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
Dashboard Gorilla Coach </h5>
<!--end::Page Title-->



<!--end::Actions-->
</div>
<!--end::Info-->


</div>
</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class=" container ">
<!--begin::Dashboard-->
<!--begin::Row-->

@if(Auth::user()->role == 1 )
<div class="row">
    <div class="col-md-6">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body">
                <div class="text-dark font-weight-bolder font-size-h2 mt-3">@money($totalweekly)</div>

                <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Pendapatan Minggu Ini</a>
            </div>
            <!--begin::Header-->

        </div>
            </div>
            <div class="col-md-6">
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-body">
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">@money($totalmonthly)</div>

                        <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Pendapatan Bulan Ini</a>
                    </div>
                </div>
                    </div>
                       <div class="col-md-12">
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-6 mb-2">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Pendapatan Bulanan</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        <!--begin::Table-->
                        <div id="monthpenchart" style="height: 350px"></div>
                        <!--end::Table-->
                    </div>
                    <!--end::Body-->
                </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-6 mb-2">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Barang Terjual Bulanan</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-2">
                                <!--begin::Table-->
                                <div id="monthproductchart" style="height: 350px"></div>
                                <!--end::Table-->
                            </div>
                            <!--end::Body-->
                        </div>
                            </div>
    </div>
    @else
    <div class="col-md-12 p-0">
        <!--begin::Stats Widget 12-->
        <div class="card card-custom card-stretch gutter-b">

            <div class="card-header border-0 pt-6 mb-2">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">WORKFLOW GORILLA COACH</span>
                </h3>
            </div>
        <!--begin::Body-->
        <div class="card-body pt-2">
            {!! $pengumuman->note_isi !!}
        </div>
        <!--end::Body-->
        </div>
        <!--end::Stats Widget 12-->
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-6 mb-2">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Penjualan Terakhir</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <!--begin::Item-->
                            @foreach($recentsales as $rs)
                            <tr>
                                <!--begin::Icon-->
                                <td class="align-middle w-50px pl-0 pr-2 pb-6">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-50 symbol-light-success">
                                        <a href="{{asset($rs->product_foto?$rs->product_foto:"/assets/nopicture.png")}}" data-type="image" data-fslightbox="galleryproduk">
                                            <img src="{{asset($rs->product_foto?$rs->product_foto:"/assets/nopicture.png")}}" data-type="image" class="img-fluid" style="width: 50px !important; height: 50px !important;"></a>
                                    </div>
                                    <!--end::Symbol-->
                                </td>
                                <!--end::Icon-->
                                <!--begin::Content-->
                                <td class="align-middle pb-6">
                                    <div class="font-size-lg font-weight-bolder text-dark-75 mb-1">{{$rs->product_nama}}</div>
                                    <div class="font-weight-bold text-muted">{{$rs->band_nama}}</div>
                                </td>
                                <td class="font-weight-bold text-muted text-right">
                                    <span class="text-success font-size-h5 font-weight-bolder ml-1">{{$rs->barangterjual_qty}}</span>
                                </td>
                                <td class="text-right align-middle pb-6">
                                    <div class="font-weight-bold text-muted mb-1">Pendapatan (- Diskon)</div>
                                    <div class="font-size-lg font-weight-bolder text-dark-75">@money($rs->barangterjual_totalbarangterjual) (-@money($rs->barangterjual_diskon))</div>
                                </td>
                                <!--end::Content-->
                            </tr>
                            @endforeach
                            <!--end::Item-->
                            <!--begin::Item-->
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
            </div>
            <div class="col-md-6">


    <!--begin::Mixed Widget 14-->
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
        <h3 class="card-title font-weight-bolder text-dark">Agenda Promo</h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2">
        <!--begin::Item-->
        <!--begin::Item-->
        @foreach($agenda as $ag)
        <div class="d-flex align-items-center mt-3">
        <!--begin::Bullet-->
        <span class="bullet bullet-bar bg-danger align-self-stretch"></span>
        <!--end::Bullet-->
        <!--begin::Text-->
        <div class="d-flex flex-column flex-grow-1 mx-4">
        <a href="{{url('agenda/detail/'.$ag->agenda_id)}}" class="text-dark-75 text-hover-primary font-weight-boldest font-size-lg mb-1">{{$ag->agenda_judul}}</a>
        <span class="font-weight-boldest">{{\Carbon\Carbon::parse($ag->agenda_startdate)->format('d-m-Y')}} - {{\Carbon\Carbon::parse($ag->agenda_enddate)->format('d-m-Y')}}</span>
        </div>
        <!--end::Text-->
        </div>
        @endforeach

        </div>
        <!--end::Body-->
        </div>
        @if(Auth::user()->role == 1)
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
            <h3 class="card-title font-weight-bolder">Note</h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body pt-2">
                @foreach($note as $n)
                <div class="d-flex align-items-center mt-3">
                <!--begin::Bullet-->
                <span class="bullet bullet-bar bg-danger align-self-stretch"></span>
                <!--end::Bullet-->
                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1 mx-4">
                <a href="{{url('note/detail/'.$n->note_id)}}" class="text-dark-75 text-hover-primary font-weight-boldest font-size-lg mb-1">{{$n->note_judul}}</a>
                <span class="font-weight-boldest">{{\Carbon\Carbon::parse($n->note_date)->format('d-m-Y')}}</span>
                </div>
                <!--end::Text-->
                </div>
                @endforeach
            </div>
            <!--end::Body-->
            </div>
            @endif
            <!--end::Mixed Widget 14-->
            </div>
        </div>
        <!--end::Row-->
<!--begin::Row-->
<div class="row">
<div class="col-lg-12">
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Produk Habis</span>
</h3>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<!--begin::Table-->
<div class="table-responsive">
<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
<thead>
<tr class="text-left text-uppercase">
<th class="pl-7"><span class="text-dark-75">Nama Produk</span></th>
<th><span class="text-dark-75">Sisa Stok</span></th>
</tr>
</thead>
<tbody>
@foreach($produkstokrendah as $ps)
<tr>
<td class="pl-0 py-1">
<div class="d-flex align-items-center">
<div>
    <a href="{{url('produk/detail/'.$ps->product_id)}}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$ps->product_nama}}</a>
    <span class="text-muted font-weight-bold d-block">Size {{$ps->size_nama}} - {{$ps->band_nama}}</span>
</div>
</div>
</td>
<td>
<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
{{$ps->product_stok}}
</span>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
<!--end::Table-->
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

<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{asset('js/fslightbox.js')}}"></script>
<script>

// Shared Colors Definition
const primary = '#6993FF';
const success = '#1BC5BD';
const info = '#8950FC';
const warning = '#FFA800';
const danger = '#F64E60';

        var monthelement = document.getElementById("monthpenchart");

        var monthheight = parseInt(KTUtil.css(monthelement, 'height'));
        var monthcolor = KTUtil.hasAttr(monthelement, 'data-color') ? KTUtil.attr(monthelement, 'data-color') : 'primary';

        var monthoptions = {
          series: [{
          name: 'Pendapatan Bulanan',
          data: {!! $salesmonthly !!}
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: {!! $monthlydate !!},
        },
        yaxis: {
          title: {
            text: 'Pendapatan Bulanan'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "Rp " + val
            }
          }
        }
        };

        var chart3 = new ApexCharts(monthelement, monthoptions);
        chart3.render();



        var productmonthelement = document.getElementById("monthproductchart");

        var productmonthheight = parseInt(KTUtil.css(element, 'height'));
        var productmonthcolor = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'warning';

        var productmonthoptions = {
          series: [{
          name: 'Penjualan Produk Bulanan',
          data: {!! $productmonthly !!}
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: {!! $monthlydate !!},
        },
        yaxis: {
          title: {
            text: 'Penjualan Produk Bulanan'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " Pcs"
            }
          }
        }
        };

        var chart5 = new ApexCharts(productmonthelement, productmonthoptions);
        chart5.render();

</script>

@endsection
@endsection
