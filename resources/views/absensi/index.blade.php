@extends('layouts.app')
@section('title','Absensi - ')
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
<span class="card-label font-weight-bolder text-dark">Daftar Absensi</span>
</h3>
<div class="card-toolbar">
    @if(Auth::user()->role == 1)
    <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#kirpaket">
       Tambah Absensi
    </button>
    <a href="{{url('absensi/laporan')}}" class="btn btn-secondary">Laporan Absensi</a>
@endif
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-8 col-xl-8">
                <form method="get" action="{{url('absensi')}}">
                <div class="row align-items-center">
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Bulan:</label>
                            <select class="form-control" name="bulan" id="bulan">
                                <option value="1"  @if(Request::get('bulan') == "1" || \Carbon\Carbon::now()->format('m') == "1") selected="selected" @endif>Januari</option>
                                <option value="2"  @if(Request::get('bulan') == "2" || \Carbon\Carbon::now()->format('m') == "2") selected="selected" @endif>Februari</option>
                                <option value="3"  @if(Request::get('bulan') == "3" || \Carbon\Carbon::now()->format('m') == "3") selected="selected" @endif>Maret</option>
                                <option value="4"  @if(Request::get('bulan') == "4" || \Carbon\Carbon::now()->format('m') == "4") selected="selected" @endif>April</option>
                                <option value="5"  @if(Request::get('bulan') == "5" || \Carbon\Carbon::now()->format('m') == "5") selected="selected" @endif>Mei</option>
                                <option value="6"  @if(Request::get('bulan') == "6" || \Carbon\Carbon::now()->format('m') == "6") selected="selected" @endif>Juni</option>
                                <option value="7"  @if(Request::get('bulan') == "7" || \Carbon\Carbon::now()->format('m') == "7") selected="selected" @endif>Juli</option>
                                <option value="8"  @if(Request::get('bulan') == "8" || \Carbon\Carbon::now()->format('m') == "8") selected="selected" @endif>Agustus</option>
                                <option value="9"  @if(Request::get('bulan') == "9" || \Carbon\Carbon::now()->format('m') == "9") selected="selected" @endif>Desember</option>
                                <option value="10"  @if(Request::get('bulan') == "10" || \Carbon\Carbon::now()->format('m') == "10") selected="selected" @endif>Oktober</option>
                                <option value="11"  @if(Request::get('bulan') == "11" || \Carbon\Carbon::now()->format('m') == "11") selected="selected" @endif>November</option>
                                <option value="12"  @if(Request::get('bulan') == "12" || \Carbon\Carbon::now()->format('m') == "12") selected="selected" @endif>Desember</option>

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

<div class="modal fade" id="kirpaket" tabindex="-1" role="dialog" aria-labelledby="kirpaketLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kirpaketLabel">Kirim Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            <form method="get" action="{{url('absensi/new')}}">
        @csrf
          <div class="form-group row mt-4">
            <label class="col-md-4">Bulan Absen</label>
            <div class="col-md-6">
                <select class="form-control" name="bulan_selected">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">Desember</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>

            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">Bulan Absen</label>
            <div class="col-md-6">
                <select class="form-control" name="tahun_selected">
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
            </select>

            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">Karyawan</label>
            <div class="col-md-6">
            <select class="form-control" id="waktu" name="absensi_karyawanid">
                @foreach($karyawan as $k)
             <option value="{{$k->karyawan_id}}">{{$k->karyawan_nama}}</option>
             @endforeach
              </select>
            </div>
          </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Submit</button>
        </div>
    </div>

      </form>
            </div>
        </div>
    </div>
</div>
<!--begin::Table-->
<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered mt-5" style="width:100%">
<thead>
<tr>
<th><span class="text-dark-75">Nama Karyawan</span></th>
<th><span class="text-dark-75">Jumlah Kehadiran</span></th>
@if(Auth::user()->role == 1)
<th style="min-width: 80px">Action</th>
@endif
</tr>
</thead>
<tbody>
    @foreach($absensi as $absensi)
<tr>
<td class="pl-3 py-3">{{$absensi->karyawan_nama}}</td>
<td class="pl-3 py-3">{{(int) $absensi->harikerja-$absensi->tidakhadir}} / {{$absensi->harikerja}}</td>

@if(Auth::user()->role == 1)
<td>
<a href="{{url('/absensi/detail/?bulan='.$absensi->month.'&tahun='.$absensi->year.'&karyawan='.$absensi->karyawan_id)}}" class="btn btn-icon btn-xs btn-primary"><i class="fas fa-info-circle nopadding"></i></a>
    <a href="{{url('/absensi/edit/?bulan='.$absensi->month.'&tahun='.$absensi->year.'&karyawan='.$absensi->karyawan_id)}}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-edit nopadding"></i></a>
    <button type="button" href="{{url('/absensi/delete/?bulan='.$absensi->month.'&tahun='.$absensi->year.'&karyawan='.$absensi->karyawan_id)}}" class="deletebtn btn btn-xs btn-icon btn-danger"><i class="fas fa-trash nopadding"></i></button></td>
</td>
@endif
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
        search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
        "paging":   true,
        "ordering": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
           });


                            </script>
@endsection
@endsection
