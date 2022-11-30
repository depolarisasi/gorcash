<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi</title>   
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
.table-border > table, th, td {
  border: 1px solid;
}
.table-border {   
    width: 100%;
}
.noborder { 
    border: none !important;
}  
.centered {
    text-align: center;
    align-content: center;
} 
img {
    max-width: inherit;
    width: inherit;
}
 
    
@page {
  size: A4; 
  margin: 30px;
}
    </style>
</head>
<body> 
        <table class="table-noborder">  
            <tr class="noborder"> 
                <td class="noborder" width="50%"><img src="{{asset('assets/media/logos/logo-light.png')}}" style="width: 140px !important; height: 70px; " alt="Logo" alt="Logo">  
                    <p>Jl. Guntursari Wetan No. 1, Kota Bandung - Phone : (022) 87328727</p></td>   
                <td class="noborder" width="50%">
                    <h1 style="float:right;">ABSENSI KARYAWAN</h1></td>    
            </tr>   
    </table>
         
       
        <br>
        <table class="table-noborder">  
                <tr class="noborder"> 
                    <td class="noborder" width="50%"><b>Nama Karyawan</b> : {{$selected_karyawan->karyawan_nama}}</td>  
        @php
        $time = \Carbon\Carbon::now()->diff($selected_karyawan->karyawan_tanggalbekerja);
        @endphp
                    <td class="noborder" width="50%"><b>Lama Bekerja </b> : Sejak {{\Carbon\Carbon::parse($selected_karyawan->karyawan_tanggalbekerja)->format('d M Y')}},  {{$time->y}} Tahun, {{$time->m}} Bulan, {{$time->d}} Hari</td>  
                    </tr>   
                    <tr class="noborder"> 
                    <td class="noborder" width="50%"><b>Jabatan </b> : {{$selected_karyawan->karyawan_jabatan}}</td>  
                    <td class="noborder" width="50%"><b>Nomor Induk Karyawan </b> : {{$selected_karyawan->karyawan_noinduk}}</td>  
                </tr>   
        </table>
             
        <br> 
        <table class="table-border">  
			<thead>
            <tr>   
					<th>TANGGAL</th>
					<th>JAM MASUK</th>
					<th>JAM PULANG</th>
					<th>LAMA KERJA</th>
					<th>LAMA LEMBUR</th>
					<th>TYPE KEHADIRAN</th>
					<th>KETERANGAN</th>
            </tr>   
			</thead>
			<tbody>
                
            @php
            $i = 1; 
            @endphp 
            @foreach($show as $e) 
            <tr> 
                    <td>{{\Carbon\Carbon::parse($e->absensi_tanggal)->format('d-m-Y')}}</td>
                    <td><span id="jammasuk{{$i}}" data-hari="{{$i}}" class="jammasuk">{{$e->absensi_jammasuk}}</span></td>
                    <td><span id="jampulang{{$i}}" data-hari="{{$i}}" class="jampulang">{{$e->absensi_jampulang}}</span></td> 
                    <td><span class="lamakerja"  data-tgl="{{$i}}" data-minute="{{$e->absensi_lamakerja}}"  id="textlamakerja{{$i}}">{{date('H \J\a\m i \M\e\n\i\t', mktime(0,$e->absensi_lamakerja))}}</span></td>
                    <td><span class="lamalembur"  data-tgl="{{$i}}" data-minute="{{$e->absensi_lembur}}" id="textlamalembur{{$i}}">{{date('H \J\a\m i \M\e\n\i\t', mktime(0,$e->absensi_lembur))}}</span></td>
                    <td>@if($e->absensi_type == 1) 
                        Masuk 
                        @elseif($e->absensi_type == 2)
                        Tidak Masuk
                        @elseif($e->absensi_type == 3)
                        Cuti
                        @elseif($e->absensi_type == 4)
                        Izin Sakit
                        @elseif($e->absensi_type == 5)
                        Izin Telat
                        @elseif($e->absensi_type == 6)
                        Tanpa Keterangan
                        @elseif($e->absensi_type == 7)
                        Libur 
                        @endif</td>
                    <td>{{$e->absensi_keterangan}}</td>
				</tr>
                @php
            $i = $i+1; 
            @endphp
                @endforeach 
            </tbody>
    </table>
       <br> 
      
         
</body>
</html>
