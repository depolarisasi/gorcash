@extends('layouts.app')
@section('title','Produk - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
        <div class="mt-10 mb-5" >
            <div class="mt-10 mb-5 collapse" id="kt_datatable_group_action_form_2">
                <div class="d-flex align-items-center">
                    <div class="font-weight-bold text-danger mr-3">
                        Selected <span id="kt_datatable_selected_records_2">0</span> records:
                    </div>

                    <button class="btn btn-sm btn-danger mr-2 delete_all" type="button" data-url="{{ url('adminlab/api/massdelete') }}" id="kt_datatable_delete_all_2">
                        Delete All
                    </button>

                    <button class="btn btn-sm btn-danger mr-2 delete_all" type="button" data-url="{{ url('adminlab/api/massdelete') }}" id="kt_datatable_delete_all_2">
                        Delete All
                    </button>
                </div>
            </div>
		</div>
		<!--begin: Datatable-->
		<table class="table table-striped table-bordered mt-5" id="product">
			<thead>
				<tr>
					<th width="5%">Select</th>
					<th>Foto</th>
					<th>Master SKU</th>
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
                    <td><input type="checkbox" class="selectproduct" name="selected_product" data-id="{{$p->product_id}}" value="{{$p->product_id}}" @if($p->product_tanggalpublish != NULL) disabled @endif></td>
                    <td><img src="{{asset($p->product_foto)}}" class="img-fluid w-50 h-100"></td>
					<td>{{$p->product_mastersku}}</td>
					<td>{{$p->product_nama}}</td>
					<td>
                        @if($p->product_idsize == 1)
                        S
                        @elseif($p->product_idsize == 2)
                        M
                        @elseif($p->product_idsize == 3)
                        L
                        @elseif($p->product_idsize == 4)
                        XL
                        @elseif($p->product_idsize == 5)
                        XXL
                        @elseif($p->product_idsize == 6)
                        XXXL
                        @elseif($p->product_idsize == 7)
                        ALL SIZE
                        @endif
                       </td>

					<td>{{$p->product_vendor}}</td>
                    <td>{{$p->band_nama}}</td>
                    <td><p><span class="label label-danger label-md label-inline mr-2">Beli : Rp{{$p->product_hargabeli}}</span> </p>
                        <p><span class="label label-primary label-md label-inline mr-2">Jual : Rp{{$p->product_hargajual}}</span> </p>
                        <p><span class="label label-success label-md label-inline mr-2">Profit : Rp{{$p->product_hargajual - $p->product_hargabeli}}</span> </p></td>
					<td>{{$p->product_stok}}</td>
					<td>
                        <a href="{{url('/produk/detail/'.$p->product_id)}}" class="btn btn-icon btn-xs btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
                        <a href="{{url('/produk/edit/'.$p->product_id)}}" class="btn btn-icon btn-xs btn-warning"><i class="fas fa-edit nopadding"></i></a>
                        <button type="button" href="{{url('/produk/delete/'.$p->product_id)}}" class="deletebtn btn btn-icon btn-xs btn-danger"><i class="fas fa-trash nopadding"></i></button>
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
 $('#product').DataTable({
        select: {
            style: 'multi'
        },
        search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
        "paging":   true,
        columnDefs: [
    { orderable: false, targets: 0 }
  ],
        "ordering": true,
    } );


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
        var check = confirm("Are you sure you want to delete this row?");
        if(check == true){
            var join_selected_values = allVals.join(",");
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: {
                    _token : "{{csrf_token()}}",
                    'ids' : join_selected_values},
                success: function (data) {
                    if (data['success']) {
                        $(".sub_chk:checked").each(function() {
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
          $.each(allVals, function( index, value ) {
              $('table tr').filter("[data-row-id='" + value + "']").remove();

          });

        }

    }

});

    $(document).ready(function(){
        $(':checkbox:checked').prop('checked',false);
        $(".selectproduct").change(function() {
            checked =  $('input:checkbox:checked').length;
            console.log(checked);
    if(checked > 0) {
                $('#kt_datatable_selected_records_2').html(checked);
                    $('#kt_datatable_group_action_form_2').collapse('show');
                }
                else {
                    $('#kt_datatable_group_action_form_2').collapse('hide');
                }
});


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


                            </script>
@endsection
@endsection
