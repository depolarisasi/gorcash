@extends('layouts.app')
@section('title','Stok Opname Produk - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
	<!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
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
<span class="card-label font-weight-bolder text-dark">Stok Opname Mingguan</span>
</h3>
<div class="card-toolbar">
<a href="{{url('stokopname/mingguan')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

    <form method="POST" action="{{url('stokopname/mingguan/update')}}" >
        @csrf
    <div class="mb-7">
        <div class="row ">
            <div class="col-md-4">
                <div class="row mb-3">

                        <label class="col-md-4">Nama Pemeriksa</label>
                        <input id="namapemeriksa" type="text" class="form-control col-md-8" name="so_userid" value="{{$soinfo->so_userid}}" required>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4">Tanggal Periksa</label>
                    <input id="datepicker" type="text" class="form-control col-md-8" name="so_date" value="{{$soinfo->so_date}}" required>
            </div>
            </div>

            <div class="col-md-2">
                <p>Scan Barcode pada kotak disamping</p>
            </div>
            <div class="col-md-4">
                <select class="form-control select2" id="productlist" name="param">
                    <option value="X">Masukan SKU Disini</option>
                    @foreach($pubdata as $p)
                    <option value="{{$p->product_sku}}">{{$p->product_sku}} - {{$p->product_nama}} ({{$p->size_nama}})</option>
                    @endforeach
                   </select>
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
					<th width="10%">Nama Produk</th>
					<th width="5%">Size</th>
					<th width="5%">Stok Awal</th>
					<th width="5%">Sudah Terjual</th>
					<th width="5%">Sisa Stok Tersedia</th>
					<th width="5%">Stok Real</th>
					<th width="5%">Selisih</th>
					<th width="5%">Keterangan</th>
				</tr>
			</thead>
			<tbody>

                @foreach($pubdata as $p)
				<tr>
                    <input type="hidden" id="product_skus" name="product_skus[]" value="{{$p->product_sku}}">
                    <input type="hidden" id="publishgroup" name="publishgroup" value="{{$pub}}">
					<td>{{$p->product_sku}}</td>
					<td>{{$p->band_nama}}</td>
					<td>{{$p->product_nama}} ({{$p->size_nama}})</td>
					<td>{{$p->size_nama}}</td>


					<td id="stok{{$p->product_sku}}">{{$p->so_stok}}
                        <input type="hidden" id="stokakhir" name="stokakhir[]" value="{{$p->so_stokakhir}}">
                        <input type="hidden"  id="stok" name="stok[]" value="{{$p->so_stok}}"></td>
                        <td>{{$p->stokterjual}}
                            <input id="stokterjual" type="hidden" name="stokterjual[]" value="{{$p->stokterjual}}">
                        </td>

                        <td id="sisatersedia{{$p->product_sku}}">{{(int)$p->so_stok - (int)$p->stokterjual}}
                        <input id="sisainput" type="hidden" name="stoksisa[]" value="{{(int)$p->so_stok - (int)$p->stokterjual}}"></td>

					<td><input id="stokrilinput{{$p->product_sku}}" class="form-control stokrilinputs inputx" data-sku="{{$p->product_sku}}" value="{{$p->so_stokakhirreal}}" type="text" name="stokril[]"></td>
					<td><span id="selisih{{$p->product_sku}}">{{$p->so_selisih}}</span>
                    <input id="selisihinput{{$p->product_sku}}" class="inputx" value="{{$p->so_selisih}}" type="hidden" name="selisih[]"></td>

					<td>{{$p->so_keterangan}}</td>
				</tr>
                @endforeach

			</tbody>
		</table>
        <div class="row mt-10">
        <div class="col-md-4">
            <button type="submit" class="btn btn-md btn-primary">Submit</button>
            <button id="simpan" class="btn btn-md btn-warning">Simpan</button>
        </div>
    </div>
    </form>
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
    $("#productlist").val(null).trigger('change');
    $('#productlist').select2({
        placeholder: "Scan SKU disini",
        allowClear: true,
        closeOnSelect: false
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
                    'pubgroup' : "{{$pub}}"
                },
                success: function (data) {
                    if (data['success']) {
                        $("#stokrilinput"+select_val).val(parseInt($("#stokrilinput"+select_val).val())+1);
                        $("#selisih"+select_val).text(parseInt($("#sisatersedia"+select_val).text())-parseInt($("#stokrilinput"+select_val).val()));
                        $("#selisihinput"+select_val).val(parseInt($("#selisih"+select_val).text()));
                        console.log(select_val);
                        console.log($("#stokrilinput"+select_val).val());
                        console.log($("#selisihinput"+select_val).val());
                        $("#productlist").val(null).trigger('change');
                        $('.select2-search__field').val(null).trigger('change');
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
$('.stokrilinputs').on('change', function (e) {
    select_val = $(this).attr('data-sku');
    $("#stokrilinput"+select_val).val(parseInt($(this).val()));
    $("#selisih"+select_val).text(parseInt($("#sisatersedia"+select_val).text())-parseInt($("#stokrilinput"+select_val).val()));
    $("#selisihinput"+select_val).val(parseInt($("#selisih"+select_val).text()));
});


$('#simpan').on('click', function (e) {
    e.preventDefault();
    $.ajax({
                url: '/api/simpanso',
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'so_userid' :   $('input[name="so_userid"]').val(),
                    'so_date' :   $('input[name="so_date"]').val(),
                    'product_skus[]' :   $('input[name="product_skus[]"]').map(function(){  return this.value; }).get(),
                    'publishgroup' :   $('input[name="publishgroup"]').val(),
                    'stok[]' :   $('input[name="stok[]"]').map(function(){  return this.value; }).get(),
                    'stokakhir[]' :   $('input[name="stokakhir[]"]').map(function(){  return this.value; }).get(),
                    'stokterjual[]' :   $('input[name="stokterjual[]"]').map(function(){  return this.value; }).get(),
                    'stoksisa[]' :   $('input[name="stoksisa[]"]').map(function(){  return this.value; }).get(),
                    'stokril[]' :   $('input[name="stokril[]"]').map(function(){  return this.value; }).get(),
                    'selisih[]' :   $('input[name="selisih[]"]').map(function(){  return this.value; }).get(),
                },
                success: function (data) {
                    if (data['success']) {
                        Swal.fire(
                         'Success',
                         'Laporan SO Berhasil Disimpan',
                         'success'
                         )

                    } else if (data['error']) {
                         Swal.fire(
                         'Error',
                         'SKU tersebut tidak ada dalam daftar publish ini',
                         'error'
                         )
                    } else {
                        console.log(data);
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
});


 tabel = $('#product').DataTable({
        search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
        "paging":   false,
        "ordering": false,
    } );


    $('#datepicker').datepicker({
   todayHighlight: true,
   orientation: "bottom left",
   format: "yyyy-mm-dd"
  });
</script>
@endsection
@endsection
