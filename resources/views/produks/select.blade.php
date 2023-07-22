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
<span class="card-label font-weight-bolder text-dark">Ubah Variasi dalam Produk</span>
</h3>
<div class="card-toolbar">
<a href="{{url('produk/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
    <div class="mt-10 mb-5" >
        <div class="mt-10 mb-5 collapse" id="kt_datatable_group_action_form_2">
            <div class="d-flex align-items-center">
                <div class="font-weight-bold text-danger mr-3">
                    Selected <span id="kt_datatable_selected_records_2">0</span> records:
                </div>

                <button class="btn btn-sm btn-danger mr-2 delete_all" type="button" data-url="{{ url('api/deletesku') }}" id="kt_datatable_delete_all_2">
                    Delete All
                </button>

            </div>
        </div>
    </div>
		<!--begin: Datatable-->
        <div class="table-responsive">
		<table class="table table-striped table-bordered mt-5" id="product">
			<thead>
				<tr>
					<th width="5%">Select</th>
					<th>Foto</th>
					<th>Master SKU</th>
                    <th>SKU</th>
					<th>Nama Produk</th>
					<th>Size</th>
                    @if(Auth::user()->role ==  1)
					<th>Vendor</th>
                    @endif
					<th>Band</th>
                    @if(Auth::user()->role == 1 || Auth::user()->role == 6 )<th>Harga Beli</th>@endif
					<th>Harga Jual</th>
                    @if(Auth::user()->role == 1 || Auth::user()->role == 6 )<th>Keuntungan</th>@endif
					<th>Stok Awal</th>
					<th>Stok Akhir</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

                @foreach($produk as $p)
				<tr>
                    <td><input type="checkbox" class="selectproduct" name="selected_product" data-id="{{$p->product_sku}}" value="{{$p->product_sku}}" ></td>
                    <td class="text-center">
                        <a href="{{asset($p->product_foto?$p->product_foto:"/assets/nopicture.png")}}" data-type="image" data-fslightbox="galleryproduk">
                            <img src="{{asset($p->product_foto?$p->product_foto:"/assets/nopicture.png")}}" data-type="image" class="img-fluid" style="width: 50px !important; height: 50px !important;"></a>
                     </td>
					<td>{{$p->product_mastersku}}</td>
                    <td>{{$p->product_sku}}</td>
					<td>{{$p->product_nama}}</td>
					<td>{{$p->size_nama}}</td>

                    @if(Auth::user()->role ==  1)
					<td>{{$p->product_vendor}}</td>
                    @endif
                    <td>{{$p->band_nama}}</td>
                    @if(Auth::user()->role == 1 || Auth::user()->role == 6) <td>@money($p->product_hargabeli)</td>@endif
                    <td>@money($p->product_hargajual)</td>
                    @if(Auth::user()->role == 1 || Auth::user()->role == 6) <td>@money($p->product_hargajual - $p->product_hargabeli)</td>@endif
                        <td>{{$p->product_stok}}</td>
                        <td>{{$p->product_stokakhir}}</td>
					<td>
                        <a href="{{url('/produk/detail/'.$p->product_id)}}" class="btn btn-icon btn-xs btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
                        @if(Auth::user()->role == 1 || Auth::user()->role == 6 || Auth::user()->role == 4)
                        <a href="{{url('/produk/edit/'.$p->product_id)}}" class="btn btn-icon btn-xs btn-warning"><i class="fas fa-edit nopadding"></i></a>
                        @if(Auth::user()->role == 1 || Auth::user()->role == 6)
                        <button type="button" href="{{url('/produk/delete/'.$p->product_sku)}}" class="deletebtn btn btn-icon btn-xs btn-danger"><i class="fas fa-trash nopadding"></i></button>
                        @endif
                        @endif
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
<script src="{{asset('js/fslightbox.js')}}"></script>
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
