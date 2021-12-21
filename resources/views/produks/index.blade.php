@extends('layouts.app')
@section('title','Database Product - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet" type="text/css">
<style>
.fsm {
    font-size: 12px !important;
}
.psm {
    padding : 0.7rem !important;
}
</style>
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
<span class="card-label font-weight-bolder text-dark">Database Product</span>
</h3>
<div class="card-toolbar">
<a href="{{url('produk/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Tambah</a>
<a href="{{url('produk/import')}}" class="btn btn-primary btn-md font-size-sm ml-2"><i class="fas fa-plus"></i> Import</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

<div class="mb-7">
	<div class="row align-items-center">
		<div class="col-lg-8 col-xl-8">
			<div class="row align-items-center">
                <div class="col-md-4 my-2 my-md-0">
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
                <div class="col-md-4 my-2 my-md-0">
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
				<div class="col-md-4 my-2 my-md-0">
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
		<div class="col-lg-4 col-xl-4 mt-5 mt-lg-0">
			<a href="#" class="btn btn-light-primary px-6 font-weight-bold">
				Search
			</a>
		</div>
	</div>
</div>
<!--end::Search Form-->
		<!--end: Search Form-->

		<!--begin: Datatable-->
        <div class="table-responsive">
		<table class="table table-bordered mt-5" id="product">
			<thead>
				<tr>
					<th width="5%">Select</th>
					<th>Master SKU</th>
					<th>Nama Produk</th>
					<th>Size</th>
					<th>Vendor</th>
					<th>Band</th>
					@if(Auth::user()->role == 1)<th>Harga Beli</th>@endif
					<th>Harga Jual</th>
                    @if(Auth::user()->role == 1)<th>Keuntungan</th>@endif
					<th width="5%">Stok Awal</th>
					<th width="5%">Stok Akhir</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

                @foreach($produk as $p)
				<tr data-row-id="{{$p->product_mastersku}}" @if($p->product_stok < 1 || $p->product_status == 1) class="ignore fsm psm" @else class="fsm psm" @endif>
                    <td></td>
					<td>{{$p->product_mastersku}}</td>
					<td>{{$p->product_nama}} @if($p->product_status == 1)
                        <span class="label label-success label-sm label-inline mr-2"><i class="fas fa-check text-white p-0" style="font-size: 0.8em"></i></span>
                    @endif</td>
					<td>{{$p->product_idsize}}</td>
					<td>{{$p->product_vendor}}</td>
					<td>{{$p->band_nama}}</td>
                    @if(Auth::user()->role == 1) <td>@money($p->product_hargabeli)</td>@endif
                    <td>@money($p->product_hargajual)</td>
                    @if(Auth::user()->role == 1) <td>@money($p->product_hargajual - $p->product_hargabeli)</td>@endif
					<td>{{$p->product_stokawal}}</td>
                    <td>{{$p->product_stokakhir}}</td>
					<td>
                        <a href="{{url('/produk/select/'.$p->product_mastersku)}}" class="btn btn-icon btn-xs btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
                        <a href="{{url('/produk/select/'.$p->product_mastersku)}}" class="btn btn-icon btn-xs btn-warning"><i class="fas fa-edit nopadding"></i></a>
                        <button type="button" href="{{url('/produk/deletemaster/'.$p->product_mastersku)}}" class="deletebtn btn btn-icon btn-xs btn-danger"><i class="fas fa-trash nopadding"></i></button>
                    </td>
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
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script src="{{asset('js/fslightbox.js')}}"></script>

<script>
 tabel = $('#product').DataTable({
    dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    @if(Auth::user()->role == 1)
                    columns: [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    @else
                    columns: [ 2, 3, 4, 5, 6, 7, 8, 9 ]
                    @endif
                }
            },
            {
      text: 'Select All On Page',
      action: function() {
        tabel.rows({
          page: 'current'
        }).select();
      }
    },
        'selectNone',
             {
                text: 'Publish',
                action: function () {
                   var join_selected_values = $.map(tabel.rows('.selected').data(), function (item) {
       				 return item[1]
    					});
                        if(join_selected_values.length <=0)
    {
        Swal.fire(
       'Error',
       'Silahkan Pilih Data Yang Ingin Dipublish',
       'error'
     )
    }else {

            $.ajax({
                url: '/api/publish/',
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'ids' : join_selected_values},
                success: function (data) {
                    if (data['success']) {
                        window.location = "/publish/"+data['groupname'];
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                      console.log(data);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });

    }


                }
            },{

                text: 'Delete',
                action: function () {

                    var ids = $.map(tabel.rows('.selected').data(), function (item) {
       				 return item[1]
    					});
                    if(ids.length <=0)
    {
        Swal.fire(
       'Error',
       'Silahkan Pilih Data Yang Ingin Dihapus',
       'error'
     )
    }  else {
        var check = confirm("Are you sure you want to delete selected data?");
        if(check == true){
            var join_selected_values = ids;
            $.ajax({
                url: '/api/massdelete/',
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'ids' : join_selected_values},
                success: function (data) {
                    if (data['success']) {
                        $(".selected:checked").each(function() {
                            $(this).parents("tr").remove();
                        });
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
          $.each(ids, function( index, value ) {
              $('table tr').filter("[data-row-id='" + value + "']").remove();

          });

        }

    }

                }
            }, {
                text: 'Export SKU',
                action: function () {
                   var join_selected_values = $.map(tabel.rows('.selected').data(), function (item) {
       				 return item[1]
    					});
                        if(join_selected_values.length <=0)
    {
        Swal.fire(
       'Error',
       'Silahkan Pilih Data Yang Ingin Diexport',
       'error'
     )
    }else {

            $.ajax({
                url: '/api/exportsku/',
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'ids' : join_selected_values},
                success: function (data) {
                    if (data['success']) {
                        window.location = "/export-barcode/edit/"+data['groupname'];
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                      console.log(data);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });

    }


                }
            }, {
                text: 'Unpublish',
                action: function () {
                   var join_selected_values = $.map(tabel.rows('.selected').data(), function (item) {
       				 return item[1]
    					});
                        if(join_selected_values.length <=0)
    {
        Swal.fire(
       'Error',
       'Silahkan Pilih Data Yang Ingin Dipublish',
       'error'
     )
    }else {

            $.ajax({
                url: '/api/unpublish/',
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'ids' : join_selected_values},
                success: function (data) {
                    if (data['success']) {
                        window.location = "/produk/";
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                      console.log(data);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });

    }


                }
            },

        ],
        search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
        "paging":   true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        "ordering": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

    } );

    $('#kt_datatable_search_size').on('change', function() {
            tabel.columns(3).search($(this).val().toLowerCase()).draw();
        });

        $('#kt_datatable_search_band').on('change', function() {
            tabel.columns(5).search($(this).val().toLowerCase()).draw();
        });

        $('#kt_datatable_search_vendor').on('change', function() {
            tabel.columns(4).search($(this).val().toLowerCase()).draw();
        });

        $('#kt_datatable_search_size,#kt_datatable_search_band,#kt_datatable_search_vendor').selectpicker();

</script>
<script>

$('.delete_all').on('click', function(e) {
    var allVals = [];
    $(".selectproduct:checked").each(function() {
        allVals.push($(this).attr('data-id'));
    });

    if(allVals.length <=0)
    {
        Swal.fire(
       'Error',
       'Silahkan Pilih Data Yang Ingin Dihapus',
       'error'
     )
    }  else {
        var check = confirm("Are you sure you want to delete selected data?");
        if(check == true){
            var join_selected_values = allVals.join(",");
            $("#kt_datatable_delete_all_2").addClass("spinner spinner-right spinner-white pr-15");
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'ids' : join_selected_values},
                success: function (data) {
                    if (data['success']) {
                        $(".selectproduct:checked").each(function() {
                            $(this).parents("tr").remove();
                        });
                        $("#kt_datatable_delete_all_2").removeClass("spinner spinner-right spinner-white pr-15")
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
          $.each(allVals, function( index, value ) {
              $('table tr').filter("[data-row-id='" + value + "']").remove();

          });

        }

    }

});

$('.publish_all').on('click', function(e) {
    var pub = [];
    $(".selectproduct:checked").each(function() {
        pub.push($(this).attr('data-id'));
    });

    if(pub.length <=0)
    {
        Swal.fire(
       'Error',
       'Silahkan Pilih Data Yang Ingin Dipublish',
       'error'
     )
    }  else {
        var check = confirm("Publish produk ini?");
        if(check == true){
            var join_selected_values = pub.join(",");
            $("#kt_datatable_publish_all_2").addClass("spinner spinner-right spinner-white pr-15");
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'ids' : join_selected_values},
                success: function (data) {
                    if (data['success']) {
                        window.location = "/publish/"+data['groupname'];
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                      console.log(data);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });


        }

    }

});

    $(document).ready(function(){

        $(document).on('click', '.deletebtn', function(e) {
           var href = $(this).attr('href');
           Swal.fire({
       title: 'Yakin untuk menghapus Produk ini ? ',
       text: 'SEMUA DATA mengenai Produk ini akan dihapus dan tidak dapat dikembalikan!',
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


                            </script>
@endsection
@endsection
