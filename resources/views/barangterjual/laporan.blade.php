@extends('layouts.app')
@section('title','Penjualan Produk - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
	<!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class="container-fluid">
<!--begin::Dashboard-->

<!--begin::Row-->
<div class="row">
<div class="col-lg-12">
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Laporan Trending Produk</span>
</h3>
<div class="card-toolbar">
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-8 col-xl-8">
                <form method="get" action="{{url('barangterjual/laporan')}}">
                <div class="row align-items-center">
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Bulan:</label>
                            <select class="form-control" name="bulan" id="bulan">
                                <option value="All"  @if($selected_month == "All") selected="selected" @endif>ALL</option>
                                <option value="1"  @if($selected_month == "1" || \Carbon\Carbon::now()->format('m') == "1") selected="selected" @endif>Januari</option>
                                <option value="2"  @if($selected_month == "2" || \Carbon\Carbon::now()->format('m') == "2") selected="selected" @endif>Februari</option>
                                <option value="3"  @if($selected_month == "3" || \Carbon\Carbon::now()->format('m') == "3") selected="selected" @endif>Maret</option>
                                <option value="4"  @if($selected_month == "4" || \Carbon\Carbon::now()->format('m') == "4") selected="selected" @endif>April</option>
                                <option value="5"  @if($selected_month == "5" || \Carbon\Carbon::now()->format('m') == "5") selected="selected" @endif>Mei</option>
                                <option value="6"  @if($selected_month == "6" || \Carbon\Carbon::now()->format('m') == "6") selected="selected" @endif>Juni</option>
                                <option value="7"  @if($selected_month == "7" || \Carbon\Carbon::now()->format('m') == "7") selected="selected" @endif>Juli</option>
                                <option value="8"  @if($selected_month == "8" || \Carbon\Carbon::now()->format('m') == "8") selected="selected" @endif>Agustus</option>
                                <option value="9"  @if($selected_month == "9" || \Carbon\Carbon::now()->format('m') == "9") selected="selected" @endif>September</option>
                                <option value="10"  @if($selected_month == "10" || \Carbon\Carbon::now()->format('m') == "10") selected="selected" @endif>Oktober</option>
                                <option value="11"  @if($selected_month == "11" || \Carbon\Carbon::now()->format('m') == "11") selected="selected" @endif>November</option>
                                <option value="12"  @if($selected_month == "12" || \Carbon\Carbon::now()->format('m') == "12") selected="selected" @endif>Desember</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Tahun:</label>
                            <select class="form-control" name="tahun" id="tahun">
                                <option value="All" @if($selected_year == "All") selected="selected" @endif>ALL</option>
                                <option value="2022" @if($selected_year == "2022") selected="selected" @endif>2022</option>
                                <option value="2023" @if($selected_year == "2023") selected="selected" @endif>2023</option>
                                <option value="2024" @if($selected_year == "2024") selected="selected" @endif>2024</option>
                                <option value="2025" @if($selected_year == "2025") selected="selected" @endif>2025</option>
                                <option value="2026" @if($selected_year == "2026") selected="selected" @endif>2026</option>
                                <option value="2027" @if($selected_year == "2027") selected="selected" @endif>2027</option>
                                <option value="2028" @if($selected_year == "2028") selected="selected" @endif>2028</option>
                                <option value="2029" @if($selected_year == "2029") selected="selected" @endif>2029</option>
                                <option value="2030" @if($selected_year == "2030") selected="selected" @endif>2030</option>



                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 mt-5 mt-lg-0">
                        <button href="#" class="btn btn-light-primary px-6 font-weight-bold">
                            Filter
                        </button>
                    </div>
                                </div>
                            </form>
            </div>

        </div>
    </div>
		<!--begin: Datatable-->

<span class="card-label font-weight-bolder text-dark">Produk Populer Berdasarkan Penjualan</span>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="laporanproduk">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Nama Band</th>
                        <th>Size</th>
                        <th>Qty Terjual</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($laporanproduk as $lp)
                    <tr>
                        <td>{{$lp->product_nama}}</td>
                        <td>{{$lp->size_nama}}</td>
                       <td>{{$lp->band_nama}}</td>
                       <td>{{$lp->jumlahterjual}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

<span class="card-label font-weight-bolder text-dark">Band Populer Berdasarkan Penjualan</span>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="laporanband">
        <thead>
            <tr>
                <th>Nama Band</th>
                <th>Qty Terjual</th>
            </tr>
        </thead>
        <tbody>
 @foreach($laporanband as $lb)
 <tr>
    <td>{{$lb->band_nama}}</td>
    <td>{{$lb->jumlahterjual}}</td>
 </tr>
 @endforeach
        </tbody>
    </table>
        </div>

		<!--end: Datatable-->
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>


<script>
 tabel = $('#laporanproduk').DataTable({
    dom: 'Blfrtip',
        buttons: [
            'excelHtml5',
        ],
        "paging":   true,
        "ordering": false,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    } );

    tabel2 = $('#laporanband').DataTable({
    dom: 'Blfrtip',
        buttons: [
            'excelHtml5',
        ],
        "paging":   true,
        "ordering": false,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    } );


</script>
@endsection
@endsection
