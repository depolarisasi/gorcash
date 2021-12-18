@extends('layouts.app')
@section('title','Barcode Export '.$detail->exportsku_name.'- ')
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
<span class="card-label font-weight-bolder text-dark">Detail {{$detail->exportsku_name}}</span>
</h3>
<div class="card-toolbar">
<a href="{{url('export-barcode')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
    <form  method="POST" action="{{url('export-barcode/update')}}">
        @csrf
        <input type="hidden" name="exportid" value="{{$detail->exportsku_id}}">
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="row">
            <label class="col-md-4">Nama Export SKU</label>
            <input id="name" type="text" class="form-control col-md-8" name="exportsku_name" value="{{$detail->exportsku_name}}">
            </div>
        </div>
    </div>
		<!--begin: Datatable-->
        <div class="table-responsive">
            <table class="table table-bordered mt-5" id="product">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Band</th>
                        <th>Size</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($export as $p)
                    <tr data-row-id="{{$p->product_sku}}">
                        <td></td>
                        <td>{{$p->product_sku}}</td>
                        <td>{{$p->product_nama}}</td>
                        <td>{{$p->band_nama}}</td>
                        <td>{{$p->size_nama}}</td>
                        <td>@money($p->product_hargajual)</td>
                        <td><button type="button" href="{{url('/export-barcode/delete/?sku='.$p->exportsku_productsku.'&id='.$p->exportsku_groupid)}}" class="deletebtn btn btn-icon btn-xs btn-danger"><i class="fas fa-trash nopadding"></i></button></td>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="row mt-5 mb-5">
                <div class="col-md-4">
                    <button class="btn btn-md btn-primary" type="submit">Edit Export</button>
                </div>
            </div> </form>
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
       dom: 'Bfrtip',
       buttons: [
           {
               extend: 'excelHtml5',
               exportOptions: {
               columns: [ 1,2,3,4,5 ]
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
   url: '/api/exportmassdelete/',
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
   }
           ],
        "paging":   false,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
       } );

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
        $(document).on('click', '.deletebtn', function(e) {
           var href = $(this).attr('href');
           Swal.fire({
       title: 'Yakin untuk menghapus Product dalam Export ini ? ',
       text: 'SEMUA DATA mengenai Product dalam Export ini akan dihapus dan tidak dapat dikembalikan!',
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
