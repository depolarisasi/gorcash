<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji</title>
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
                    <h1 style="float:right; text-transform: uppercase;">SLIP GAJI KARYAWAN {{$show->slipgaji_bulan}} {{$show->slipgaji_tahun}}</h1></td>
            </tr>
    </table>


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
        <table class="table-border">
            <tr>
                <td width="50%">
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th><span><b>PENERIMAAN</b></span></th>
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
                            <tr>
                                <td>TOTAL PENERIMAAN</td>
                                <td>Rp @money($penerimaan)</td>
                            </tr>
                            <tr>
                                <td>TAKE HOME PAY</td>
                                <td>Rp @money($show->slipgaji_thp)</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%">
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th><span><b>POTONGAN</b></span></th>
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
                            <tr>
                                <td>TOTAL POTONGAN</td>
                                <td>Rp @money($potongan)</td>
                            </tr>
                        </tbody>
                    </table>
                   </td>
            </tr>
    </table>
       <br>
       <table class="table-noborder">
        <tr class="noborder">
            <td class="noborder" width="50%">
                <p>Ditransfer Ke</p>
                <p>{{$show->karyawan_namabank}}</p>
                <p>Cabang : {{$show->karyawan_cabangbank}}</p>
                <p>Nomor Rekening {{$show->karyawan_norekbank}}</p>
                <p>Atas Nama : {{$show->karyawan_namarekbank}}</p>
            </td>
            <td class="noborder" width="50%">
                <p style="float:right;">Bandung, {{\Carbon\Carbon::parse($show->slipgaji_tanggalgaji)->format('d M Y')}}</p>

                &nbsp; <img src="{{asset('assets/capdanttd.png')}}" style="width: 225px; z-index: -999; margin-bottom: -150px;">
            <table class="table-noborder" style="text-align: right;">
                <tr class="noborder">
                    <td class="noborder" width="50%"><table style="width: 100%;">
                        <thead>
                            <tr class="noborder">
                                <th  class="noborder"><span><b>Disetujui Oleh</b></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="noborder"><br><br></td>
                            </tr>

                            <tr>
                                <td class="noborder"><br><br></td>
                            </tr>

                            <tr>
                                <td class="noborder"><br><br></td>
                            </tr>
                            <tr>
                                <td class="noborder" style="text-align: right;">{{$show->slipgaji_ttd}}</td>
                            </tr>

                        </tbody>
                    </table></td>
                    <td class="noborder" width="50%">
                        <table class="noborder" style="width: 100%;">
                            <thead>
                                <tr class="noborder">
                                    <th  class="noborder"><span><b>Diterima Oleh</b></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="noborder"><br><br></td>
                                </tr>

                                <tr>
                                    <td class="noborder"><br><br></td>
                                </tr>

                                <tr>
                                    <td class="noborder"><br><br></td>
                                </tr>
                                <tr>
                                    <td class="noborder" style="text-align: right;">{{$show->karyawan_nama}}</td>
                                </tr>

                            </tbody>
                        </table></td>
                </tr>
        </table>
           </td>
        </tr>
</table>


</body>
</html>
