@extends('layouts.app')
@section('title','Detail '.$infopub->publish_name.'- ')
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
<span class="card-label font-weight-bolder text-dark">Detail {{$infopub->publish_name}}</span>
</h3>
<div class="card-toolbar">
<a href="{{url('publish')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
		<!--begin: Datatable-->
        <div class="table-responsive">
		<table class="table table-bordered mt-5" id="product">
			<thead>
				<tr>
                    <th width="5%">Foto</th>
					<th width="5%">SKU</th>
					<th width="10%">Nama Band</th>
					<th width="20%">Nama Produk</th>
					<th width="10%">Stok Awal</th>
					<th width="10%">Stok Akhir</th>
					<th width="10%">Tag</th>
					<th width="10%">Material</th>
					<th width="10%">Made In</th>
					<th width="10%">Condition</th>
				</tr>
			</thead>
			<tbody>

                @foreach($publish as $p)
				<tr>
                    <td><a href="{{asset($p->product_foto?$p->product_foto:"/assets/nopicture.png")}}" data-type="image" data-fslightbox="galleryproduk">
                        <img src="{{asset($p->product_foto?$p->product_foto:"/assets/nopicture.png")}}" data-type="image" class="img-fluid" style="width: 50px !important; height: 50px !important;"></a></td>
					<td>{{$p->product_sku}}</td>
					<td>{{$p->band_nama}}</td>
					<td>{{$p->product_nama}} ({{$p->size_nama}})</td>
					<td>{{$p->product_stok}}</td>
					<td>{{$p->product_stokakhir}}</td>
					<td>{{$p->product_tag}}</td>
					<td>{{$p->product_material}}</td>
					<td>{{$p->product_madein}}</td>
					<td>{{$p->product_condition}}</td>

                    </td>
				</tr>
                @endforeach

			</tbody>
		</table>
        <div class="row mt-10">
        <div class="col-md-4">
        </div>
    </div>
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
<script src="{{asset('js/fslightbox.js')}}"></script>


<script>
 tabel = $('#product').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            exportOptions: {
            columns: [ 1,2,3,4,5,6,7,8,9 ]
            }
            },
            {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'A4',
            exportOptions: {
            columns: [ 1,2,3,4,5,6,7,8,9 ]
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


        $('#kt_datatable_search_size').on('change', function() {
            tabel.search($(this).val().toLowerCase());
        });

        $('#kt_datatable_search_band').on('change', function() {
            tabel.search($(this).val().toLowerCase());
        });

        $('#kt_datatable_search_vendor').on('change', function() {
            tabel.search($(this).val().toLowerCase());
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
                        $("#kt_datatable_publish_all_2").removeClass("spinner spinner-right spinner-white pr-15")
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
