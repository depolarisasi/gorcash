@extends('layouts.app')
@section('title','Publish Produk - ')
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
<span class="card-label font-weight-bolder text-dark">Publish Produk</span>
</h3>
<div class="card-toolbar">
<a href="{{url('publish')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
    <form method="POST" action="{{url('publish/update')}}" >
        @csrf
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-group row">
            <label class="col-md-4">Nama Publish</label>
            <input id="name" type="text" class="form-control col-md-8" name="publish_name" value="{{$infopub->publish_name?$infopub->publish_name:null}}">
            <input type="hidden" name="publish_groupid" value="{{$infopub->publish_groupid}}">
            </div>
            <div class="form-group row">
                <label class="col-md-4">Tanggal Publish</label>
                <input id="tanggal" type="date" class="form-control col-md-8" name="publish_tanggal" value="{{$infopub->publish_tanggal?$infopub->publish_tanggal:null}}">
                </div>
        </div>
    </div>

		<!--begin: Datatable-->
        <div class="table-responsive">

		<table class="table table-bordered mt-5" id="product">
			<thead>
				<tr>
					<th width="5%">FOTO</th>
					<th width="5%">SKU</th>
					<th width="5%">BAND</th>
					<th width="5%">ARTIKEL</th>
					<th width="5%">HARGA</th>
					<th width="8%">S.AWAL</th>
					<th width="8%">S.AKHIR</th>
					<th width="8%">S.GDNG</th>
					<th width="8%">S.TOKO</th>
					<th width="3%">MIN</th>
					<th width="5%">WARNA</th>
					<th width="7%">TAG</th>
					<th width="7%">MATERIAL</th>
					<th width="7%">MADE IN</th>
					<th width="7%">UKURAN</th>
					<th width="7%">KET</th>
				</tr>
			</thead>
			<tbody>

                @foreach($publish as $p)
				<tr>
                    <input type="hidden" name="publish_id[]" value="{{$p->publish_id}}">
                    <input type="hidden" name="product_id[]" value="{{$p->product_id}}">
                    <td><a href="{{asset($p->product_foto?$p->product_foto:"/assets/nopicture.png")}}" data-type="image" data-fslightbox="galleryproduk">
                        <img src="{{asset($p->product_foto?$p->product_foto:"/assets/nopicture.png")}}" data-type="image" class="img-fluid" style="width: 50px !important; height: 50px !important;"></a></td>
					<td>{{$p->product_sku}}</td>
					<td>{{$p->band_nama}}</td>
					<td>{{$p->product_nama}} ({{$p->size_nama}})</td>
					<td>@money($p->product_hargajual)</td>
                    <td><input type="number" class="form-control stokinput" min="0" id="stok{{$p->product_sku}}" data-sku="{{$p->product_sku}}" name="product_stok[]" value="{{$p->product_stok}}"></td>
                    <td><input type="number" class="form-control stokakhirinput" min="0"  id="stokakhir{{$p->product_sku}}" data-sku="{{$p->product_sku}}" name="product_stokakhir[]" value="{{$p->product_stokakhir}}"  ></td>
                    <td><input type="number" class="form-control stokgudanginput" min="0" id="stokgudang{{$p->product_sku}}"data-sku="{{$p->product_sku}}" name="product_stokgudang[] "@if($p->product_stokgudang == 0) value="0" @else value="{{$p->product_stokgudang}}" @endif ></td>
                    <td><input type="number" class="form-control stoktokoinput" min="0"  id="stoktoko{{$p->product_sku}}" data-sku="{{$p->product_sku}}" name="product_stoktoko[]" @if($p->product_stoktoko == 0) value="0" @else value="{{$p->product_stoktoko}}" @endif></td>
					<td><span id="selisih{{$p->product_sku}}">{{$p->publish_selisih}}</span>
                    <input id="selisihinput{{$p->product_sku}}" class="inputx" value="0" type="hidden" name="publish_selisih[]"></td></td>
                    <td>{{$p->color_nama}}</td>
					<td><input type="text" class="form-control" name="product_tag[]" value="{{$p->product_tag}}"></td>
					<td><input type="text" class="form-control" name="product_material[]" value="{{$p->product_material}}"></td>
					<td><input type="text" class="form-control" name="product_madein[]" value="{{$p->product_madein}}"></td>
					<td><input type="text" class="form-control" name="product_condition[]" value="{{$p->product_condition}}"></td>
					<td><input type="text" class="form-control" name="product_keterangan[]" value="{{$p->product_keterangan}}"></td>

				</tr>
                @endforeach

			</tbody>
		</table>
        <div class="row mt-10">
            <div class="col-md-4">
                <button type="submit" class="btn btn-md btn-primary">Publish</button>
            </div>
        </div>
    </form>
    </div>
		<!--end: Datatable-->
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
    $('.stoktokoinput').on('change', function (e) {
    select_val = $(this).attr('data-sku');
    $("#selisih"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#stokakhir"+select_val).val())));
    $("#selisihinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#stokakhir"+select_val).val())));
});

$('.stokakhirinput').on('change', function (e) {
    select_val = $(this).attr('data-sku');
    $("#selisih"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#stokakhir"+select_val).val())));
    $("#selisihinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#stokakhir"+select_val).val())));
});

$('.stokgudanginput').on('change', function (e) {
    select_val = $(this).attr('data-sku');
    $("#selisih"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#stokakhir"+select_val).val())));
     $("#selisihinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#stokakhir"+select_val).val())));
});


 tabel = $('#product').DataTable({
        search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
        "paging":   false,
        "ordering": false,
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
        $(".stokakhirinput").each(function(){  
            select_val = $(this).attr('data-sku');
    $("#selisih"+select_val).text(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#stokakhir"+select_val).val())));
     $("#selisihinput"+select_val).val(parseInt($("#stoktoko"+select_val).val())+parseInt($("#stokgudang"+select_val).val()-parseInt($("#stokakhir"+select_val).val())));
}); 
    
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
