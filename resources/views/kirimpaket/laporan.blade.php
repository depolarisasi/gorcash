@extends('layouts.app')
@section('title','Laporan Kirim Paket - ')
@section('css')
<link rel="stylesheet" type="text/css" id="mce-u0" href="{{asset('assets/js/tinymce/skins/ui/oxide/skin.min.css')}}">
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
<span class="card-label font-weight-bolder text-dark">Laporan Kirim Paket Bulan </span>
</h3>
<div class="card-toolbar">
<a href="{{url('kirimpaket/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="mb-7">
	<div class="row align-items-center">
		<div class="col-lg-8 col-xl-8">
            <form method="get" action="{{url('kirimpaket/laporan')}}">
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
<th style="min-width: 50px"><span class="text-dark-75">Petugas</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Jumlah Paket</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Jumlah Komisi</span></th>
</tr>
</thead>
<tbody>
    @foreach($data as $d)
<tr>
<td>
<div class="d-flex align-items-center">
{{$d->name}}
</div>
</td>
<td>
<div class="d-flex align-items-center">
{{$d->totalpengiriman}}
</div>
</td>
<td>
    <div class="d-flex align-items-center">
    Rp. @money($d->totalpengiriman*8000)
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
<script>
    $('#datepicker1').datepicker({
        format: "yyyy-mm-dd",
    });

    $('#productlist').select2({
        placeholder: "Scan SKU disini",
        allowClear: true
    });

    $( document ).ready(function() {

$('#productlist').val("");
});
    </script>
@endsection
@endsection
