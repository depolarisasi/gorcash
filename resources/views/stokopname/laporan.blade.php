@extends('layouts.app')
@section('title','Laporan Stok Opname Produk - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
	<!--begin::Content-->
    <div class="content" id="kt_content">

<!--begin::Entry-->
<div class="d-flex ">
<!--begin::Container-->
<div class="container">
<!--begin::Dashboard-->

<!--begin::Row-->
<div class="row">
<div class="col-lg-12">
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Laporan Stok Opname @if($info->so_type == 1) Mingguan @elseif($info->so_type == 2) Bulanan @endif {{$info->so_pubgroupname}}</span>
</h3>
<div class="card-toolbar">
    @php
        if($info->so_type == 1){
            $url = "mingguan";
        }elseif($info->so_type == 2) {
            $url = "bulanan";
        }
    @endphp
<a href="{{url('stokopname/'.$url.'/' )}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

<div class="mb-7">
	<div class="row ">
        <div class="col-md-4">
			<div class="h2 mb-1">Laporan Stock Opname {{$info->so_namaso}}</div>
            <p>Pemeriksa : <b>{{$info->so_userid}}</b></p>
            <p>Tanggal Periksa : {{\Carbon\Carbon::parse($info->so_date)->format('d M Y')}}</p>
		</div>

	</div>
</div>

		<!--begin: Datatable-->
        <div class="table-responsive">
		<table class="table table-bordered mt-5" id="product">
			<thead>
				<tr>
					<th width="10%">SKU</th>
					<th width="10%">Band</th>
					<th width="15%">Nama Produk</th>
					<th width="5%">Harga</th>
					<th width="5%">Size</th>
					<th width="5%">Stok Awal</th>
					<th width="5%">Stok Terjual</th>
					<th width="5%">Sisa Akhir</th>
					<th width="5%">Stok Gudang</th>
					<th width="5%">Stok Toko</th>
					<th width="5%">Stok Ril SO</th>
					<th width="5%">Selisih</th>
					<th width="10%">Keterangan</th>
				</tr>
			</thead>
			<tbody>

                @foreach($product as $p)
				<tr>
					<td>{{$p->product_sku}}</td>
					<td>{{$p->band_nama}}</td>
					<td>{{$p->product_nama}}</td>
					<td>Rp @money($p->product_hargajual)</td>
					<td>{{$p->size_nama}}</td>
					<td>{{$p->so_stok}} </td>
                    <td>{{$p->so_stokterjual}}</td>
                    <td>{{(int)$p->so_stok - (int)$p->so_stokterjual}}</td>
         <td>{{$p->so_stokgudang}}</td>         
					<td>{{$p->so_stoktoko}}</td>
					<td>{{$p->so_stokakhirreal}}</td>
					<td>{{$p->so_selisih}}</td>
					<td>{{$p->so_keterangan}}</td>
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


<script>
    $('.inputx').val(0);
    $('#productlist').val("");
    $('#productlist').select2({
        placeholder: "Scan SKU disini",
        allowClear: true
    });
  $('#productlist').on('select2:select', function (e) {
    e.preventDefault();
    var select_val = $(e.currentTarget).val();
    $.ajax({
                url: '/api/getso',
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'sku' : select_val,
                    'pubgroup' : "{{$info->so_pubgroupname}}"
                },
                success: function (data) {
                    if (data['success']) {
                        $("#stokril"+select_val).text(parseInt($("#stokril"+select_val).text())+1);
                        $("#selisih"+select_val).text(parseInt($("#sisatersedia"+select_val).text())-parseInt($("#stokril"+select_val).text()));

                        $("#stokrilinput"+select_val).val(parseInt($("#stokril"+select_val).text()));
                        $("#selisihinput"+select_val).val(parseInt($("#selisih"+select_val).text()));
                        console.log(select_val);
                        console.log($("#stokrilinput"+select_val).val());
                        console.log($("#selisihinput"+select_val).val());

                    } else if (data['error']) {
                         Swal.fire(
                         'Error',
                         'SKU tersebut tidak ada dalam daftar publish ini',
                         'error'
                         )
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
});

 tabel = $('#product').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            exportOptions: {
            columns: [ 0,1,2,3,4,5,6,7,8,9,10,11]
            }
            },
            {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'A4',
            exportOptions: {
            columns: [ 0,1,2,3,4,5,6,7,8,9,10,11 ]
            }
            },
        ],
        search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
        "paging":   false,
        "ordering": false,
    } );
</script>
@endsection
@endsection
