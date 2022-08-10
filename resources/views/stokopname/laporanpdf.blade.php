
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Laporan Stok Opname</title>
    <style>
        .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;
  height: 29.7cm;
  margin: 0 auto;
  color: #001028;
  background: #FFFFFF;
  font-family: Arial, sans-serif;
  font-size: 12px;
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
        </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{asset('assets/media/logos/logo-light.png')}}">
      </div>
      <h1>Laporan Stok Opname @if($data[0]['so_type'] = 1) Mingguan @else Bulanan @endif</h1>

      <div id="project">
        <div><span>PUBLISH ID</span> {{$data[0]['so_pubgroupname']}}</div>
        <div><span>TANGGAL PEMERIKSAAN</span> {{\Carbon\Carbon::parse($data[0]['so_date'])->format('d-m-Y')}}</div>
        <div><span>PEMERIKSA</span> {{$data[0]['name']}}</div>
        <div><span>JUMLAH PRODUK</span> {{$data[0]['productcount']}}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>Master SKU</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>SKU</th>
            <th>Stok Awal</th>
            <th>Stok Terakhir</th>
            <th>Stok Ril</th>
            <th>Selisih Stok</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data[1] as $p)
            <tr>
                <td>{{$p['product_sku']}}</td>
    <td>{{$p['product_nama']}}</td>
    <td>Rp @money($p->product_hargajual)</td>
    <td>{{$p['size_nama']}}</td>
    <td>{{$p['so_stok']}} </td>
    <td>{{$p['so_stokterjual']}}</td>
    <td>{{(int)$p['so_stok'] - (int)$p['so_stokterjual']}}</td>
    <td>{{$p['so_stokakhirreal']}}</td>
    <td>{{$p['so_selisih']}}</td>
    <td>{{$p['so_keterangan']}}</td>
            </tr>
            @endforeach

        </tbody>
      </table>

    </main>
    <footer>

    </footer>
  </body>
</html>

