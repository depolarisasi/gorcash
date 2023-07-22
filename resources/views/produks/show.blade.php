@extends('layouts.app')
@section('title','Detail Produk - ')
@section('css')
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
	<!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class=" container ">
<!--begin::Dashboard-->

<!--begin::Row-->
<div class="row">

<div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <!--begin::Card Body-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Detail Produk</span>
                </h3>
                <div class="card-toolbar">
                <a href="{{url('produk/select/'.$show->product_mastersku)}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                </div>
            <!--end::Card Body-->
        </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-custom gutter-b">
                <!--begin::Card Body-->
                <div class="card-body">
                   <img src="{{asset($show->product_foto?$show->product_foto:"/assets/nopicture.png")}}" class="img-fluid img-responsive">
                    </div>
                <!--end::Card Body-->
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-custom  gutter-b">
            <!--begin::Card Body-->
            <div class="card-body">
                <h3 class="font-weight-bolder font-size-h2 mb-1">
                    <a href="#" class="text-dark-75">{{$show->product_nama}}</a>
                </h3>

                @if(Auth::user()->role == 1 || Auth::user()->role == 6)<div class="text-primary font-size-h4">Harga Beli Rp {{$show->product_hargabeli}}</div>@endif
                <div class="text-primary font-size-h4">Harga Jual Rp {{$show->product_hargajual}}</div>
                @if(Auth::user()->role == 1)<div class="text-primary font-size-h4 mb-9">Profit Rp {{$show->product_hargajual-$show->product_hargabeli}}</div>@endif
                <!--begin::Info-->
                <div class="d-flex mb-3">
                    <span class="text-dark-50 flex-root font-weight-bold">Master SKU</span>
                    <span class="text-dark flex-root font-weight-bold">{{$show->product_mastersku}}</span>
                </div>
                <div class="d-flex mb-3">
                    <span class="text-dark-50 flex-root font-weight-bold">SKU</span>
                    <span class="text-dark flex-root font-weight-bold">{{$show->product_sku}}</span>
                </div>
                <div class="d-flex mb-3">
                    <span class="text-dark-50 flex-root font-weight-bold">Size</span>
                    <span class="text-dark flex-root font-weight-bold">{{$show->size_nama}}</span>
                </div>
                <div class="d-flex mb-3">
                    <span class="text-dark-50 flex-root font-weight-bold">Band</span>
                    <span class="text-dark flex-root font-weight-bold">{{$show->band_nama}}</span>
                </div>

                @if(Auth::user()->role ==  1)
                <div class="d-flex mb-3">
                    <span class="text-dark-50 flex-root font-weight-bold">Vendor</span>
                    <span class="text-dark flex-root font-weight-bold">{{$show->product_vendor}}</span>
                </div>
                @endif
                <div class="d-flex mb-3">
                    <span class="text-dark-50 flex-root font-weight-bold">Stok Awal</span>
                    <span class="text-dark flex-root font-weight-bold">{{$show->product_stok}}</span>
                </div>
                <div class="d-flex mb-3">
                    <span class="text-dark-50 flex-root font-weight-bold">Stok Akhir</span>
                    <span class="text-dark flex-root font-weight-bold">{{$show->product_stokakhir}}</span>
                </div>
                <!--end::Info-->
            </div>
            <!--end::Card Body-->
        </div></div>
    </div>


<!--begin::Advance Table Widget 4-->
<div class="card card-custom gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Riwayat Penjualan Produk (Keluar)</span>
</h3>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="product">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Channel</th>
                        <th>Total Penjualan</th>
                        <th>Total Diskon</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($barangterjual as $b)
                    <tr>
                        <td>{{$b->barangterjual_tanggalwaktubarangterjual}}</td>
                        <td>{{$b->product_sku}} - {{$b->product_nama}}</td>
                        <td>{{$b->penjualan_channel}}</td>
                        <td>@money($b->barangterjual_totalbarangterjual)</td>
                        <td>@money($b->barangterjual_diskon)</td>
                        <td>@money($b->barangterjual_totalpendapatan)</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>


<script>
 tabel = $('#product').DataTable({
        "paging":   true,
    } );



</script>
@endsection
@endsection
