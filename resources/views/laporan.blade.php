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
<div class="container-fluid ">
<!--begin::Dashboard-->
<!--begin::Row-->

@if(Auth::user()->role == 1 )
<div class="row">

            <div class="col-md-2">
                <form method="get" action="{{url('laporan')}}">
                <div class="d-flex align-items-center">
                    <label class="mr-3 mb-0 d-none d-md-block">Bulan:</label>
                    <select class="form-control" name="bulan" id="bulan">
            <option value="All" @if(Request::get('bulan') == "All")) selected="selected" @endif>All</option>
          <option value="January" @if(Request::get('bulan') == "January") selected="selected" @endif>January</option>
          <option value="February" @if(Request::get('bulan') == "February") selected="selected" @endif>February</option>
          <option value="March" @if(Request::get('bulan') == "March") selected="selected" @endif>March</option>
          <option value="April" @if(Request::get('bulan') == "April") selected="selected" @endif>April</option>
          <option value="May" @if(Request::get('bulan') == "May") selected="selected" @endif>May</option>
          <option value="June" @if(Request::get('bulan') == "June") selected="selected" @endif>June</option>
          <option value="July" @if(Request::get('bulan') == "July") selected="selected" @endif>July</option>
          <option value="August" @if(Request::get('bulan') == "August") selected="selected" @endif>August</option>
          <option value="September" @if(Request::get('bulan') == "September") selected="selected" @endif>September</option>
          <option value="October" @if(Request::get('bulan') == "October") selected="selected" @endif>October</option>
          <option value="November" @if(Request::get('bulan') == "November") selected="selected" @endif>November</option>
          <option value="December" @if(Request::get('bulan') == "December") selected="selected" @endif>December</option>

                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="d-flex align-items-center">
                    <label class="mr-3 mb-0 d-none d-md-block">Tahun:</label>
                    <select class="form-control" name="tahun" id="band">
                        <option value="All" @if(Request::get('tahun') == "All") selected="selected" @endif>All</option>
                        @foreach($tahun as $t)
                        <option value="{{$t->year}}" @if(Request::get('tahun') == $t->year) selected="selected" @endif>{{$t->year}}</option>
                        @endforeach


                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <button href="#" class="btn btn-light-primary px-6 font-weight-bold">
                    Filter
                </button>
            </div>
                    </form>

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

    @endif

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



        var monthoptions = {

            series: [{
          name: 'Pendapatan Bulanan',
          data: {!! $salesmonthly !!},
        }],
        colors:'#d14d72',
          chart: {
          height: 450,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            var	reverse = val.toString().split('').reverse().join(''),
	        ribuan 	= reverse.match(/\d{1,3}/g);
	        ribuan	= ribuan.join('.').split('').reverse().join('');
            return ribuan
          },
          offsetY: -20,
          style: {
            fontSize: '10px',
            colors: ["#000"]
          }
        },

        xaxis: {
          categories: {!! $monthlydate !!},
          position: 'bottom',
          axisBorder: {
            show: true
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
        },
        yaxis: {
          axisBorder: {
            show: true
          },
          axisTicks: {
            show: true,
          },


          labels: {
            show: true,
            formatter: function (val) {
                var	reverse = val.toString().split('').reverse().join(''),
	        ribuan 	= reverse.match(/\d{1,3}/g);
	        ribuan	= ribuan.join('.').split('').reverse().join('');
            return "Rp" + ribuan
            }
          }

        },
        tooltip: {
          y: {
            formatter: function (val) {
                var	reverse = val.toString().split('').reverse().join(''),
	        ribuan 	= reverse.match(/\d{1,3}/g);
	        ribuan	= ribuan.join('.').split('').reverse().join('');
            return "Rp" + ribuan
            }
          }
        },
    };


        var chart3 = new ApexCharts(monthelement, monthoptions);
        chart3.render();



        var productmonthelement = document.getElementById("monthproductchart");


        var productmonthoptions = {
          series: [{
          name: 'Penjualan Produk Bulanan',
          data: {!! $productmonthly !!}
        }],
        colors:'#d14d72',
          chart: {
          height: 450,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val +  " Pcs"
          },
          offsetY: -20,
          style: {
            fontSize: '10px',
            colors: ["#000"]
          }
        },
        xaxis: {
          categories: {!! $monthlydate !!},
          position: 'bottom',
          axisBorder: {
            show: true
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
        },
        yaxis: {
          axisBorder: {
            show: true
          },
          axisTicks: {
            show: true,
          },

          labels: {
            show: true,
            formatter: function (val) {
                return val +  " Pcs"
            }
          }

        },
        tooltip: {
          y: {
            formatter: function (val) {
            return val +  " Pcs"
            }
          }
        },
    };
        var chart5 = new ApexCharts(productmonthelement, productmonthoptions);
        chart5.render();

</script>

@endsection
@endsection
