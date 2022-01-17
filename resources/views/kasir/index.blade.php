@extends('layouts.app')
@section('title','Kasir - ')
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
<div class="col-lg-12 col-xxl-12">
<div class="card card-custom gutter-b">
<!--begin::Header-->
<div class="card-header flex-wrap border-0 pt-6 pb-0">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder font-size-h3 text-dark">Penjualan Baru</span>
</h3>
<div class="card-toolbar">
<div class="dropdown dropdown-inline">

</div>
</div>
</div>
<!--end::Header-->
<div class="card-body">
    <form method="POST" action="{{url('kasir/store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row mt-4">
                    <label class="col-md-4">Invoice No</label>
                    <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="penjualan_invoice"  required >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-4">Nama Customer</label>
                    <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="penjualan_customername" required>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-4">Add Product SKU</label>
                    <div class="col-md-8">
                        <select class="form-control select2" id="productlist" name="param">
                            @foreach($product as $p)
                            <option value="{{$p->product_id}}">{{$p->product_sku}} - {{$p->product_nama}} ({{$p->size_nama}})</option>
                            @endforeach
                           </select>
                    </div>
                  </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row mt-4">
                    <label class="col-md-4">Channel</label>
                    <div class="col-md-8">
                      <select class="multisteps-form__input form-control" name="penjualan_channel" required>
                        <option value="Toko">Toko</option>
                        <option value="Website">Website</option>
                        <option value="Shopee">Shopee</option>
                        <option value="Tokopedia">Tokopedia</option>
                        <option value="Blibli">Blibli</option>
                        <option value="BukaLapak">BukaLapak</option>
                        <option value="WhatsApp">WhatsApp</option>
                      </select>
                    </div>
                  </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-4">Tanggal Penjualan</label>
                        <div class="col-md-8">
                            <input class="form-control" type="date" name="penjualan_tanggalpenjualan"/>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-4">Type Pembayaran</label>
                        <div class="col-md-8">
                            <select class="multisteps-form__input form-control" name="penjualan_paymentype" required>
                                <option value="Cash">Cash</option>
                                <option value="GoPay">GoPay</option>
                                <option value="ShopeePay">ShopeePay</option>
                                <option value="OVO">OVO</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Transfer Bank BCA">Transfer Bank BCA</option>
                                <option value="Transfer Bank BNI">Transfer Bank BNI</option>
                                <option value="Transfer Bank Mandiri">Transfer Bank Mandiri</option>
                                <option value="Debit">Debit</option>
                                <option value="Kartu Kredit">Kartu Kredit</option>
                                <option value="Marketplace">Marketplace</option>
                              </select>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-4">Jumlah Pembayaran</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="paymenttotal">Rp</span>
                                </div>
                                <input class="form-control" type="text" name="penjualan_paymenttotal" aria-label="Payment" aria-describedby="paymenttotal" required/>
                              </div>

                        </div>
                      </div>

            </div>
        </div>


<!--begin::Shopping Cart-->
<div class="table-responsive">
<table class="table">
<!--begin::Cart Header-->
<thead>
<tr>
<th>Produk</th>
<th class="text-center">Qty</th>
<th class="text-right">Harga</th>
<th></th>
</tr>
</thead>
<!--end::Cart Header-->
<tbody id="tbody">
<!--begin::Cart Content-->
<!--end::Cart Content-->
<!--begin::Cart Footer-->
<!--end::Cart Footer-->
</tbody>
</table>
<div class="table-responsive">
    <table class="table">
    <!--begin::Cart Header-->

    <!--end::Cart Header-->
    <tbody>
    <tr>
    <td colspan="2"></td>
    <td class="font-weight-bolder font-size-h4 text-right">Subtotal <span id="subtotal"></span></td>
    </tr>
    <!--end::Cart Footer-->
    </tbody>
    </table>
</div>
<hr class="mt-5 mb-3">
    <span class="card-label font-weight-bolder font-size-h3 text-dark">Potongan & Diskon</span>
    <div class="dropdown dropdown-inline float-right">
<!-- Button trigger modal-->
<button type="button" class="btn btn-warning btn-sm font-weight-bolder font-size-sm" data-toggle="modal" data-target="#exampleModal">
    Tambah Potongan
</button>
<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Potongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mt-4">
                    <label class="col-md-3">Nama Potongan</label>
                    <div class="col-md-9">
                    <input id="namapotonganfield" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-3">Jumlah Potongan</label>
                    <div class="col-md-9">
                    <input id="jumlahpotonganfield" type="text" class="form-control">
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="createpotongan" class="createpotongan btn btn-primary font-weight-bold" data-dismiss="modal">Tambah Potongan</button>
            </div>
        </div>
    </div>
</div>


    </div>
<div class="table-responsive">
    <table class="table">
    <!--begin::Cart Header-->
    <thead>
    <tr>
    <th>Nama Potongan</th>
    <th class="text-right">Jumlah</th>
    <th></th>
    </tr>
    </thead>
    <!--end::Cart Header-->
    <tbody id="wrapperpotongan">
    <!--begin::Cart Content-->
    <!--end::Cart Content-->
    <!--begin::Cart Footer-->


    <!--end::Cart Footer-->
    </tbody>
    </table>
    </div>

<div class="table-responsive">
    <table class="table">
    <!--begin::Cart Header-->

    <!--end::Cart Header-->
    <tbody>
    <tr>
    <td colspan="2"></td>
    <td class="font-weight-bolder font-size-h4 text-right">Subtotal <span id="subtotalpotongan"></span></td>
    </tr>
    <!--end::Cart Footer-->
    </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table">
    <tbody>
    <tr>
    <td class="font-weight-bolder font-size-h4 text-right">Total <span id="total"></span></td>
<td class="text-right align-middle">
<button class="btn btn-md btn-danger checkout">
Checkout
</button>
</td>
    </tr>

    <!--end::Cart Footer-->
    </tbody>
    </table>
</div>

</form>
<!--end::Shopping Cart-->
</div>
</div>
<!--end::Stats Widget 11-->
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
<script>
var total = 0;
var subtotal = 0;
var potongan = 0;
    $(document).ready(function() {
    $('#productlist').select2({
   placeholder: "Masukan SKU Produk",
   allowClear: true
  });
});

var formatter = new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',

  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});
function tambahharga(harga){
    subtotal = subtotal+(harga*1)
    document.getElementById('subtotal').innerHTML = formatter.format(subtotal);
}

function kurangharga(harga){
    subtotal = subtotal-(harga*1)
    document.getElementById('subtotal').innerHTML = formatter.format(subtotal);
    document.getElementById('total').innerHTML = formatter.format(total);
}

function tambahpotongan(harga){
    potongan = potongan+parseInt(harga)
    document.getElementById('subtotalpotongan').innerHTML = formatter.format(potongan);
}

function kurangpotongan(harga){
    potongan = potongan-parseInt(harga)
    document.getElementById('subtotalpotongan').innerHTML = formatter.format(potongan);
}


var max_fields = 10; //maximum input boxes allowed
var wrapper = $('#tbody'); //Fields wrapper
var wrapperpotongan = $('#wrapperpotongan'); //Fields wrapper
var x = 0; //initlal text box count
var y = 0; //initlal text box count
$('#productlist').on('select2:select', function (e) {
    e.preventDefault();
if(x <= max_fields){ //max input box allowed
       var select_val = $(e.currentTarget).val();
        $.ajax({
            url: '/productapi/getproduct',
          type: 'POST',
            data: {
              _token :  "{{csrf_token()}}",
                productid: select_val,
            },
            success: function(data){
x++; //text box increment
                wrapper.append(`<tr id="R${x}">
<td class="d-flex align-items-center font-weight-bolder">
<a href="#" class="text-dark text-hover-primary">${data["product_sku"]} - ${data["product_nama"]} ${data["size_nama"]}</a>
</td>
<td class="text-center align-middle">
<button class="btn btn-xs btn-light-success btn-icon kurangqty" data-idproduct="${data["product_id"]}">
    <i class="ki ki-minus icon-xs"></i>
</button>
<span class="mr-2 font-weight-bolder" id="qty${data["product_id"]}" data-qtyordered="1">1</span>
<button class="btn btn-xs btn-light-success btn-icon tambahqty" data-idproduct="${data["product_id"]}">
    <i class="ki ki-plus icon-xs"></i>
</button>
</td>
<td class="text-right align-middle font-weight-bolder font-size-h5" id="price${data["product_id"]}" data-priceordered="${data["product_hargajual"]}">${formatter.format(data["product_hargajual"])}</td>
<td class="text-right align-middle">
<button class="btn btn-xs btn-danger remove_field btn-icon" data-idproduct="${data["product_id"]}">
<i class="fas fa-trash"></i>
</button>
</td>
</tr> `);
wrapper.append(`<input id="IP${data["product_id"]}" type="hidden" name="productorders[]" value="${data["product_id"]}">`);
wrapper.append(`<input id="IQ${data["product_id"]}" type="hidden" name="qtyorders[]" value="1">`);
total = total+parseInt(data["product_hargajual"])
document.getElementById('total').innerHTML = formatter.format(total);
tambahharga(data["product_hargajual"]);
console.log(x);
            },
            error: function(data) {
        console.log('Cannot retrieve data.');
    }
        });

   // Adding a row inside the tbody.

} else {

}

});

$("#createpotongan").on("click", function(e){ //user click on remove text
e.preventDefault();
potname = document.getElementById('namapotonganfield').value;
pot = document.getElementById('jumlahpotonganfield').value;
wrapperpotongan.append(`<tr id="P${y}">
<td class="d-flex align-items-center font-weight-bolder">
<a href="#" class="text-dark text-hover-primary">${potname}</a>
</td>
<td class="text-right align-middle font-weight-bolder font-size-h5" id="pot${y}" data-pot="${pot}">${formatter.format(pot)}</td>
<td class="text-right align-middle">
<button class="btn btn-xs btn-danger remove_potongan btn-icon" data-idpot="${y}" data-kurpot="${pot}">
<i class="fas fa-trash"></i>
</button>
</td>
</tr>`);
wrapperpotongan.append(`<input id="DN${y}" type="hidden" name="potonganname[]" value="${potname}">`);
wrapperpotongan.append(`<input id="DT${y}" type="hidden" name="potongantotal[]" value="${pot}">`);
y++
total = total-parseInt(pot)
document.getElementById('total').innerHTML = formatter.format(total);
tambahpotongan(pot);
console.log(pot);
})

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
produk = this.getAttribute('data-idproduct');
kurangharga(document.getElementById('price'+produk).getAttribute('data-priceordered'));
total = total-parseInt(document.getElementById('price'+produk).getAttribute('data-priceordered'))
document.getElementById('total').innerHTML = formatter.format(total);
$(this).parent().parent('tr').remove();
$('#IQ'+produk).remove();
$('#IP'+produk).remove();
x--;
})

$(wrapperpotongan).on("click",".remove_potongan", function(e){ //user click on remove text
e.preventDefault();
idpot = this.getAttribute('data-idpot');
kurangpotongan(this.getAttribute('data-kurpot'));
total = total+parseInt(this.getAttribute('data-kurpot'))
document.getElementById('total').innerHTML = formatter.format(total);
$(this).parent().parent('tr').remove();
y--;
})

$(wrapper).on("click",".tambahqty", function(e){
e.preventDefault();
produk = this.getAttribute('data-idproduct');
qtyordered = document.getElementById('qty'+produk).getAttribute('data-qtyordered');
priceordered = document.getElementById('price'+produk).getAttribute('data-priceordered');
        $.ajax({
          url: '/productapi/getproduct',
          type: 'POST',
          data: {
            _token :  "{{csrf_token()}}",
            productid: produk,
                },
            success: function(data){
            minstok = 1;
            maxstok = data["product_stok"];

if(qtyordered >= maxstok){
qtyordered = maxstok;
document.getElementById('qty'+produk).dataset.qtyordered = qtyordered;
document.getElementById('qty'+produk).innerHTML = qtyordered;
$('#IQ'+produk).val(qtyordered);
}else {
    qtyordered = parseInt(qtyordered)+1;
    priceordered = parseInt(priceordered)+parseInt(data["product_hargajual"]);
    document.getElementById('qty'+produk).dataset.qtyordered = qtyordered;
    document.getElementById('price'+produk).dataset.priceordered = priceordered;
    $('#IQ'+produk).val(qtyordered);
    document.getElementById('qty'+produk).innerHTML = qtyordered;
    document.getElementById('price'+produk).innerHTML = formatter.format(priceordered);
    total = total+parseInt(data["product_hargajual"])
    document.getElementById('total').innerHTML = formatter.format(total);
    tambahharga(data["product_hargajual"]);
}
            },
            error: function(data) {
        console.log('Cannot retrieve data.');
             }
         });

});

$(wrapper).on("click",".kurangqty", function(e){
e.preventDefault();
produk = this.getAttribute('data-idproduct');
qtyordered = document.getElementById('qty'+produk).getAttribute('data-qtyordered');
priceordered = document.getElementById('price'+produk).getAttribute('data-priceordered');
        $.ajax({
          url: '/productapi/getproduct',
          type: 'POST',
          data: {
            _token :  "{{csrf_token()}}",
            productid: produk,
                },
            success: function(data){
            minstok = 1;
            maxstok = data["product_stok"];

if(qtyordered <= minstok){
qtyordered = minstok;
document.getElementById('qty'+produk).dataset.qtyordered = qtyordered;
    document.getElementById('qty'+produk).innerHTML = qtyordered;
$('#IQ'+produk).val(qtyordered);
}else {
    qtyordered = parseInt(qtyordered)-1;
    priceordered = parseInt(priceordered)-parseInt(data["product_hargajual"]);
    document.getElementById('qty'+produk).dataset.qtyordered = qtyordered;
    document.getElementById('price'+produk).dataset.priceordered = priceordered;
    $('#IQ'+produk).val(qtyordered);
    document.getElementById('qty'+produk).innerHTML = qtyordered;
    document.getElementById('price'+produk).innerHTML = formatter.format(priceordered);
    total = total-parseInt(data["product_hargajual"])
    document.getElementById('total').innerHTML = formatter.format(total);
    kurangharga(data["product_hargajual"]);
}
            },
            error: function(data) {
        console.log('Cannot retrieve data.');
             }
         });

});
</script>
@endsection
@endsection
