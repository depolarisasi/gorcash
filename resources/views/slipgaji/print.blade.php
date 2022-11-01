<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


    <style> 
* {
    font-size: 12px;
    font-family: 'Calibri';
}

h1 {
    font-size: 2em; 
    font-weight: bolder !important;
} 
 
.table-noborder { 
    border: none !important;
    width: 100%;
}
.noborder { 
    border: none !important;
}  
.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 210mm;
    height: 297mm;
      display: block;
  margin: 30px;
  padding: 0;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .ticket {
    width: 210mm;
    height: 297mm; 
  margin: 30px;
  margin: 0;
    }
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
    .container {
    width:100% !important;
  }
} 
 
    
@page {
  size: A4; 
  margin: 30px;
}
    </style>
</head>
<body>
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

  <script>
      window.print();
      </script>
</body>
</html>
