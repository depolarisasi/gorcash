<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Penjualan</title>
    <style>
* {
    font-size: 12px;
    font-family: 'Times New Roman';
}


td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 75px;
    max-width: 75px;
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.price,
th.price {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 58mm;
    max-width: 58mm;
    height: auto;
      display: block;
  margin: 0;
  padding: 0;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .ticket {
        width: 58mm;
    max-width: 58mm;
    height: auto;
  margin: 0;
  padding: 0;
    }
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
    </style>
</head>
<body>
    <div class="ticket">
        <br>
        <br>
        <br>
       <center> <img src="{{asset('assets/media/logos/logo-light.png')}}" style="width: 140px !important; height: 70px; " alt="Logo"></center>
        <p class="centered">GORILLA COACH </br>
            Jl. Guntursari Wetan No. 1 </br>
            Buah Batu - Jawa Barat </br>
           Phone : 0813-2159-3244   </br></p>

        <br>
            <p>
                Tanggal : {{$data[0]['penjualan_tanggalwaktupenjualan']}} </br>
                Invoice   :  {{$data[0]['penjualan_invoice']}}</br>
                Channel   : {{$data[0]['penjualan_channel']}}</br>
                Customer   : {{$data[0]['penjualan_customername']}} </br>
                Payment Type   :  {{$data[0]['penjualan_paymentype']}}</br>
            </p>

        <br>
        <table>
            <thead>
                <tr>
                    <th width="10%">Qty</th>
                    <th width="30%">Produk</th>
                    <th width="30%">Harga</th>
                    <th width="30%">Total (& Diskon)</th>
                </tr>
            </thead>
            <tbody>

                @foreach($data[2] as $b)
                <tr>
                    <td width="10%">{{$b['barangterjual_qty']}}</td>
                    <td width="30%">{{$b['product_sku']}} - {{$b['product_nama']}} ({{$b['size_nama']}})</td>
                    <td width="30%">@money($b['product_hargajual'])</td>
                    <td width="30%">
                        @if($b['barangterjual_diskon'] == 0 || is_null($b['barangterjual_diskon']))
                            @money($b['barangterjual_totalbarangterjual'])
                        @else
                        @money((int)$b['barangterjual_totalbarangterjual']-(int)$b['barangterjual_diskon'])
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <br> <br>
        <table>
            <thead>
                <tr>
                    <th>Potongan</th>
                    <th>Potongan</th>
                    <th>Potongan</th>
                    <th colspan="2">Total</th>
                </tr>
            </thead>
            <tbody>

                @foreach($data[1] as $p)
                <tr>
                    <td width="40%">{{$p['riwayatpotongan_namapotongan']}}</td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="40%">@money($p['riwayatpotongan_jumlahpotongan'])</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <br><br>
        <table>
            <tbody>
                <tr>
                    <td width="25%">Sub Total</td>
                    @php
                        $substotal = (int)$data[0]['penjualan_totalpenjualan'] - (int)$data[0]['penjualan_totalpotongan']
                    @endphp
                    <td width="75%"><span style="float:right;">@money((int)$data[0]['penjualan_totalpenjualan'])</span></td>
                </tr>
                <tr>
                    <td width="25%">Diskon & Potongan</td>
                    <td width="75%"><span style="float:right;">@money((int)$data[0]['penjualan_diskon'])</span></td>
                </tr>
                <tr>
                    <td width="25%">Total</td>
                    @php
                        $total = (int)$substotal - (int)$data[0]['penjualan_diskon']
                    @endphp
                    <td width="75%"><span style="float:right;">@money((int)$total)</span></td>
                </tr>
                <tr>
                    <td width="25%">Pembayaran</td>
                    <td width="75%"><span style="float:right;">@money($data[0]['penjualan_paymenttotal'])</span></td>
                </tr>
                <tr>
                    <td width="25%">Kembalian</td>
                    <td width="75%"><span style="float:right;">@money((int)$data[0]['penjualan_paymenttotal'] - (int)$total)</span></td>
                </tr>
            </tbody>
        </table>
        <p class="centered">Anda Berkesempatan mendapatkan <b>GIVEAWAY</b> apabila memberikan review dan bintang 5 di Google atau Marketplace Gorilla Coach.</p>
    </div>

  <script>
      window.print();
      </script>
</body>
</html>
