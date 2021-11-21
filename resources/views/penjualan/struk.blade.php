<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Penjualan</title>
    <style>
#invoice-POS {
  padding: 2mm;
  margin: 0 auto;
  width: 58mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: 0.9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: 0.7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 40px;
  width: 70px;
  background: url({{asset($logo)}}) no-repeat;
  background-size: 70px 40px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: 0.5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: 0.5em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}
    </style>
</head>
<body>
    
  <div id="invoice-POS">
    <center id="top">
      <center>
          <img src="{{asset($logo)}}" width="70px;" height="40px;">
      </center>
      <div class="info"> 
       {{$header}}
        </p>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Struk Penjualan</h2>
        <p> 
            Tanggal : {{$penjualan->penjualan_tanggalpenjualan}} </br>
            Invoice   :  {{$penjualan->penjualan_invoice}}</br>
            Channel   : {{$penjualan->penjualan_channel}}</br>
            Customer   : {{$penjualan->penjualan_customername}} </br>
            Payment Type   :  {{$penjualan->penjualan_paymentype}}</br>
            Payment Total   : {{$penjualan->penjualan_paymenttotal}}  </br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

					<div id="table">
						<table>
							<tr class="tabletitle">
								<td class="item"><h2>Item</h2></td>
								<td class="Hours"><h2>Qty</h2></td>
								<td class="Hours"><h2>Price</h2></td>
								<td class="Rate"><h2>Sub Total</h2></td>
							</tr>

                            @foreach($barangterjual as $b)
                            <tr class="font-weight-boldest">
                                <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                    <p class="itemtext"> {{$b->product_sku}} - {{$b->product_nama}} ({{$b->size_nama}}) </p></td>
                                <td class="text-right pt-7 align-middle"><p class="itemtext">{{$b->barangterjual_qty}}</p></td>
                                <td class="text-right pt-7 align-middle"><p class="itemtext">@money($b->product_hargajual)</p></td>
                                <td class="text-primary pr-0 pt-7 text-right align-middle"><p class="itemtext">@money($b->barangterjual_totalbarangterjual)</p></td>
                            </tr>
                            @endforeach

		

				 
							<tr class="tabletitle">
                                <td class="item"><h2>Potongan</h2></td>
								<td class="Hours"></td>
								<td class="Hours"></td>
								<td class="Rate"><h2>Sub Total</h2></td>
							</tr>
                            @foreach($potongan as $p)
                            <tr class="service">
								<td class="tableitem"><p class="itemtext">{{$p->riwayatpotongan_namapotongan}}</p></td>
								<td class="tableitem"><p class="itemtext"></p></td>
								<td class="tableitem"><p class="itemtext">@money($p->riwayatpotongan_jumlahpotongan)</p></td>
							</tr>  
                            @endforeach

                           

							<tr class="tabletitle">
								<td></td>
								<td></td>
								<td class="Rate"><h2>Total</h2></td>
								<td class="payment"><h2>@money($penjualan->penjualan_totalpenjualan - ($penjualan->penjualan_totalpotongan?$penjualan->penjualan_totalpotongan:0))</h2></td>
							</tr>

						</table>
					</div><!--End Table-->

					<div id="legalcopy">
						<center><p class="legal">Anda Berkesempatan mendapatkan <b>GIVEAWAY</b> apabila memberikan review dan bintang 5 di Google atau Marketplace Gorilla Coach. 
						</p></center>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->    
  <script>
      window.print();
      </script>
</body>
</html>