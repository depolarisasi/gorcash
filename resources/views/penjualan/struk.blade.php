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
                Tanggal : {{$penjualan->penjualan_tanggalpenjualan}} </br>
                Invoice   :  {{$penjualan->penjualan_invoice}}</br>
                Channel   : {{$penjualan->penjualan_channel}}</br>
                Customer   : {{$penjualan->penjualan_customername}} </br>
                Payment Type   :  {{$penjualan->penjualan_paymentype}}</br>
            </p>
            
        <br>
        <table>
            <thead>
                <tr>
                    <th width="10%">Qty</th>
                    <th width="30%">Produk</th>
                    <th width="30%">Harga</th>
                    <th width="30%">Total</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($barangterjual as $b)
                <tr>
                    <td width="1    0%">{{$b->barangterjual_qty}}</td>
                    <td width="30%">{{$b->product_sku}} - {{$b->product_nama}} ({{$b->size_nama}})</td>
                    <td width="30%">@money($b->product_hargajual)</td>
                    <td width="30%">@money($b->barangterjual_totalbarangterjual)</td>
                </tr>
                @endforeach
              
            </tbody>
        </table>
        <br> <br>
        <table>
            <thead>
                <tr>
                    <th width="50%">Potongan</th>
                    <th width="50%">Total</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($daftarpotongan as $p)
                <tr>
                    <td width="50%">{{$p->riwayatpotongan_namapotongan}}</td>
                    <td width="50%">@money($p->riwayatpotongan_jumlahpotongan)</td>
                </tr>
                @endforeach
              
            </tbody>
        </table>
        <br><br>
        <table>
            <tbody>
                <tr>
                    <td width="25%">Total</td>
                    <td width="75%"><span style="float:right;">@money((int)$penjualan->penjualan_totalpenjualan - (int)$penjualan->penjualan_totalpotongan)</span></td>
                </tr>
                <tr>
                    <td width="25%">Pembayaran</td>
                    <td width="75%"><span style="float:right;">@money($penjualan->penjualan_paymenttotal)</span></td>
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