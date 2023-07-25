@extends('layouts.app')
@section('title','Laporan Ongkir - ')
@section('css')
<link rel="stylesheet" type="text/css" id="mce-u0" href="{{asset('assets/js/tinymce/skins/ui/oxide/skin.min.css')}}">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
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
<span class="card-label font-weight-bolder text-dark">Laporan Ongkir Bulan </span>
</h3>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="mb-7">
	<div class="row align-items-center">
		<div class="col-lg-8 col-xl-8">
            <form method="get" action="{{url('ongkir')}}">
			<div class="row align-items-center">
                <div class="col-md-4 my-2 my-md-0">
					<div class="d-flex align-items-center">
						<label class="mr-3 mb-0 d-none d-md-block">Bulan:</label>
						<select class="form-control" name="bulan" id="bulan">
							<option value="All" @if(Request::get('bulan') == "All") selected="selected" @endif>All</option>
                            <option value="1"  @if(Request::get('bulan') == "1") selected="selected" @endif>Januari</option>
                            <option value="2"  @if(Request::get('bulan') == "2") selected="selected" @endif>Februari</option>
                            <option value="3"  @if(Request::get('bulan') == "3") selected="selected" @endif>Maret</option>
                            <option value="4"  @if(Request::get('bulan') == "4") selected="selected" @endif>April</option>
                            <option value="5"  @if(Request::get('bulan') == "5") selected="selected" @endif>Mei</option>
                            <option value="6"  @if(Request::get('bulan') == "6") selected="selected" @endif>Juni</option>
                            <option value="7"  @if(Request::get('bulan') == "7") selected="selected" @endif>Juli</option>
                            <option value="8"  @if(Request::get('bulan') == "8") selected="selected" @endif>Agustus</option>
                            <option value="9"  @if(Request::get('bulan') == "9") selected="selected" @endif>Desember</option>
                            <option value="10"  @if(Request::get('bulan') == "10") selected="selected" @endif>Oktober</option>
                            <option value="11"  @if(Request::get('bulan') == "11") selected="selected" @endif>November</option>
                            <option value="12"  @if(Request::get('bulan') == "12") selected="selected" @endif>Desember</option>

						</select>
					</div>
				</div>
                <div class="col-md-4 my-2 my-md-0">
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
<div class="tab-content">

<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered mt-5" style="width:100%">
<thead>
<tr class="text-left">
<th style="min-width: 50px"><span class="text-dark-75">Tanggal</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Channel</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Nama</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Invoice</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Total</span></th>
<th style="min-width: 50px"><span class="text-dark-75">No Resi</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Expedisi</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Keterangan</span></th>
</tr>
</thead>
<tbody>
    @foreach($ongkir as $t)
<tr>
<td>
<div class="d-flex align-items-center">
{{\Carbon\Carbon::parse($t->penjualan_tanggalwaktupenjualan)->format('d-m-Y')}}
</div>
</td>
<td>
<div class="d-flex align-items-center">
{{$t->penjualan_channel}}
</div>
</td>

<td>
    <div class="d-flex align-items-center">
    {{$t->penjualan_customername}}
    </div>
    </td>
<td>
    <div class="d-flex align-items-center">
    @if(!is_null($t->penjualan_invoice) && !is_null($t->penjualan_invoicegorilla))
    {{$t->penjualan_invoice}} / {{$t->penjualan_invoicegorilla}}
    @else
    {{$t->penjualan_invoicegorilla}}
    @endif
    </div>
    </td>

<td>
    <div class="d-flex align-items-center">
    {{$t->penjualan_ongkoskirim}}
    </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
        {{$t->penjualan_resi}}
        </div>
        </td>

    <td>
        <div class="d-flex align-items-center">
        {{$t->penjualan_kurir}}
        </div>
        </td>

    <td>
        <div class="d-flex align-items-center">
        {{$t->penjualan_notes}}
        </div>
        </td>
</tr>
@endforeach
</tbody>
</table>
</div>
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
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script>
    $('#datepicker1').datepicker({
        format: "yyyy-mm-dd",
    });

    var table = $("#table").DataTable({
                dom: 'Blfrtip',
        search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
        "paging":   true,
        "ordering": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
});
    </script>
@endsection
@endsection
