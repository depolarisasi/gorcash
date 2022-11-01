@extends('layouts.app')
@section('title','Detail Slip Gaji - ')
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
<span class="card-label font-weight-bolder text-dark">Detail Slip Gaji</span>
</h3>
<div class="card-toolbar">
<a href="{{url('slipgaji')}}" class="btn btn-primary btn-sm font-size-sm mr-3"><i class="fas fa-arrow-left"></i> Kembali</a>
<a href="{{url('slipgaji/print/{{$show->slipgaji_id')}}" class="btn btn-secondary btn-sm font-size-sm"><i class="fas fa-print"></i> Print</a>
<a href="{{url('slipgaji/pdf/{{$show->slipgaji_id')}}" class="btn btn-success btn-sm font-size-sm"><i class="fas fa-print"></i> Save PDF</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
<!--begin::Table--> 
<div class="container-fluid ticket">   
    <div class="row">
            <div class="col-6">
                <img src="{{asset('assets/media/logos/logo-light.png')}}" style="width: 140px !important; height: 70px; " alt="Logo" alt="Logo">  
                <p>Jl. Guntursari Wetan No. 1, Kota Bandung - Phone : (022) 87328727</p>
            </div>
            <div class="col-6">
                <h1 style="float:right;">SLIP GAJI KARYAWAN</h1>
            </div> 
        </div> 
    <br>
    <table class="table-noborder">  
            <tr class="noborder"> 
                <td class="noborder" width="50%"><b>Nama Karyawan</b> : {{$show->name}}</td>  
    @php
    $time = \Carbon\Carbon::now()->diff($show->karyawan_tanggalbekerja);
    @endphp
                <td class="noborder" width="50%"><b>Lama Bekerja </b> : Sejak {{\Carbon\Carbon::parse($show->karyawan_tanggalbekerja)->format('d M Y')}},  {{$time->y}} Tahun, {{$time->m}} Bulan, {{$time->d}} Hari</td>  
                </tr>   
                <tr class="noborder"> 
                <td class="noborder" width="50%"><b>Jabatan </b> : {{$show->karyawan_jabatan}}</td>  
                <td class="noborder" width="50%"><b>Nomor Induk Karyawan </b> : {{$show->karyawan_noinduk}}</td>  
            </tr>   
    </table>
         
    <br> 
    <div class="row g-0">
        <div class="col-6" >
            <table style="width: 100%;">
                <thead>
                    <tr style="border-width: 3px 0px 3px 0px; border-style: double;">
                        <th><span style="float:left;"><b>PENERIMAAN</b></span></th> 
                    </tr>
                </thead>
                <tbody> 
                    @php
                    $penerimaan = 0;
                    @endphp
                    @foreach($komponenpenerimaan as $kp)
                    <tr>
                        <td>{{$kp->gaji_komponen}}</td>
                        <td>Rp @money($kp->gaji_jumlah)</td>    
                    </tr>  
                    
                    @php
                    $penerimaan = $penerimaan+$kp->gaji_jumlah;
                    @endphp
                    @endforeach
                    <tr style="border-width: 1px 0px 3px 0px; border-style: double;">
                        <td>TOTAL PENERIMAAN</td>
                        <td>Rp @money($penerimaan)</td>    
                    </tr> 
                    <tr style="border-width: 1px 0px 3px 0px; border-style: double;">
                        <td>TAKE HOME PAY</td>
                        <td>Rp @money($show->slipgaji_thp)</td>    
                    </tr> 
                </tbody>
            </table>
        </div>
        <div class="col-6"> 
            <table style="width: 100%;">
                <thead >
                    <tr style="border-width: 3px 0px 3px 0px; border-style: double;">
                        <th><span style="float:left;"><b>POTONGAN</b></span></th> 
                    </tr>
                </thead>
                <tbody> 
                    @php
                    $potongan = 0;
                    @endphp
                    @foreach($komponenpotongan as $kp)
                    <tr>
                        <td>{{$kp->gaji_komponen}}</td>
                        <td>Rp @money($kp->gaji_jumlah)</td>    
                    </tr>  
                    
                    @php
                    $potongan = $potongan+$kp->gaji_jumlah;
                    @endphp
                    @endforeach
                    <tr style="border-width: 1px 0px 3px 0px; border-style: double;">
                        <td>TOTAL POTONGAN</td>
                        <td>Rp @money($potongan)</td>    
                    </tr> 
                </tbody>
            </table>
        </div>
    </div>
  
 <div class="row gt-0 mt-5">
    <div class="col-8">
        <p>Ditransfer Ke</p>
        <p>{{$show->karyawan_namabank}}</p>
        <p>Cabang : {{$show->karyawan_cabangbank}}</p>
        <p>Nomor Rekening {{$show->karyawan_norekbank}}</p>
        <p>Atas Nama : {{$show->karyawan_namarekbank}}</p>
    </div>
    <div class="col-4"> 
        <p style="float:right;">Bandung, {{\Carbon\Carbon::parse($show->slipgaji_tanggalgaji)->format('d M Y')}}</p>
        <div class="row gt-0 mt-5">
            <div class="col-6"> 
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th><span><b>Disetujui Oleh</b></span></th> 
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <td><br></td>  
                        </tr> 
                        
                        <tr>
                            <td><br></td>  
                        </tr> 
                        
                        <tr>
                            <td><br></td>  
                        </tr>
                        <tr>
                            <td>{{$show->slipgaji_ttd}}</td> 
                        </tr> 
                       
                    </tbody>
                </table>
            </div>
            <div class="col-6"> 
                
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th><span><b>Diterima Oleh</b></span></th> 
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <td><br></td>  
                        </tr> 
                        
                        <tr>
                            <td><br></td>  
                        </tr> 
                        
                        <tr>
                            <td><br></td>  
                        </tr>
                        <tr>
                            <td>{{$show->karyawan_nama}}</td> 
                        </tr> 
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>
    
</div>
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
       title: 'Yakin untuk menghapus akun ini ? ',
       text: 'SEMUA DATA mengenai akun ini akan dihapus dan tidak dapat dikembalikan!',
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
