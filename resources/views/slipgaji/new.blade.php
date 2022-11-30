@extends('layouts.app')
@section('title','Slip Gaji - ')
@section('content')
	<!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class="container">
<!--begin::Dashboard-->
<!--begin::Row-->
<div class="row">
<div class="col-lg-12 col-xxl-12">
<div class="card card-custom gutter-b">
<!--begin::Header-->
<div class="card-header flex-wrap border-0 pt-6 pb-0">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder font-size-h3 text-dark">Slip Gaji Baru</span>
</h3>
<div class="card-toolbar">
<div class="dropdown dropdown-inline">

</div>
</div>
</div>
<!--end::Header-->
<div class="card-body">
    <form method="POST" action="{{url('slipgaji/store')}}" enctype="multipart/form-data">
        @csrf  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row mt-4">
                    <label class="col-md-4"><b>Karyawan</b></label>
                    <div class="col-md-8"> 
                    <select class="form-control" name="kid" required onchange="this.options[this.selectedIndex].value && (window.location = value);">
                    
    <option value="" @if(Request::get('k') == "") selected="selected" @endif>--- PILIH KARYAWAN ---</option> 
    @foreach($karyawan_list as $u)
    <option value="?k={{$u->karyawan_id}}" @if(Request::get('k') == $u->karyawan_id) selected="selected" @endif>{{$u->karyawan_nama}} ({{$u->name}})</option> 
    @endforeach
    </select>
                  </div> 
                </div> 
                <input type="hidden" name="slipgaji_karyawanid" value="{{Request::get('k')}}">
                  <div class="form-group row mt-4">
                    <label class="col-md-4"><b>No Induk Karyawan</b></label>
                    <div class="col-md-8"> 
                    <p>@if($karyawan) {{$karyawan->karyawan_noinduk}} @endif</p>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-4"><b>Jabatan</b></label>
                    <div class="col-md-8"> 
                    <p>@if($karyawan) {{$karyawan->karyawan_jabatan}} @endif</p>
                    </div>
                  </div>
                </div> 
            <div class="col-md-6"> 
                <div class="form-group row mt-4">
                    <label class="col-md-4"><b>Lama Bekerja</b></label>
                    <div class="col-md-8"> 
                        @if($karyawan)
                    @php
        $time = \Carbon\Carbon::now()->diff($karyawan->karyawan_tanggalbekerja);
        @endphp 
                    <p>{{$time->y}} Tahun, {{$time->m}} Bulan, {{$time->d}} Hari</p>
                    @endif
                    </div>
                  </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-4"><b>Bulan Gaji</b></label>
                        <div class="col-md-8">
                        <select class="multisteps-form__input form-control" name="slipgaji_bulan" required> 
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option> 
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                              </select>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-4"><b>Tahun Gaji</b></label>
                        <div class="col-md-8">
                        <select class="multisteps-form__input form-control" name="slipgaji_tahun" required> 
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option> 
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                              </select>
                        </div>
                      </div>
 
                     
                      
            </div>
        </div>


<!--begin::Shopping Cart-->
<div class="mt-5 pt-5"></div>
<span class="card-label font-weight-bolder font-size-h3 text-dark">Penerimaan</span> 
    <div class="dropdown dropdown-inline float-right">
<!-- Button trigger modal-->
<button type="button" class="btn btn-success btn-sm font-weight-bolder font-size-sm" data-toggle="modal" data-target="#modalPenerimaan">
    Tambah Penerimaan
</button>
</div>

<div class="modal fade" id="modalPenerimaan" tabindex="-1" role="dialog" aria-labelledby="modalPenerimaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPenerimaanLabel">Tambah Penerimaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mt-4">
                    <label class="col-md-3">Nama Penerimaan</label>
                    <div class="col-md-9">
                    <input id="namapenerimaanfield" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-3">Jumlah Penerimaan</label>
                    <div class="col-md-9">
                    <input id="jumlahpenerimaanfield" type="text" class="form-control">
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="createpenerimaan" class="createpenerimaan btn btn-primary font-weight-bold" data-dismiss="modal">Tambah Penerimaan</button>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
<table class="table">
<!--begin::Cart Header-->
<thead>
<tr>
<th>Penerimaan</th> 
<th class="text-right">Total</th>
<th></th>
</tr>
</thead>
<!--end::Cart Header-->
<tbody id="wrapperpenerimaan">
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
    <td class="font-weight-bolder font-size-h4 text-right">Subtotal <span id="subtotalpenerimaan" data-subtotpen="0">0</span></td>
    </tr>
    <!--end::Cart Footer-->
    </tbody>
    </table>
</div>
<hr class="mt-5 mb-3">
    <span class="card-label font-weight-bolder font-size-h3 text-dark">Potongan</span>
    <div class="dropdown dropdown-inline float-right">
<!-- Button trigger modal-->
<button type="button" class="btn btn-danger btn-sm font-weight-bolder font-size-sm" data-toggle="modal" data-target="#modalPotongan">
    Tambah Potongan
</button>
<!-- Modal-->
<div class="modal fade" id="modalPotongan" tabindex="-1" role="dialog" aria-labelledby="modalPotonganLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPotonganLabel">Tambah Potongan</h5>
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
    <th>Potongan</th>
    <th class="text-right">Total</th>
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
    <td class="font-weight-bolder font-size-h4 text-right">Subtotal <span id="subtotalpotongan" data-subtotpot="0">0</span></td> 
    </tr>
    <!--end::Cart Footer-->
    </tbody>
    </table>
</div>  
 
<div class="row mt-4">
    <div class="col-md-8">
      <p class="font-weight-bolder font-size-h4 text-right">Take Home Pay</p>
    </div>
    <div class="col-md-4">
        <span id="total" data-total="0" class="font-weight-bolder font-size-h4 text-right">0</span> 
    <input type="hidden" id="thp" name="slipgaji_thp" value="0">
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
      <p class="font-weight-bolder font-size-h4 text-right">Penandatangan</p>
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" name="slipgaji_ttd">
    </div>
</div> 
<div class="row mt-5 mb-5">
    <div class="col-md-9">
    </div>
    <div class="col-md-3">
        <button class="btn btn-md btn-success checkout" style="float:right;">
            Buat Slip Gaji
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
var max_fields = 100; //maximum input boxes allowed
var wrapper = $('#tbody'); //Fields wrapper
var wrapper2 = $('#tbody2'); //Fields wrapper
var wrapperpotongan = $('#wrapperpotongan'); //Fields wrapper
var wrapperpenerimaan = $('#wrapperpenerimaan'); //Fields wrapper
var x = 0; //initlal text box count
var y = 0; //initlal text box count
var subtotalpenerimaan = $('#subtotalpenerimaan');
var subtotalpotongan = $('#subtotalpotongan');
var thp = $('#thp'); 
function suminput() {
    var inputs = $('.tothargabrg'),
        result = $('#subtotal'),
        sum = 0;

        for(var i=0;i<inputs.length;i++){
        if(parseInt(inputs[i].value))
            sum += parseInt(inputs[i].value) || 0;
    }

    result.html(formatter.format(sum)); 
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
    subtotalpotongan.attr("data-subtotpot", sum); 
}
function sumpen() {
    var inputs = $('.totpen'),
        result = $('#subtotalpenerimaan'),
        sum = 0;

        for(var i=0;i<inputs.length;i++){
        if(parseInt(inputs[i].value))
            sum += parseInt(inputs[i].value) || 0;
    }

    result.html(formatter.format(sum)); 
    subtotalpenerimaan.attr("data-subtotpen", sum); 
}
function sumtot(){
    var inputs = $('.totpen'),
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
    result.html(formatter.format(sum-sum2));
    result.attr('data-total',parseInt(sum-sum2));
    thp.val(sum-sum2)
}
var subtotal = 0;
var potongan = 0;
var penerimaan = 0;

$(document).ready(function() {
    $('.select2-search').bind("cut copy paste",function(e) {
    return false;
 });

 $('.select2-search__field').bind("cut copy paste",function(e) {
    return false;
 });
 
});

$('#productlist').val('');
$('#ongkoskirim').val('0');


var formatter = new Intl.NumberFormat('id-ID', {style: 'currency',currency: 'IDR',});

 

function tambahpotongan(harga){
    potongan = potongan+parseInt(harga)
    subtotalpotongan.innerHTML = formatter.format(potongan); 
}

function kurangpotongan(harga){
    potongan = potongan-parseInt(harga)
    subtotalpotongan.innerHTML = formatter.format(potongan); 
}
function tambahpenerimaan(harga){
    subtotal = subtotal+(harga*1)
    subtotalpenerimaan.innerHTML = formatter.format(subtotal);  
     
}
function kurangpenerimaan(harga){
    subtotal = subtotal-(harga*1)  
    subtotalpenerimaan.innerHTML = formatter.format(subtotal);  
     
     
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
if(pot == ''){
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
tambahpotongan(pot);
total = total-parseInt(potongan)
document.getElementById('total').innerHTML = formatter.format(total);
$('#DT'+y).val(total);
sumpot();
sumtot();
})

$("#createpenerimaan").on("click", function(e){ //user click on remove text
e.preventDefault();
penname = document.getElementById('namapenerimaanfield').value;
pen = document.getElementById('jumlahpenerimaanfield').value;
if(pen == ''){
penerimaan = 0;
}else {
penerimaan = pen;
}

wrapperpenerimaan.append(`<tr id="pen${y}">
<td class="d-flex align-items-center font-weight-bolder">
<a class="text-dark text-hover-primary">${penname}</a>
</td>
<td class="text-right align-middle font-weight-bolder font-size-h5" id="pen${y}" data-pen="${penerimaan}">${formatter.format(penerimaan)}</td>
<td class="text-right align-middle">
<button class="btn btn-xs btn-danger remove_penerimaan btn-icon" data-idpen="${y}" data-kurpen="${penerimaan}">
<i class="fas fa-trash"></i>
</button>
</td>
</tr>`);
wrapperpenerimaan.append(`<input id="PN${y}" type="hidden" name="penerimaanname[]" value="${penname}">`);
wrapperpenerimaan.append(`<input id="PT${y}" type="hidden" class="totpen" name="penerimaantotal[]" value="${penerimaan}">`);
y++
tambahpenerimaan(pen);
total = total+parseInt(penerimaan) 
document.getElementById('total').innerHTML = formatter.format(total);
$('#PT'+y).val(total);
sumpen();
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
document.getElementById('total').innerHTML = formatter.format(total); 
$(this).parent().parent('tr').remove();  
$('#DN'+idpot).remove();
$('#DT'+idpot).remove();
sumpot();
sumtot();
y--;

})

$(wrapperpenerimaan).on("click",".remove_penerimaan", function(e){ //user click on remove text
e.preventDefault();
idpen = this.getAttribute('data-idpen');
kurangpenerimaan(this.getAttribute('data-kurpen'));
total = total-parseInt(this.getAttribute('data-kurpen'));  
document.getElementById('total').innerHTML = formatter.format(total); 

$(this).parent().parent('tr').remove();
$('#PN'+idpen).remove();
$('#PT'+idpen).remove();

sumpen();
sumtot();
y--;

}) 
 
</script>
@endsection
@endsection
