@extends('layouts.app')
@section('title','Produk - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Produk</span>
</h3>
<div class="card-toolbar">
<a href="{{url('produk/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Buat</a>
<a href="{{url('produk/import')}}" class="btn btn-primary btn-md font-size-sm ml-2"><i class="fas fa-plus"></i> Import</a>
<a href="{{url('produk/export')}}" class="btn btn-primary btn-md font-size-sm ml-2"><i class="fas fa-plus"></i> Export</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

<div class="mb-7">
	<div class="row align-items-center">
		<div class="col-lg-10 col-xl-10">
			<div class="row align-items-center">
				<div class="col-md-3 my-2 my-md-0">
					<div class="input-icon">
						<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
						<span><i class="flaticon2-search-1 text-muted"></i></span>
					</div>
				</div>

                				<div class="col-md-3 my-2 my-md-0">
					<div class="d-flex align-items-center">
						<label class="mr-3 mb-0 d-none d-md-block">Size:</label>
						<select class="form-control" id="kt_datatable_search_size">
							<option value="">All</option>
                            @foreach($size as $s)
                            <option value="{{$s->size_nama}}">{{$s->size_nama}}</option>
                            @endforeach
						</select>
					</div>
				</div>
                <div class="col-md-3 my-2 my-md-0">
					<div class="d-flex align-items-center">
						<label class="mr-3 mb-0 d-none d-md-block">Band:</label>
						<select class="form-control" id="kt_datatable_search_band">
							<option value="">All</option>
                            @foreach($band as $b)
                            <option value="{{$b->band_nama}}">{{$b->band_nama}}</option>
                            @endforeach

						</select>
					</div>
				</div>
				<div class="col-md-3 my-2 my-md-0">
					<div class="d-flex align-items-center">
						<label class="mr-3 mb-0 d-none d-md-block">Vendor:</label>
						<select class="form-control" id="kt_datatable_search_vendor">
							<option value="">All</option>
                            @foreach($vendor as $v)
                            <option value="{{$v->vendor_nama}}">{{$v->vendor_nama}}</option>
                            @endforeach
						</select>
					</div>
				</div>
                			</div>
		</div>
		<div class="col-lg-2 col-xl-2 mt-5 mt-lg-0">
			<a href="#" class="btn btn-light-primary px-6 font-weight-bold">
				Search
			</a>
		</div>
	</div>
</div>
<!--end::Search Form-->
		<!--end: Search Form-->

		<!--begin: Datatable-->
		<table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
			<thead>
				<tr>
					<th>Foto</th>
					<th>SKU</th>
					<th>Nama Produk</th>
					<th>Size</th>
					<th>Vendor</th>
					<th>Band</th>
					<th>Harga</th>
					<th>Stok</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                @foreach($produk as $p)
				<tr>
                    <td><img src="{{asset($p->produk_foto)}}" class="img-fluid w-50 h-100"></td>
					<td>{{$p->produk_sku}}</td>
					<td>{{$p->produk_nama}}</td>
					<td>
                        @if($p->produk_idsize == 1)
                        S
                        @elseif($p->produk_idsize == 2)
                        M
                        @elseif($p->produk_idsize == 3)
                        L
                        @elseif($p->produk_idsize == 4)
                        XL
                        @elseif($p->produk_idsize == 5)
                        XXL
                        @elseif($p->produk_idsize == 6)
                        XXXL
                        @elseif($p->produk_idsize == 7)
                        ALL SIZE
                        @endif
                       </td>
					<td>{{$p->vendor_nama}}</td>
                    <td>{{$p->band_nama}}</td>
                    <td><p><span class="label label-danger label-md label-inline mr-2">Beli : Rp{{$p->produk_hargabeli}}</span> </p>
                        <p><span class="label label-primary label-md label-inline mr-2">Jual : Rp{{$p->produk_hargajual}}</span> </p>
                        <p><span class="label label-success label-md label-inline mr-2">Profit : Rp{{$p->produk_hargajual - $p->produk_hargabeli}}</span> </p></td>
					<td>{{$p->produk_stok}}</td>
					<td>
                        <a href="{{url('/produk/detail/'.$p->produk_id)}}" class="btn btn-sm btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
                        <a href="{{url('/produk/edit/'.$p->produk_id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit nopadding"></i></a>
                        <button type="button" href="{{url('/produk/delete/'.$p->produk_id)}}" class="deletebtn btn btn-sm btn-danger"><i class="fas fa-trash nopadding"></i></button>
                    </td>
				</tr>
                @endforeach

			</tbody>
		</table>
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
<script>
    "use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
    // Private functions

    // demo initializer
    var demo = function() {

		var datatable = $('#kt_datatable').KTDatatable({
			data: {
				saveState: {cookie: false},
			},
			search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},

		});



        $('#kt_datatable_search_size').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Size');
        });

        $('#kt_datatable_search_band').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Band');
        });

        $('#kt_datatable_search_vendor').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Vendor');
        });

        $('#kt_datatable_search_size, #kt_datatable_search_band,#kt_datatable_search_vendor').selectpicker();

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
<script>
    $(document).ready(function(){


        $(document).on('click', '.deletebtn', function(e) {
           var href = $(this).attr('href');
           Swal.fire({
       title: 'Yakin untuk menghapus vendor ini ? ',
       text: 'SEMUA DATA mengenai vendor ini akan dihapus dan tidak dapat dikembalikan!',
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#95000c',
       confirmButtonText: 'Ya, Hapus!',
       cancelButtonText: 'Tidak, batalkan'
     }).then((result) => {
       if (result.value) {
          window.location.href = href;

       //  For more information about handling dismissals please visit
       // https://sweetalert2.github.io/#handling-dismissals
       } else if (result.dismiss === Swal.DismissReason.cancel) {
         Swal.fire(
           'Dibatalkan',
           'Data tidak jadi dihapus',
           'error'
         )
       }
     });

          });
            });

           var table = $("#basic-datatable").DataTable({

                 language: { paginate: {
                    previous: "<i class='uil uil-angle-left'>",
                    next: "<i class='uil uil-angle-right'>" } },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                }
                            });

                            </script>
@endsection
@endsection
