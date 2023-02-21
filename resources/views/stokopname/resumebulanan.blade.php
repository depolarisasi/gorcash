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
<span class="card-label font-weight-bolder text-dark">Stok Opname</span>
</h3>
<div class="card-toolbar">
<a href="{{url('stokopname/bulanan')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

    <form method="POST" action="{{url('stokopname/bulanan/update')}}" >
        @csrf
        <input type="hidden" name="pubgroupname" value="{{$soinfo->so_pubgroupname}}">
        <div class="mb-7">
            <div class="row ">
                <div class="col-md-4">
                    <div class="row mb-3">
                        <label class="col-md-4">Nama StokOpname</label>
                        <input id="namaso" type="text" class="form-control col-md-8" name="so_namaso" value="{{$soinfo->so_namaso}}" required>
                </div>
                    <div class="row mb-3">
                            <label class="col-md-4">Nama Pemeriksa</label>
                            <input id="namapemeriksa" type="text" class="form-control col-md-8" name="so_userid" value="{{$soinfo->so_userid}}" required>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4">Tanggal Periksa</label>
                        <input id="datepicker" type="text" class="form-control col-md-8" name="so_date" value="{{$soinfo->so_date}}" required>
                </div>
                </div>


                <div class="col-md-8">
                <div class="row mb-3">
                <div class="col-md-6">



                </div>
                </div>


        </div>

            </div>
        </div>


		<!--begin: Datatable-->
        <div class="table-responsive">
		<table class="table table-bordered mt-5" id="product">
			<thead>
				<tr>
					<th width="5%">Foto</th>
					<th width="3%">SKU</th>
					<th width="3%">Band</th>
					<th width="5%">Nama Produk</th>
					<th width="3%">Harga</th>
					<th width="3%">Stok Awal</th>
					<th width="3%">Stok Terjual</th>
					<th width="3%">Stok Akhir</th>
					<th width="5%">Stok Gudang</th>
					<th width="5%">Stok Toko</th>
					<th width="5%">Stok Real</th>
					<th width="3%">Selisih</th>
                    @endif
					<th width="5%">Keterangan</th>
				</tr>
			</thead>
			<tbody>

                @foreach($pubdata as $p)
				<tr>
                    <input type="hidden" id="product_skus" name="product_skus[]" value="{{$p->product_sku}}">
                    <td><a href="{{asset($p->product_foto?$p->product_foto:"/assets/nopicture.png")}}" data-type="image" data-fslightbox="galleryproduk">
                        <img src="{{asset($p->product_foto?$p->product_foto:"/assets/nopicture.png")}}" data-type="image" class="img-fluid" style="width: 50px !important; height: 50px !important;"></a></td>
					<td>{{$p->product_sku}}</td>
					<td>{{$p->band_nama}}</td>
					<td>{{$p->product_nama}} ({{$p->size_nama}})</td>
					<td>Rp @money($p->product_hargajual)</td>



					<td id="stok{{$p->product_sku}}">{{$p->product_stok}}
                        <input type="hidden" id="stokakhir" name="stokakhir[]" value="{{$p->product_stokakhir}}">
                        <input type="hidden"  id="stok" name="stok[]" value="{{$p->product_stok}}"></td>
                        <td>{{$p->stokterjual}}
                            <input id="stokterjual" type="hidden" name="stokterjual[]" value="{{$p->stokterjual}}">
                        </td>

                        <td id="sisatersedia{{$p->product_sku}}">{{(int)$p->product_stokakhir}}
                            <input id="sisainput{{$p->product_sku}}" type="hidden" name="stoksisa[]" value="{{(int)$p->product_stokakhir}}"></td>

                        <td><input id="stokgudang{{$p->product_sku}}" class="form-control stokgudanginput inputx" data-sku="{{$p->product_sku}}" value="{{$p->so_stokgudang}}" type="number" name="stokgudang[]"></td>

                        <td><input id="stoktoko{{$p->product_sku}}" class="form-control stoktokoinput inputx" data-sku="{{$p->product_sku}}" value="{{$p->so_stoktoko}}" type="number" name="stoktoko[]"></td>

					<td>
                        <span id="stokril{{$p->product_sku}}">{{(int) $p->so_stoktoko + (int) $p->so_stokgudang}}</span>
                    <input id="stokrilinput{{$p->product_sku}}" class="inputx" value="{{(int) $p->so_stoktoko + (int) $p->so_stokgudang}}" type="hidden" name="stokril[]"></td>

					<td><span id="selisih{{$p->product_sku}}">{{((int) $p->so_stoktoko + (int) $p->so_stokgudang)-(int)$p->product_stokakhir}}</span>
                    <input id="selisihinput{{$p->product_sku}}" class="inputx" value="{{((int) $p->so_stoktoko + (int) $p->so_stokgudang)-(int)$p->product_stokakhir}}" type="hidden" name="selisih[]"></td>

                    <td id="keterangan{{$p->product_sku}}"><input id="keterangan{{$p->product_sku}}" class="form-control keterangans" data-sku="{{$p->product_sku}}" value="{{$p->so_keterangan}}" type="text" name="keterangan[]"></td>

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

$('.stoktokoinput').on('change', function (e) {
    select_val = $(this).attr('data-sku');
    $("#stokril"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()));
    $("#stokrilinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()));
    $("#selisih"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#sisainput"+select_val).val())));
    $("#selisihinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#sisainput"+select_val).val())));
});

$('.stokgudanginput').on('change', function (e) {
    select_val = $(this).attr('data-sku');
    $("#stokril"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()));
    $("#stokrilinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()));
    $("#selisih"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#sisainput"+select_val).val())));
    $("#selisihinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#sisainput"+select_val).val())));
});

$(document).ready(function(){
    $(".stoktokoinput").each(function(){
    select_val = $(this).attr('data-sku');
    $("#stokril"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()));
    $("#stokrilinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()));
    $("#selisih"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#sisainput"+select_val).val())));
    $("#selisihinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#sisainput"+select_val).val())));
});

$(".stokgudanginput").each(function(){
    select_val = $(this).attr('data-sku');
    $("#stokril"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()));
    $("#stokrilinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()));
    $("#selisih"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#sisainput"+select_val).val())));
    $("#selisihinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#sisainput"+select_val).val())));
});
});
$('#simpan').on('click', function (e) {
    e.preventDefault();
    $.ajax({
                url: '/api/simpansobulanan',
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'product_skus[]' :   $('input[name="product_skus[]"]').map(function(){  return this.value; }).get(),
                    'pubgroupname' :   $('input[name="pubgroupname"]').val(),
                    'stok[]' :   $('input[name="stok[]"]').map(function(){  return this.value; }).get(),
                    'stokakhir[]' :   $('input[name="stokakhir[]"]').map(function(){  return this.value; }).get(),
                    'stokterjual[]' :   $('input[name="stokterjual[]"]').map(function(){  return this.value; }).get(),
                    'stoksisa[]' :   $('input[name="stoksisa[]"]').map(function(){  return this.value; }).get(),
                    'stokril[]' :   $('input[name="stokril[]"]').map(function(){  return this.value; }).get(),
                    'stoktoko[]' :   $('input[name="stoktoko[]"]').map(function(){  return this.value; }).get(),
                    'stokgudang[]' :   $('input[name="stokgudang[]"]').map(function(){  return this.value; }).get(),
                    'keterangan[]' :   $('input[name="keterangan[]"]').map(function(){  return this.value; }).get(),
                    'selisih[]' :   $('input[name="selisih[]"]').map(function(){  return this.value; }).get(),
                    'so_date' :    $('input[name="so_date"]').val(),
                    'so_userid' :    $('input[name="so_userid"]').val(),
                    'so_namaso' :    $('input[name="so_namaso"]').val(),
                    'so_char' :    $('input[name="so_namaso"]').val(),
                    'so_size' :    $('input[name="so_size"]').val(),
                },
                success: function (data) {
                    if (data['success']) {
                        Swal.fire(
                         'Success',
                         'Laporan SO Berhasil Disimpan',
                         'success'
                         );

                         window.location = "{{url('stokopname/bulanan/edit/')}}"+"/"+(data['pubgroup']);

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
    dom: 'Bfrtip',
        search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
            buttons: [
        {
            extend: 'excelHtml5',
            exportOptions: {
                @if(Auth::user()->role == 4)
                columns: [ 0,1,2,3,4,5,6,7,8,12]
                @elseif(Auth::user()->role == 2)
                columns: [ 0,1,2,3,4,5,6,7,9,12]
                @elseif(Auth::user()->role == 1 || Auth::user()->role == 6)
                columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12]
                @else
                columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12]
                @endif
            }
            }
        ],
        "paging":   false,
    } );


    $('#datepicker').datepicker({
   todayHighlight: true,
   orientation: "bottom left",
   format: "yyyy-mm-dd"
  });
</script>
@endsection
@endsection
