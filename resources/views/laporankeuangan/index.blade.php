@extends('layouts.app')
@section('title','Laporan Keuangan - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Laporan Keuangan</span>
</h3>
<div class="card-toolbar"> 
<a href="{{url('laporankeuangan/new')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-plus"></i> Buat </a> 
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
  
<div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-8 col-xl-8">
                <form method="get" action="{{url('laporankeuangan')}}">
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
                                <option value="2022" @if(Request::get('tahun') == "2022") selected="selected" @endif>2022</option>
                                <option value="2023" @if(Request::get('tahun') == "2023") selected="selected" @endif>2023</option>
                                <option value="2024" @if(Request::get('tahun') == "2024") selected="selected" @endif>2024</option>
                                <option value="2025" @if(Request::get('tahun') == "2025") selected="selected" @endif>2025</option>
                                <option value="2026" @if(Request::get('tahun') == "2026") selected="selected" @endif>2026</option>
                                <option value="2027" @if(Request::get('tahun') == "2027") selected="selected" @endif>2027</option>
                                <option value="2028" @if(Request::get('tahun') == "2028") selected="selected" @endif>2028</option>
                                <option value="2029" @if(Request::get('tahun') == "2029") selected="selected" @endif>2029</option>
                                <option value="2030" @if(Request::get('tahun') == "2030") selected="selected" @endif>2030</option>



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

<!--begin::Table-->
<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered mt-5" style="width:100%">
<thead>
<tr>
<th><span class="text-dark-75">Tahun</span></th>
<th><span class="text-dark-75">Bulan</span></th>
<th><span class="text-dark-75">Nama Laporan Keuangan</span></th>
<th><span class="text-dark-75">Link Laporan Keuangan</span></th> 
<th style="min-width: 80px">Action</th> 
</tr>
</thead>
<tbody>
    @foreach($laporan as $lap)

<tr>
<td class="pl-3 py-3">{{$lap->laporankeuangan_tahun}}</td>
<td class="pl-3 py-3">{{$lap->laporankeuangan_bulan}}</td>
<td class="pl-3 py-3">{{$lap->laporankeuangan_nama}}</td>
<td class="pl-3 py-3"><a href="{{url($lap->laporankeuangan_link)}}">{{$lap->laporankeuangan_link}}</a></td>
 
<td>
    <a href="{{url('/laporankeuangan/edit/'.$lap->laporankeuangan_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/laporankeuangan/delete/'.$lap->laporankeuangan_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
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
        
        "paging":   true,
        "ordering": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
           });


                            </script>
@endsection
@endsection
