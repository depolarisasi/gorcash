@extends('layouts.app')
@section('title','Laporan Absensi - ')
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
<span class="card-label font-weight-bolder text-dark">Laporan Absensi</span>
</h3>
<div class="card-toolbar">
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-8 col-xl-8">
                <form method="get" action="{{url('absensi/laporan')}}">
                <div class="row align-items-center">
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Bulan:</label>
                            <select class="form-control" name="bulan" id="bulan">
                                <option value="1"  @if($selected_month == "1" || \Carbon\Carbon::now()->format('m') == "1") selected="selected" @endif>Januari</option>
                                <option value="2"  @if($selected_month == "2" || \Carbon\Carbon::now()->format('m') == "2") selected="selected" @endif>Februari</option>
                                <option value="3"  @if($selected_month == "3" || \Carbon\Carbon::now()->format('m') == "3") selected="selected" @endif>Maret</option>
                                <option value="4"  @if($selected_month == "4" || \Carbon\Carbon::now()->format('m') == "4") selected="selected" @endif>April</option>
                                <option value="5"  @if($selected_month == "5" || \Carbon\Carbon::now()->format('m') == "5") selected="selected" @endif>Mei</option>
                                <option value="6"  @if($selected_month == "6" || \Carbon\Carbon::now()->format('m') == "6") selected="selected" @endif>Juni</option>
                                <option value="7"  @if($selected_month == "7" || \Carbon\Carbon::now()->format('m') == "7") selected="selected" @endif>Juli</option>
                                <option value="8"  @if($selected_month == "8" || \Carbon\Carbon::now()->format('m') == "8") selected="selected" @endif>Agustus</option>
                                <option value="9"  @if($selected_month == "9" || \Carbon\Carbon::now()->format('m') == "9") selected="selected" @endif>September</option>
                                <option value="10"  @if($selected_month == "10" || \Carbon\Carbon::now()->format('m') == "10") selected="selected" @endif>Oktober</option>
                                <option value="11"  @if($selected_month == "11" || \Carbon\Carbon::now()->format('m') == "11") selected="selected" @endif>November</option>
                                <option value="12"  @if($selected_month == "12" || \Carbon\Carbon::now()->format('m') == "12") selected="selected" @endif>Desember</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="d-flex align-items-center">
                            <label class="mr-3 mb-0 d-none d-md-block">Tahun:</label>
                            <select class="form-control" name="tahun" id="band">
                                <option value="2022" @if($selected_year == "2022") selected="selected" @endif>2022</option>
                                <option value="2023" @if($selected_year == "2023") selected="selected" @endif>2023</option>
                                <option value="2024" @if($selected_year == "2024") selected="selected" @endif>2024</option>
                                <option value="2025" @if($selected_year == "2025") selected="selected" @endif>2025</option>
                                <option value="2026" @if($selected_year == "2026") selected="selected" @endif>2026</option>
                                <option value="2027" @if($selected_year == "2027") selected="selected" @endif>2027</option>
                                <option value="2028" @if($selected_year == "2028") selected="selected" @endif>2028</option>
                                <option value="2029" @if($selected_year == "2029") selected="selected" @endif>2029</option>
                                <option value="2030" @if($selected_year == "2030") selected="selected" @endif>2030</option>



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
<th><span class="text-dark-75">Nama Karyawan</span></th>
<th><span class="text-dark-75">Kehadiran</span></th>
<th><span class="text-dark-75">Libur</span></th>
<th><span class="text-dark-75">Cuti</span></th>
<th><span class="text-dark-75">Izin Sakit</span></th>
<th><span class="text-dark-75">Izin Terlambat</span></th>
<th><span class="text-dark-75">Tanpa Keterangan</span></th>
<th><span class="text-dark-75">Tidak Hadir</span></th>
<th><span class="text-dark-75">Jam Lembur</span></th>
</tr>
</thead>
<tbody>
    @foreach($laporan as $laporan)
<tr>
<td class="pl-3 py-3">{{$laporan->karyawan_nama}}</td>
<td class="pl-3 py-3">{{(int) $laporan->hadir}} Hari</td>
<td class="pl-3 py-3">{{(int) $laporan->libur}} Hari</td>
<td class="pl-3 py-3">{{(int) $laporan->cuti}} Hari</td>
<td class="pl-3 py-3">{{(int) $laporan->izinsakit}} Hari</td>
<td class="pl-3 py-3">{{(int) $laporan->izintelat}} Hari</td>
<td class="pl-3 py-3">{{(int) $laporan->tanpaketerangan}} Hari</td>
<td class="pl-3 py-3">{{(int) $laporan->tidakhadir}} Hari</td>
<td class="pl-3 py-3">{{number_format((float)$laporan->lamalembur/60, 0, '.', '')}} Jam</td>

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
        document.getElementById('textlamalembur'+id).innerHTML = jamlembur+" Jam, " + menitlembur +" Menit";

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
