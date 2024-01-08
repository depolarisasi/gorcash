@extends('layouts.app')
@section('title','Transaksi - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" rel="stylesheet" type="text/css">
<style>
.styled {
    list-style-type: number;
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
<span class="card-label font-weight-bolder text-dark">Transaksi</span>
</h3>
<div class="card-toolbar">
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">

<div class="mb-1">
	<div class="row align-items-center">
                <div class="col-md-3">
					<div class="d-flex align-items-center">
						<label class="mr-3 mb-0">Channel</label>
						<select class="form-control" id="kt_datatable_search_channel">
							<option value="">All</option>
                            <option value="Toko">Toko</option>
                            <option value="Website">Website</option>
                            <option value="Shopee">Shopee</option>
                            <option value="Tokopedia">Tokopedia</option>
                            <option value="Blibli">Blibli</option>
                            <option value="BukaLapak">BukaLapak</option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Tiktok">Tiktok</option>
						</select>
					</div>
				</div>
        <div class="col-md-6">
            <table cellspacing="5" cellpadding="5" border="0">
                <tbody><tr>
                    <td>Tanggal Awal :</td>
                    <td><input type="text" class="form-control" id="min" name="min"></td>
                </tr>
                <tr>
                    <td>Tanggal Akhir :</td>
                    <td><input type="text" class="form-control" id="max" name="max"></td>
                </tr>
            </tbody></table>
		</div>

	</div>
</div>


		<!--begin: Datatable-->
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="product">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Channel</th>
                        <th>Invoice</th>
                        <th>Barang Terjual</th>
                        <th>Potongan</th>
                        <th>Total Penjualan</th>
                        <th>Diskon</th>
                        <th>Ongkos Kirim</th>
                        <th>Total Pendapatan</th>
                        <th>Tipe Pembayaran</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($penjualan as $key => $p)
                    <tr>
                        <td>{{\Carbon\Carbon::parse($p->penjualan_tanggalwaktupenjualan)->format('Y-m-d')}}</td>
                        <td>{{\Carbon\Carbon::parse($p->penjualan_tanggalwaktupenjualan)->format('H:i')}}</td>
                        <td>{{$p->penjualan_channel}}</td>
                        <td>@if($p->penjualan_invoice == NULL )
                            {{$p->customer_nama}} / {{$p->customer_nohp}}
                            @else {{$p->penjualan_invoice}}
                        @endif</td>
                        <td><ol class="styled">
                            @php $counter = count($barang[$key]); @endphp
                            @foreach($barang[$key] as $brg)
                        <li>{{$brg}}</li>
                        @if($counter > 1)
                        </br>
                        @endif
                            @endforeach
                            </ol>
                        </td>
                        <td>@foreach($potongan[$key] as $po)
                            {{$po}}
                                @endforeach
                                @foreach($pot[$key] as $nampot)
                            (@money($nampot))
                                @endforeach
                                <p>@money($p->penjualan_totalpotongan?$p->penjualan_totalpotongan:0)</p>
                            </td>
                        <td>@money($p->penjualan_totalpenjualan?$p->penjualan_totalpenjualan:0)</td>
                        <td>@money($p->penjualan_diskon)</td>
                        <td>{{$p->penjualan_kurir?$p->penjualan_kurir:"none"}} - @money($p->penjualan_ongkoskirim?$p->penjualan_ongkoskirim:0)</td>
                        <td>@money($p->penjualan_totalpendapatan)</td>
                        <td>{{$p->penjualan_paymentype}}</td>
                        <td>{{$p->penjualan_notes}}</td>
                        <td>
                            <a href="{{url('/penjualan/detail/'.$p->penjualan_id)}}" class="btn btn-icon btn-xs btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
                            @if($p->penjualan_receipt != NULL)<a href="{{url('/penjualan/struk/'.$p->penjualan_id)}}" class="btn btn-icon btn-xs btn-info"><i class="fas fa-print nopadding"></i></a>@endif
                           <a href="{{url('/ongkir/tambahresi/'.$p->penjualan_id)}}" class="btn btn-icon btn-xs btn-info"><i class="fas fa-receipt nopadding"></i></a>

                            <button type="button" href="{{url('/penjualan/delete/'.$p->penjualan_id)}}" class="deletebtn btn btn-icon btn-xs btn-danger"><i class="fas fa-trash nopadding"></i></button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
<script src="{{asset('js/fslightbox.js')}}"></script>


<script>
 tabel = $('#product').DataTable({
    dom: 'Blfrtip',
        buttons: [
            'excelHtml5',
        ],
        "order": [[ 0, "desc" ]],
        "paging":   true,
        "ordering": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );


        $('#kt_datatable_search_channel').on('change', function() {
            tabel.columns(2).search($(this).val().toLowerCase()).draw();
        });


</script>
<script>

var minDate, maxDate;

 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         var min = moment(minDate.val()).format("YYYY-MM-DD");
         var max = moment(maxDate.val()).format("YYYY-MM-DD");
         var date = moment(data[0]).format("YYYY-MM-DD");

         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date && max === null ) ||
             ( min <= date && date <= max ) ||
             ( moment(date).isSameOrAfter(min) && moment(date).isSameOrBefore(max) )
         ) {
             return true;
         }
         return false;
     }
 );

    $(document).ready(function(){

     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'YYYY-MM-DD'
     });
     maxDate = new DateTime($('#max'), {
         format: 'YYYY-MM-DD'
     });


     // Refilter the table
     $('#min, #max').on('change', function () {
         tabel.draw();
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
