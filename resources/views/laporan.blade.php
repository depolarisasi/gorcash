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
Penjualan </h5>
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
<div class="row">
<div class="col-md-4">
<!--begin::Stats Widget 11-->
<div class="card card-custom gutter-b">
<!--begin::Body-->
<div class="card-body p-0">
<div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
<span class="symbol  symbol-50 symbol-light-success mr-2">
<span class="symbol-label">
    <span class="svg-icon svg-icon-success svg-icon-xl"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo5/dist/../src/media/svg/icons/Shopping/Chart-bar2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5"/>
            <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
            <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
            <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5"/>
        </g>
    </svg><!--end::Svg Icon--></span>               </span>
</span>
<div class="d-flex flex-column text-right">
<span class="text-dark-75 font-weight-bolder font-size-h3">@money($totaltoday)</span>
<span class="text-muted font-weight-bold mt-2">Pendapatan Hari Ini</span>
</div>
</div>
</div>
<!--end::Body-->
</div>
<!--end::Stats Widget 11-->
</div>
<div class="col-md-4">

<!--begin::Stats Widget 12-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Body-->
<div class="card-body p-0">
<div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
<span class="symbol  symbol-50 symbol-light-primary mr-2">
<span class="symbol-label">
    <span class="svg-icon svg-icon-primary svg-icon-xl"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo5/dist/../src/media/svg/icons/Shopping/Chart-bar2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5"/>
            <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
            <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
            <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5"/>
        </g>
    </svg><!--end::Svg Icon--></span>              </span>
</span>
<div class="d-flex flex-column text-right">
<span class="text-dark-75 font-weight-bolder font-size-h3">@money($totalweekly)</span>
<span class="text-muted font-weight-bold mt-2">Pendapatan Minggu Ini Ini</span>
</div>
</div>
<div id="weekpenchart" class="card-rounded-bottom" data-color="primary" style="height: 150px"></div>
</div>
<!--end::Body-->
</div>
<!--end::Stats Widget 12-->
</div>
<div class="col-md-4">
    <!--begin::Stats Widget 12-->
    <div class="card card-custom card-stretch gutter-b">
    <!--begin::Body-->
    <div class="card-body p-0">
    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
    <span class="symbol  symbol-50 symbol-light-primary mr-2">
    <span class="symbol-label">
        <span class="svg-icon svg-icon-primary svg-icon-xl"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo5/dist/../src/media/svg/icons/Shopping/Chart-bar2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5"/>
                <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
                <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5"/>
            </g>
        </svg><!--end::Svg Icon--></span>              </span>
    </span>
    <div class="d-flex flex-column text-right">
    <span class="text-dark-75 font-weight-bolder font-size-h3">@money($totalmonthly)</span>
    <span class="text-muted font-weight-bold mt-2">Pendapatan Bulan Ini</span>
    </div>
    </div>
    <div id="monthpenchart" class="card-rounded-bottom" data-color="warning" style="height: 150px"></div>
    </div>
    <!--end::Body-->
    </div>
    <!--end::Stats Widget 12-->
    </div>
    <div class="col-md-4">
        <!--begin::Stats Widget 11-->
        <div class="card card-custom gutter-b">
        <!--begin::Body-->
        <div class="card-body p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
        <span class="symbol  symbol-50 symbol-light-success mr-2">
        <span class="symbol-label">
            <span class="svg-icon svg-icon-success svg-icon-xl"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo5/dist/../src/media/svg/icons/Shopping/Chart-bar2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5"/>
                    <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
                    <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5"/>
                </g>
            </svg><!--end::Svg Icon--></span>               </span>
        </span>
        <div class="d-flex flex-column text-right">
        <span class="text-dark-75 font-weight-bolder font-size-h3">{{$producttoday}}</span>
        <span class="text-muted font-weight-bold mt-2">Barang Terjual Hari Ini</span>
        </div>
        </div>
        </div>
        <!--end::Body-->
        </div>
        <!--end::Stats Widget 11-->
        </div>
        <div class="col-md-4">

        <!--begin::Stats Widget 12-->
        <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
        <span class="symbol  symbol-50 symbol-light-primary mr-2">
        <span class="symbol-label">
            <span class="svg-icon svg-icon-primary svg-icon-xl"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo5/dist/../src/media/svg/icons/Shopping/Chart-bar2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5"/>
                    <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
                    <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5"/>
                </g>
            </svg><!--end::Svg Icon--></span>              </span>
        </span>
        <div class="d-flex flex-column text-right">
        <span class="text-dark-75 font-weight-bolder font-size-h3">{{$productweek}}</span>
        <span class="text-muted font-weight-bold mt-2">Barang Terjual Minggu Ini</span>
        </div>
        </div>
        <div id="weekproductchart" class="card-rounded-bottom" data-color="primary" style="height: 150px"></div>
        </div>
        <!--end::Body-->
        </div>
        <!--end::Stats Widget 12-->
        </div>
        <div class="col-md-4">
            <!--begin::Stats Widget 12-->
            <div class="card card-custom card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body p-0">
            <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
            <span class="symbol  symbol-50 symbol-light-primary mr-2">
            <span class="symbol-label">
                <span class="svg-icon svg-icon-primary svg-icon-xl"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo5/dist/../src/media/svg/icons/Shopping/Chart-bar2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5"/>
                        <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
                        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                        <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5"/>
                    </g>
                </svg><!--end::Svg Icon--></span>              </span>
            </span>
            <div class="d-flex flex-column text-right">
            <span class="text-dark-75 font-weight-bolder font-size-h3">{{$productmonth}}</span>
            <span class="text-muted font-weight-bold mt-2">Barang Terjual Bulan Ini</span>
            </div>
            </div>
            <div id="monthproductchart" class="card-rounded-bottom" data-color="warning" style="height: 150px"></div>
            </div>
            <!--end::Body-->
            </div>
            <!--end::Stats Widget 12-->
            </div>
</div>
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
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-6 mb-2">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">Proporsi Penjualan & Pengeluaran Bulan Ini</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
            <!--begin::Chart-->
            <div id="chartdonut" class="d-flex justify-content-center"></div>
            <!--end::Chart-->
            </div>
            <!--end::Body-->
        </div>
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
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
<script src="{{asset('assets/js/pages/features/charts/apexcharts.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{asset('js/fslightbox.js')}}"></script>
<script>
        var element = document.getElementById("weekpenchart");

        var height = parseInt(KTUtil.css(element, 'height'));
        var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'success';

        var options = {
            series: [{
                name: 'Pendapatan Weekly',
                data: {!! $salesweekly !!}
            }],
            chart: {
                type: 'area',
                height: 150,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [KTAppSettings['colors']['theme']['base'][color]]
            },
            xaxis: {
                categories: {!! $weeklydate !!},
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: KTAppSettings['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: KTAppSettings['colors']['gray']['gray-300'],
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                }
            },
            yaxis: {
                min: 0,
                labels: {
                    show: false,
                    style: {
                        colors: KTAppSettings['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                },
                y: {
                    formatter: function (val) {
                        return "Rp" + val;
                    }
                }
            },
            colors: [KTAppSettings['colors']['theme']['light'][color]],
            markers: {
                colors: [KTAppSettings['colors']['theme']['light'][color]],
                strokeColor: [KTAppSettings['colors']['theme']['base'][color]],
                strokeWidth: 3
            }
        };

        var chart2 = new ApexCharts(element, options);
        chart2.render();


        var monthelement = document.getElementById("monthpenchart");

        var monthheight = parseInt(KTUtil.css(element, 'height'));
        var monthcolor = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'primary';

        var monthoptions = {
            series: [{
                name: 'Pendapatan Monthly',
                data: {!! $salesmonthly !!}
            }],
            chart: {
                type: 'area',
                height: 150,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [KTAppSettings['colors']['theme']['base']['primary']]
            },
            xaxis: {
                categories: {!! $monthlydate !!},
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: KTAppSettings['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: KTAppSettings['colors']['gray']['gray-300'],
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                }
            },
            yaxis: {
                min: 0,
                labels: {
                    show: false,
                    style: {
                        colors: KTAppSettings['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                },
                y: {
                    formatter: function (val) {
                        return "Rp" + val;
                    }
                }
            },
            colors: [KTAppSettings['colors']['theme']['light']['primary']],
            markers: {
                colors: [KTAppSettings['colors']['theme']['light']['primary']],
                strokeColor: [KTAppSettings['colors']['theme']['base']['primary']],
                strokeWidth: 3
            }
        };

        var chart3 = new ApexCharts(monthelement, monthoptions);
        chart3.render();

        var productelement = document.getElementById("weekproductchart");

        var productheight = parseInt(KTUtil.css(element, 'height'));
        var productcolor = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'warning';

        var productoptions = {
            series: [{
                name: 'Product Weekly Sales',
                data: {!! $productweek !!}
            }],
            chart: {
                type: 'area',
                height: 150,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [KTAppSettings['colors']['theme']['base']['primary']]
            },
            xaxis: {
                categories: {!! $weeklydate !!},
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: KTAppSettings['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: KTAppSettings['colors']['gray']['gray-300'],
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                }
            },
            yaxis: {
                min: 0,
                labels: {
                    show: false,
                    style: {
                        colors: KTAppSettings['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                },
                y: {
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            colors: [KTAppSettings['colors']['theme']['light']['primary']],
            markers: {
                colors: [KTAppSettings['colors']['theme']['light']['primary']],
                strokeColor: [KTAppSettings['colors']['theme']['base']['primary']],
                strokeWidth: 3
            }
        };

        var chart3 = new ApexCharts(productelement, productoptions);
        chart3.render();


        const chartdonut = "#chartdonut";
		var options4 = {
			series: {!! $dataproporsi !!},
			chart: {
				width: 480,
				type: 'pie',
			},
			labels: ['Penjualan', 'Potongan / Diskon Total', 'Diskon Individu'],
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 240
					},
					legend: {
						position: 'bottom'
					}
				}
			}],
			colors: [success, warning, danger,]
		};

		var chart4 = new ApexCharts(document.querySelector(chartdonut), options4);
		chart4.render();


        var productmonthelement = document.getElementById("monthproductchart");

        var productmonthheight = parseInt(KTUtil.css(element, 'height'));
        var productmonthcolor = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'warning';

        var productmonthoptions = {
            series: [{
                name: 'Product Monthly Sales',
                data: {!! $productmonth !!}
            }],
            chart: {
                type: 'area',
                height: 150,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [KTAppSettings['colors']['theme']['base']['primary']]
            },
            xaxis: {
                categories: {!! $monthlydate !!},
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: KTAppSettings['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: KTAppSettings['colors']['gray']['gray-300'],
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                }
            },
            yaxis: {
                min: 0,
                labels: {
                    show: false,
                    style: {
                        colors: KTAppSettings['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTAppSettings['font-family']
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                },
                y: {
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            colors: [KTAppSettings['colors']['theme']['light']['primary']],
            markers: {
                colors: [KTAppSettings['colors']['theme']['light']['primary']],
                strokeColor: [KTAppSettings['colors']['theme']['base']['primary']],
                strokeWidth: 3
            }
        };

        var chart5 = new ApexCharts(productelement, productoptions);
        chart5.render();


</script>
@endsection
@endsection
