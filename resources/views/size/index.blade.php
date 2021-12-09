@extends('layouts.app')
@section('title','Size - ')
@section('css')
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
<span class="card-label font-weight-bolder text-dark">Daftar Size</span>
</h3>
<div class="card-toolbar">
<a href="{{url('size/import')}}" class="btn btn-primary btn-md font-size-sm mr-2"><i class="fas fa-plus"></i> Import </a>
<a href="{{url('size/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Buat </a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<!--begin::Table-->
<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered mt-5" style="width:100%">
<thead>
<tr class="text-left">
<th style="width: 10%"><span class="text-dark-75">Select</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Nama Size</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Code Size</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Code Angka</span></th>
<th style="min-width: 50px"><span class="text-dark-75">Kategori</span></th>
<th style="min-width: 80px">Action</th>
</tr>
</thead>
<tbody>
    @foreach($size as $size)

<tr data-row-id="{{$size->size_nama}}">
    <td></td>
<td class="pl-3 py-3">{{$size->size_nama}}</td>
<td class="pl-3 py-3">{{$size->size_code}}</td>
<td class="pl-3 py-3">{{$size->size_id}}</td>
<td class="pl-3 py-3">
    <div class="d-flex align-items-center">
        <a href="#" class="text-dark-75 mb-1">{{$size->size_category}}</a>
    </div>
    </td>
<td>
    <a href="{{url('/size/edit/'.$size->size_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/size/delete/'.$size->size_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
<!--end::Table-->
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
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

            var table = $("#table").DataTable({
                dom: 'Blfrtip',
        buttons: [
           {
                text: 'Delete',
                action: function () {

                    var ids = $.map(table.rows('.selected').data(), function (item) {
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
                url: '/size/massdelete',
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
        order: [[ 1, 'asc' ]],
        "ordering": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
           });


                            </script>
@endsection
@endsection
