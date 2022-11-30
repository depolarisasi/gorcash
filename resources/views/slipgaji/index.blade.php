@extends('layouts.app')
@section('title','Slip Gaji - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Slip Gaji</span>
</h3>
<div class="card-toolbar">
<a href="{{url('slipgaji/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Tambah</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
  
<div class="mb-7">
	<div class="row align-items-center">
		<div class="col-lg-8 col-xl-8">
            <form method="get" action="{{url('slipgaji')}}">
			<div class="row align-items-center">
                <div class="col-md-4 my-2 my-md-0">
					<div class="d-flex align-items-center">
						<label class="mr-3 mb-0 d-none d-md-block">Bulan:</label>
						<select class="form-control" name="bulan" id="bulan">
							<option value="All" @if(Request::get('bulan') == "All")) selected="selected" @endif>All</option>
              <option value="January" @if(Request::get('bulan') == "January") selected="selected" @endif>January</option>
              <option value="February" @if(Request::get('bulan') == "February") selected="selected" @endif>February</option>
              <option value="March" @if(Request::get('bulan') == "March") selected="selected" @endif>March</option> 
              <option value="April" @if(Request::get('bulan') == "April") selected="selected" @endif>April</option>
              <option value="May" @if(Request::get('bulan') == "May") selected="selected" @endif>May</option>
              <option value="June" @if(Request::get('bulan') == "June") selected="selected" @endif>June</option>
              <option value="July" @if(Request::get('bulan') == "July") selected="selected" @endif>July</option>
              <option value="August" @if(Request::get('bulan') == "August") selected="selected" @endif>August</option>
              <option value="September" @if(Request::get('bulan') == "September") selected="selected" @endif>September</option>
              <option value="October" @if(Request::get('bulan') == "October") selected="selected" @endif>October</option>
              <option value="November" @if(Request::get('bulan') == "November") selected="selected" @endif>November</option>
              <option value="December" @if(Request::get('bulan') == "December") selected="selected" @endif>December</option> 

						</select>
					</div>
				</div>
                <div class="col-md-4 my-2 my-md-0">
					<div class="d-flex align-items-center">
						<label class="mr-3 mb-0 d-none d-md-block">Tahun:</label>
						<select class="form-control" name="tahun" id="band">
							<option value="All" @if(Request::get('tahun') == "All") selected="selected" @endif>All</option>
                            @foreach($tahun as $t)
							<option value="{{$t->year}}" @if(Request::get('tahun') == $t->year) selected="selected" @endif>{{$t->year}}</option>
                            @endforeach


						</select>
					</div>
				</div>
                <div class="col-md-4 col-lg-4 col-xl-4 mt-5 mt-lg-0">
                    <button href="#" class="btn btn-light-primary px-6 font-weight-bold">
                        Filter
                    </button>
                </div>
                			</div>
                        </form>
		</div>

	</div>
</div>
<div class="tab-content">
<!--begin::Table-->
<div class="table-responsive">
    <table id="basic-datatable" class="table dt-responsive table-bordered nowrap" style="width:100%">
<thead>
<tr class="text-left">
<th style="min-width: 50px"><span class="text-dark-75">Nama</span></th>
<th style="min-width: 100px">Jabatan</th> 
<th style="min-width: 100px">Bulan & Tahun</th> 
<th style="min-width: 100px">Jumlah THP</th> 
<th style="min-width: 80px">Action</th>
</tr>
</thead>
<tbody>
    @foreach($gaji as $k)
<tr>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  {{$k->karyawan_nama}}
</div>
</td>
<td>
<span class="text-dark-75 d-block">
{{$k->karyawan_jabatan}}
</span>
</td> 
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  {{$k->slipgaji_bulan}} ({{$k->slipgaji_tahun}})
</div>
</td>
<td class="pl-3 py-3">
<div class="d-flex align-items-center">
  Rp  @money($k->slipgaji_thp)
</div>
</td>
<td>
    <a href="{{url('/slipgaji/detail/'.$k->slipgaji_id)}}" class="btn btn-xs btn-icon btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
    <a href="{{url('/slipgaji/print/'.$k->slipgaji_id)}}" class="btn btn-xs btn-icon btn-secondary"><i class="fas fa-print nopadding"></i></a>
    <a href="{{url('/slipgaji/pdf/'.$k->slipgaji_id)}}" class="btn btn-xs btn-icon btn-success"><i class="fas fa-file-pdf nopadding"></i></a>
    <button type="button" href="{{url('/slipgaji/delete/'.$k->slipgaji_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
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
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>>
<script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function(){


        $(document).on('click', '.deletebtn', function(e) {
           var href = $(this).attr('href');
           Swal.fire({
       title: 'Yakin untuk menghapus slip gaji ini ? ',
       text: 'SEMUA DATA mengenai slip gaji ini akan dihapus dan tidak dapat dikembalikan!',
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
