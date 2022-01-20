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
                    <label class="col-md-4">Invoice Gorilla No</label>
                    <div class="col-md-8">
                        <p>{{$invoice}}</p>
                    <input id="name" type="hidden" name="penjualan_invoicegorilla" value="{{$invoice}}" >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-4">Invoice Marketplace <small>(kosongkan apabila bukan dari marketplace)</small></label>
                    <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="penjualan_invoice" >
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-4">Nama Customer</label>
                    <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="penjualan_customername">
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-4">Add Product SKU</label>
                    <div class="col-md-8">
                        <select class="form-control select2" id="productlist" name="param">
                            @foreach($product as $p)
                            <option value="{{$p->product_id}}">@if($p->product_productlama == 1) {{$p->product_barcodelama}} @endif{{$p->product_sku}} - {{$p->product_nama}} ({{$p->size_nama}})</option>
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
                        <label class="col-md-4">Tanggal Penjualan <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input class="form-control" id="tanggalpenjualan" type="date" name="penjualan_tanggalpenjualan" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required/>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-4">Kurir Pengiriman</label>
                        <div class="col-md-8">
                            <select class="multisteps-form__input form-control" id="kurir" name="penjualan_kurir" required>
                                <option value="-" selected>None</option>
                                <option value="GoSend">GoSend</option>
                                <option value="GrabExpress">GrabExpress</option>
                                <option value="JNE">JNE</option>
                                <option value="J&T">J&T</option>
                                <option value="SiCepat">SiCepat</option>
                                <option value="Anteraja">Anteraja</option>
                                <option value="Ninja Express">Ninja Express</option>
                                <option value="ID Express">ID Express</option>
                                <option value="Pos Indonesia">Pos Indonesia</option>
                                <option value="Shopee Express">Shopee Express</option>
                              </select>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-4">Resi Pengiriman</label>
                        <div class="col-md-8">
                                <input class="form-control" type="text" id="resi" name="penjualan_resi" aria-describedby="resi"/>

                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-4">Ongkos Kirim</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" type="text" id="ongkoskirim" onchange="tambahongkir(this);" name="penjualan_ongkoskirim" aria-label="Payment" aria-describedby="ongkoskirim"/>
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
<th class="text-center">Disc</th>
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
    <td class="font-weight-bolder font-size-h4 text-right">Subtotal <span id="subtotal">0</span></td>
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
    <td class="font-weight-bolder font-size-h4 text-right">Subtotal <span id="subtotalpotongan" data-subtot="">0</span></td>
    </tr>
    <!--end::Cart Footer-->
    </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-8">
      <p class="font-weight-bolder font-size-h4 text-right">Total</p>
    </div>
    <div class="col-md-4">
        <span id="total" data-total="0" class="font-weight-bolder font-size-h4 text-right">0</span>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
      <p class="font-weight-bolder font-size-h4 text-right">Kembalian</p>
    </div>
    <div class="col-md-4">
        <span id="kembalian" class="font-weight-bolder font-size-h4 text-right">0</span>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
      <p class="font-weight-bolder font-size-h4 text-right">Ongkos Kirim</p>
    </div>
    <div class="col-md-4">
        <span id="ongkirkurir" class="font-weight-bolder font-size-h4 text-right">0</span>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
        <p class="font-weight-bolder font-size-h4 text-right">Pembayaran oleh Customer</p>
      </div>
      <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="paymenttotal">Rp</span>
            </div>
            <input id="paymenttot" class="form-control" type="text" name="penjualan_paymenttotal" onchange="kembalian(this);" aria-label="Payment" aria-describedby="paymenttotal" required/>
          </div>

      </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
        <p class="font-weight-bolder font-size-h4 text-right ">Jenis Pembayaran</p>
      </div>
      <div class="col-md-4">
          <div class="form-group mt-4">
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
</div>
<div class="row">
    <div class="col-md-11">
    </div>
    <div class="col-md-1">
        <button class="btn btn-md btn-danger checkout" style="float:right;">
            Checkout
            </button>
    </div>
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
var max_fields = 10; //maximum input boxes allowed
var wrapper = $('#tbody'); //Fields wrapper
var wrapperpotongan = $('#wrapperpotongan'); //Fields wrapper
var x = 0; //initlal text box count
var y = 0; //initlal text box count
function suminput() {
    var inputs = $('.tothargabrg'),
        result = $('#subtotal'),
        sum = 0;

        for(var i=0;i<inputs.length;i++){
        if(parseInt(inputs[i].value))
            sum += parseInt(inputs[i].value) || 0;
    }

    result.html(formatter.format(sum));
    result.attr('data-subtot',parseInt(sum));
}
function sumpot() {
    var inputs = $('.totpotbrg'),
        result = $('#subtotalpotongan'),
        sum = 0;

        for(var i=0;i<inputs.length;i++){
        if(parseInt(inputs[i].value))
            sum += parseInt(inputs[i].value) || 0;
    }

    result.html(formatter.format(sum));
    console.log(sum);
}
function sumtot(){
    var inputs = $('.tothargabrg'),
        inputs2 = $('.totpotbrg'),
        result = $('#total'),
        sum = 0;
        sum2 = 0;
        if($("#ongkoskirim").val() == '' || $("#ongkoskirim").val() == null){
            ongkirs = 0;
        }else {
            ongkirs = parseInt($("#ongkoskirim").val());
        }
        var ongkir = ongkirs;

        for(var i=0;i<inputs.length;i++){
        if(parseInt(inputs[i].value))
            sum += parseInt(inputs[i].value) || 0;
    }
    for(var i=0;i<inputs2.length;i++){
        if(parseInt(inputs2[i].value))
            sum2 += parseInt(inputs2[i].value) || 0;
    }
    result.html(formatter.format(sum-sum2+ongkir));
    result.attr('data-total',parseInt(sum-sum2+ongkir));
}
var subtotal = 0;
var potongan = 0;

$(document).ready(function() {
$('#productlist').select2({
   placeholder: "Masukan SKU Produk",
   allowClear: true
  });
});

$('#productlist').val('');
$('#ongkoskirim').val('0');


var formatter = new Intl.NumberFormat('id-ID', {style: 'currency',currency: 'IDR',});


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

function diskonprod(prod){
var diskoninput = prod.value;
var discprodid = prod.dataset.idproduct;
var pricesatuan = document.getElementById('price'+discprodid).getAttribute('data-pricesatuan');
var qtyorder = document.getElementById('qty'+discprodid).getAttribute('data-qtyordered');
var hargaasliproduct = parseInt(pricesatuan)*parseInt(qtyorder);
if(diskoninput.includes('%')){
var potongandiskoninput = diskoninput.replace('%','');
hargabaru =  parseInt(hargaasliproduct)-parseInt((potongandiskoninput*hargaasliproduct)/100);
}else if(diskoninput == ''){
diskoninput = 0;
hargabaru =  parseInt(hargaasliproduct)-parseInt(diskoninput);
}else {
hargabaru =  parseInt(hargaasliproduct)-parseInt(diskoninput);
}
$('#price'+prod.dataset.idproduct).attr('data-priceordered',parseInt(hargabaru));
document.getElementById('price'+prod.dataset.idproduct).innerHTML = formatter.format(hargabaru);
$('#IH'+discprodid).val(hargabaru);
suminput();
sumtot();
}

function kembalian(pay){
var payment = pay.value;
var hartot = $("#total").attr('data-total');
var kembalian = parseInt(payment)-parseInt(hartot);
console.log(payment);
console.log(hartot);
console.log(kembalian);
$('#kembalian').html(formatter.format(kembalian));
sumtot();
}



function tambahongkir(ongkir){
if(ongkir.value == null || ongkir.value == '' || ongkir.value == NaN){
    ongkirs = 0;
}else {
    ongkirs = ongkir.value;
}
var ongkos = ongkirs;
var hartot = $("#total").attr('data-total');
var tambahongkir = parseInt(ongkos);
$('#ongkirkurir').html(formatter.format(tambahongkir));
sumtot();
}



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
              $.ajax({
                url: '/productapi/apiaddbarangkasir',
                type: 'POST',
                data: {
                    _token :  "{{csrf_token()}}",
                    productid: select_val,
                    qty: 1,
                    tglbarangterjual: $('#tanggalpenjualan').val(),
                    },
                    success: function(data){
                    x++;
                    wrapper.append(`<tr id="R${data["product_id"]}">
                    <td class="font-weight-bolder">
                    <p><a href="#" class="text-dark text-hover-primary">${data["product_sku"]} - ${data["product_nama"]} (${data["size_nama"]})</a></p></br>
                    <p>${data["band_nama"]} - ${data["product_vendor"]}</p>
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
                    <td class="text-center align-middle">
                    <input id="diskon${data["product_id"]}" type="text" class="form-control discountprods" onchange="diskonprod(this);" value="0" data-idproduct="${data["product_id"]}" data-priceordered="${data["product_hargajual"]}" name="diskonproduct[]" required>
                    </td>
                    <td class="text-right align-middle font-weight-bolder font-size-h5" id="price${data["product_id"]}" data-pricesatuan="${data["product_hargajual"]}" data-priceordered="${data["product_hargajual"]}">${formatter.format(data["product_hargajual"])}</td>
                    <td class="text-right align-middle">
                    <button class="btn btn-xs btn-danger remove_field btn-icon" data-idproduct="${data["product_id"]}">
                    <i class="fas fa-trash"></i>
                    </button>
                    </td>
                    </tr> `);
                    wrapper.append(`<input id="IP${data["product_id"]}" type="hidden" name="productorders[]" value="${data["product_id"]}">`);
                    wrapper.append(`<input id="IQ${data["product_id"]}" type="hidden" name="qtyorders[]" value="1">`);
                    wrapper.append(`<input id="IH${data["product_id"]}" type="hidden" class="tothargabrg" name="finalpriceprod[]" value="${data["product_hargajual"]}">`);
                    total = total+parseInt(data["product_hargajual"])
                    document.getElementById('total').innerHTML = formatter.format(total);
                    $('#IH'+data["product_id"]).val(data["product_hargajual"]);
                    suminput();
                    sumtot();

                    console.log(document.getElementById('total').innerHTML);
               },
                  error: function(data) {
                     console.log('Cannot retrieve data.');
                      }
                 });
                 },
                  error: function(data) {
                    console.log('Cannot retrieve data.');
                  }


        });


}

});

$("#createpotongan").on("click", function(e){ //user click on remove text
e.preventDefault();
potname = document.getElementById('namapotonganfield').value;
pot = document.getElementById('jumlahpotonganfield').value;
if(pot.includes('%')){
var potongandisc = pot.replace('%','');
potongan =   parseInt(($("#subtotal").attr('data-subtot')*potongandisc)/100);
}else if(pot == ''){
potongan = 0;
}else {
potongan = pot;
}

wrapperpotongan.append(`<tr id="P${y}">
<td class="d-flex align-items-center font-weight-bolder">
<a href="#" class="text-dark text-hover-primary">${potname}</a>
</td>
<td class="text-right align-middle font-weight-bolder font-size-h5" id="pot${y}" data-pot="${potongan}">${formatter.format(potongan)}</td>
<td class="text-right align-middle">
<button class="btn btn-xs btn-danger remove_potongan btn-icon" data-idpot="${y}" data-kurpot="${potongan}">
<i class="fas fa-trash"></i>
</button>
</td>
</tr>`);
wrapperpotongan.append(`<input id="DN${y}" type="hidden" name="potonganname[]" value="${potname}">`);
wrapperpotongan.append(`<input id="DT${y}" type="hidden" class="totpotbrg" name="potongantotal[]" value="${potongan}">`);
y++
total = total-parseInt(potongan)
$('#DT'+y).val(total);
sumpot();
sumtot();
})

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
produk = this.getAttribute('data-idproduct');
   $.ajax({
   url: '/productapi/apideletebarangkasir',
   type: 'POST',
   data: {
     _token :  "{{csrf_token()}}",
      productid: produk,
        },
       success: function(data){

                    kurangharga(document.getElementById('price'+produk).getAttribute('data-priceordered'));
                    total = total-parseInt(document.getElementById('price'+produk).getAttribute('data-priceordered'))
                    document.getElementById('total').innerHTML = formatter.format(total);
                    console.log(document.getElementById('total').innerHTML);
                    $('#R'+produk).remove();
                    $('#IQ'+produk).remove();
                    $('#IP'+produk).remove();
                    $('#IH'+produk).remove();
                    x--;
                    suminput();
                    sumtot();

        },
     error: function(data) {
        console.log('Cannot retrieve data.');
         }
    });

})

$(wrapperpotongan).on("click",".remove_potongan", function(e){ //user click on remove text
e.preventDefault();
idpot = this.getAttribute('data-idpot');
kurangpotongan(this.getAttribute('data-kurpot'));
total = total+parseInt(this.getAttribute('data-kurpot'));
suminput();
sumtot();
$(this).parent().parent('tr').remove();
y--;

})

$(wrapper).on("click",".tambahqty", function(e){
    e.preventDefault();
    produk = this.getAttribute('data-idproduct');
    qtyordered = parseInt(document.getElementById('qty'+produk).getAttribute('data-qtyordered'));
    pricesatuan = document.getElementById('price'+produk).getAttribute('data-pricesatuan');
    diskoninput = document.getElementById('diskon'+produk).value;
    priceordered = parseInt(pricesatuan)*parseInt(qtyordered);
            $.ajax({
            url: '/productapi/getproduct',
            type: 'POST',
            data: {
                _token :  "{{csrf_token()}}",
                productid: produk,
                    },
                success: function(data){
                minstok = 1;
                maxstok = parseInt(data["product_stokakhir"]);

    if(qtyordered >= maxstok && maxstok > 0){
    qtyordered = maxstok;
    document.getElementById('qty'+produk).dataset.qtyordered = qtyordered;
    document.getElementById('qty'+produk).innerHTML = qtyordered;
    $('#IQ'+produk).val(qtyordered);
    }else {
        qtyordered = parseInt(qtyordered)+1;
        priceordered = parseInt(pricesatuan)+parseInt(data["product_hargajual"]);

        if(diskoninput.includes('%')){
            var potongandiskoninput = diskoninput.replace('%','');
            hargabaru =  parseInt(priceordered)-parseInt((potongandiskoninput*priceordered)/100);
        }else if(diskoninput == ''){
            diskoninput = 0;
            hargabaru =  parseInt(priceordered)-parseInt(diskoninput);
        }else {
        hargabaru =  parseInt(priceordered)-parseInt(diskoninput);
        }

        document.getElementById('qty'+produk).dataset.qtyordered = qtyordered;
        document.getElementById('price'+produk).dataset.priceordered = hargabaru;

        $('#IQ'+produk).val(qtyordered);

        document.getElementById('qty'+produk).innerHTML = qtyordered;
        document.getElementById('price'+produk).innerHTML = formatter.format(hargabaru);
        $('#IH'+produk).val(hargabaru);
        suminput();
        sumtot();
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
qtyordered = parseInt(document.getElementById('qty'+produk).getAttribute('data-qtyordered'));
pricesatuan = document.getElementById('price'+produk).getAttribute('data-pricesatuan');
diskoninput = document.getElementById('diskon'+produk).value;
priceordered = parseInt(pricesatuan)*parseInt(qtyordered);
        $.ajax({
          url: '/productapi/getproduct',
          type: 'POST',
          data: {
            _token :  "{{csrf_token()}}",
            productid: produk,
                },
            success: function(data){
            minstok = 1;
            maxstok = data["product_stokakhir"];

if(qtyordered <= minstok){
qtyordered = minstok;
document.getElementById('qty'+produk).dataset.qtyordered = qtyordered;
document.getElementById('qty'+produk).innerHTML = qtyordered;
$('#IQ'+produk).val(qtyordered);
}else {
        qtyordered = parseInt(qtyordered)-1;
        priceordered = parseInt(priceordered)-parseInt(data["product_hargajual"]);

        if(diskoninput.includes('%')){
            var potongandiskoninput = diskoninput.replace('%','');
            hargabaru =  parseInt(priceordered)-parseInt((potongandiskoninput*priceordered)/100);
        }else if(diskoninput == ''){
            diskoninput = 0;
            hargabaru =  parseInt(priceordered)-parseInt(diskoninput);
        }else {
        hargabaru =  parseInt(priceordered)-parseInt(diskoninput);
        }
console.log(hargabaru);
        document.getElementById('qty'+produk).dataset.qtyordered = qtyordered;
        document.getElementById('price'+produk).dataset.priceordered = hargabaru;

        $('#IQ'+produk).val(qtyordered);
        document.getElementById('qty'+produk).innerHTML = qtyordered;
        document.getElementById('price'+produk).innerHTML = formatter.format(hargabaru);
        $('#IH'+produk).val(hargabaru);
        suminput();
        sumtot();



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
