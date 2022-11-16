<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Informasi Karyawan</title>

<style type="text/css">
    * {
        font-family: Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    
 
    
@page {
  size: A4; 
  margin: 30px;
}
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"> <img src="{{asset('assets/media/logos/logo-light.png')}}" style="width: 140px !important; height: 70px; " alt="Logo" alt="Logo">  </td>
        <td align="right">
            <h1>Informasi Karyawan Gorilla Coach</h1> 
        </td>
    </tr>

  </table> 

  <br/>

  <table width="100%"> 
    <tbody>
      <tr> 
        <td width="30%" style="padding-right: 30px;">
            @if(!is_null($show))
            @if(!is_null($show->karyawan_foto))
    <img src="{{asset($show->karyawan_foto)}}" width="150" height="175">
    @else
    <img src="{{asset('/foto/no-profile.png')}}" width="150" height="175">
    @endif
    @endif</td>
        <td align="left">
            <h2>{{$show->karyawan_nama}}</h2>
            @php
            $time = \Carbon\Carbon::now()->diff($show->karyawan_tanggalbekerja);
            @endphp
            <p><b>Tanggal Pertama Bekerja : </b> {{$show->karyawan_tanggalbekerja}},  {{$time->y}} Tahun, {{$time->m}} Bulan, {{$time->d}} Hari</p>
            <p><b>Jabatan : </b> {{$show->karyawan_jabatan}}</p>
            <p><b>Nomor Induk Karyawan : </b> {{$show->karyawan_noinduk}}</p></td> 
      </tr> 
    </tbody>
 
  </table>
  
  <table width="100%"> 
    <tbody>
      <tr>  
        <td width="20%"><p>Kewarganegaraan</p></td>  
        <td><p>{{$show->karyawan_kewarganegaraan}}</p></td> 
      </tr> 
      <tr>  
        <td width="20%"><p>NIK</p></td>  
        <td><p>{{$show->karyawan_nik}}</p></td> 
      </tr> 
      <tr>  
        <td width="20%"><p>Jenis Kelamin</p></td>  
        <td><p>{{$show->karyawan_kelamin}}</p></td> 
      </tr> 
      <tr>  
        <td width="20%"><p>Tempat Tanggal Lahir</p></td>  
        <td><p>{{$show->karyawan_tempatlahir}}, {{$show->karyawan_tanggallahir}}</p></td> 
      </tr>  
      <tr>  
        <td width="20%"><p>Agama</p></td>  
        <td><p>{{$show->karyawan_agama}}</p></td> 
      </tr> 
      <tr>  
        <td width="20%"><p>No BPJS</p></td>  
        <td><p>{{$show->karyawan_tempatlahir}}, {{$show->karyawan_tanggallahir}}</p></td> 
      </tr>  
      <tr>  
        <td width="20%"><p>Status Perkawinan</p></td>  
        <td><p>{{$show->karyawan_status}} </p></td>   
      </tr> 
      <tr>  
        <td width="20%"><p>No HP</p></td>  
        <td><p>{{$show->karyawan_nohp}}</p></td> 
      </tr>
      <tr>  
        <td width="20%"><p>Email</p></td>  
        <td><p>{{$show->karyawan_email}}</p></td> 
      </tr>
      <tr>  
        <td width="20%"><p>Alamat Sekarang</p></td>  
        <td><p>{{$show->karyawan_alamatsekarang}}, {{$show->karyawan_kotasekarang}}, {{$show->karyawan_provinsisekarang}}</p></td>
        </td>   
      </tr> 
      <tr>  
        <td width="20%"><p>Alamat KTP</p></td>  
        <td><p>{{$show->karyawan_alamatktp}}, {{$show->karyawan_kotaktp}}, {{$show->karyawan_provinsiktp}}</p></td>
        </td>   
      </tr> 
      <tr>  
        <td width="20%"><p>Rekening</p></td>  
        <td> <p>{{$show->karyawan_namabank}}, {{$show->karyawan_cabangbank}}, {{$show->karyawan_norekbank}}, {{$show->karyawan_namarekbank}}</p></td>  </td>   
      </tr> 
        <tr>
            <td> <p><b>Pendidikan Terakhir </b></p></td>
            <td><p>{{$show->karyawan_pendidikanterakhir}}</p></td>
        </tr> 
        @if(!is_null($show->karyawan_pendidikan1))
        <tr><td>
            <p><b>Pendidikan 1 </b></p>
        </td>
        <td><p>{{$show->karyawan_pendidikan1}}</p></td>
        </tr>
        <tr><td>
            <p><b>Jurusan Pendidikan 1 </b></p>
        </td>
        <td><p>{{$show->karyawan_jurusanpendidikan1}}</p></td>
    </tr><tr><td>
            <p><b>Tahun Pendidikan 1 </b></p>
        </td>
        <td><p>{{$show->karyawan_tahunpendidikan1}}</p></td>
    </tr>
    <tr><td>  <p><b>Kualifikasi Pendidikan 1 </b></p> </td>
        <td><p>{{$show->karyawan_kualifikasipendidikan1}}</p></td>
    </tr>
        @endif
    
        @if(!is_null($show->karyawan_pendidikan2))
        <tr>
            <td><p><b>Pendidikan 2 </b></p></td>
            <td><p>{{$show->karyawan_pendidikan2}}</p></td>
        </tr>
        <tr>
            <td><p><b>Jurusan Pendidikan 2 </b></p></td>
        <td><p>{{$show->karyawan_jurusanpendidikan2}}</p></td>
        </tr>
        <tr>
            <td><p><b>Tahun Pendidikan 2 </b></p></td>
        <td><p>{{$show->karyawan_tahunpendidikan2}}</p></td>
        </tr>
     <tr>
        <td><p><b>Kualifikasi Pendidikan 2 </b></p></td>
        <td><p>{{$show->karyawan_kualifikasipendidikan2}}</p></td>
    </tr>
        @endif 
    
    @if(!is_null($show->karyawan_bahasa1))
     
    <tr>
        <td><p><b>Bahasa 1</b></p></td>
        <td>{{$show->karyawan_bahasa1}}</td> 
    </tr>
    <tr>
        <td><p><b>Membaca</b></p></td>
        <td>{{$show->karyawan_membacabahasa1}}</td>
    </tr>
        <tr>
        <td><p><b>Berbicara</b></p></td>
        <td>{{$show->karyawan_berbicarabahasa1}} </td>
    </tr>
    <tr>
        <td>
    <p><b>Mendengar</b></p></td>
    <td>{{$show->karyawan_mendengarbahasa1}}
    </td></tr>
    
    <tr>
        <td>
    <p><b>Menulis</b></p></td>
    <td>{{$show->karyawan_menulisbahasa1}}
    </td> </tr>
    @endif
    @if(!is_null($show->karyawan_bahasa2))
     
    <tr>
        <td><p><b>Bahasa 2</b></p></td>
        <td>{{$show->karyawan_bahasa2}}</td> 
    </tr>
    <tr>
        <td><p><b>Membaca</b></p></td>
        <td>{{$show->karyawan_membacabahasa2}}</td>
    </tr>
        <tr>
        <td><p><b>Berbicara</b></p></td>
        <td>{{$show->karyawan_berbicarabahasa2}} </td>
    </tr>
    <tr>
        <td>
    <p><b>Mendengar</b></p></td>
    <td>{{$show->karyawan_mendengarbahasa2}}
    </td></tr>
    
    <tr>
        <td>
    <p><b>Menulis</b></p></td>
    <td>{{$show->karyawan_menulisbahasa2}}
    </td> </tr>
    @endif
     
    @if(!is_null($show->karyawan_employment1))
    
    <tr>
        <td><p><b>Riwayat Kerja 1</b></p></td>
        <td>{{$show->karyawan_employment1}}</td> 
    </tr>
    
    
    <tr>
        <td><p><b>Periode</b></p></td>
        <td>{{$show->karyawan_employmentperiode1}}
    </td> </tr>
    
    <tr>
        <td><p><b>Jabatan</b></p></td>
        <td>{{$show->karyawan_employmentjabatan1}}
    </td> </tr>
    
    <tr>
        <td><p><b>Gaji</b></p></td>
        <td>{{$show->karyawan_employmentgaji1}}
    </td> </tr> 
    @endif
    @if(!is_null($show->karyawan_employment2))
    <tr>
        <td><p><b>Riwayat Kerja 2</b></p></td>
        <td>{{$show->karyawan_employment2}}</td> 
    </tr>
    
    
    <tr>
        <td><p><b>Periode</b></p></td>
        <td>{{$show->karyawan_employmentperiode2}}
    </td> </tr>
    
    <tr>
        <td><p><b>Jabatan</b></p></td>
        <td>{{$show->karyawan_employmentjabatan2}}
    </td> </tr>
    
    <tr>
        <td><p><b>Gaji</b></p></td>
        <td>{{$show->karyawan_employmentgaji2}}
    </td> </tr> 
    @endif  
        <tr><td>
            <p><b>Cacat</b></p>
        </td>
        <td><p>{{$show->karyawan_cacat}}</p></td>
    </tr><tr><td>
            <p><b>Merokok </b></p>
        </td>
        <td><p>{{$show->karyawan_merokok}}</p></td>
    </tr><tr><td>
            <p><b>Tidak Bisa Bekerja Di Hari </b></p>
        </td>
        <td><p>{{$show->karyawan_haritertentu}}</p></td>
    </tr><tr><td>
            <p><b>Jenis SIM </b></p>
        </td>
        <td><p>{{$show->karyawan_jenissim}}</p></td>
    </tr><tr><td>
            <p><b>Masa Berlaku SIM </b></p>
        </td>
        <td><p>{{$show->karyawan_berlakusim}}</p></td>
    </tr><tr><td>
            <p><b>Pernah Diberhentikan </b></p>
        </td>
        <td><p>{{$show->karyawan_pernahdiberhentikan}}</p></td>
    </tr><tr><td>
            <p><b>Pernah Dihukum </b></p>
        </td>
        <td><p>{{$show->karyawan_pernahdihukum}}</p></td>
    </tr><tr><td>
            <p><b>Nama Ayah </b></p>
        </td>
        <td><p>{{$show->karyawan_namaayah}}</p></td>
    </tr><tr><td>
            <p><b>Alamat Ayah </b></p>
        </td>
        <td><p>{{$show->karyawan_alamatayah}}</p></td>
    </tr><tr><td>
            <p><b>Telp Ayah </b></p>
        </td>
        <td><p>{{$show->karyawan_telpayah}}</p></td>
    </tr><tr><td>
            <p><b>Nama Ibu</b></p>
        </td>
        <td><p>{{$show->karyawan_namaibu}}</p></td>
    </tr><tr><td>
            <p><b>Alamat Ibu</b></p>
        </td>
        <td><p>{{$show->karyawan_alamatibu}}</p></td>
    </tr><tr><td>
            <p><b>Telp Ibu</b></p>
        </td>
        <td><p>{{$show->karyawan_telpibu}}</p></td>
        </div>
        <tr><td>
            <p><b>Nama Saudara</b></p>
        </td>
        <td><p>{{$show->karyawan_namasdr}}</p></td>
        </div>
        <tr><td>
            <p><b>Telp Saudara</b></p>
        </td>
        <td><p>{{$show->karyawan_telpsdr}}</p></td>
        </div>
        <tr><td>
            <p><b>Alamat Saudara</b></p>
        </td>
        <td><p>{{$show->karyawan_alamatsdr}}</p></td>
    </tr><tr><td>
            <p><b>Nama Kontak Darurat </b> </p>
        </td>
        <td><p>{{$show->karyawan_kontakdrt1}}</p></td>
        </div>
        <tr><td>
            <p><b>Telp Kontak Darurat </b></p>
        </td>
        <td><p>{{$show->karyawan_nokontakdrt1}}</p></td>
        </div>
    
    
        <tr><td>
            <p><b>KTP Karyawan</b></p>
        </td>
        @if($show->karyawan_foto)
    <img src="{{asset($show->karyawan_fotoktp)}}" width="400" height="200">
    @else
    <img src="#" class="img-fluid">
    @endif
        </div>
    </tbody>
 
  </table>

</body>
</html>   