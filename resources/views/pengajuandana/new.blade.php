@extends('layouts.app')
@section('title','Pengajuan Dana - ')
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
<span class="card-label font-weight-bolder font-size-h3 text-dark">Pengajuan Dana Baru</span>
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
                        <label class="col-md-4"><b>Bulan Pengajuan Dana</b></label>
                        <div class="col-md-8">
                        <select class="multisteps-form__input form-control" name="pengajuandana_bulan" required>
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
                        <label class="col-md-4"><b>Tahun Pengajuan Dana</b></label>
                        <div class="col-md-8">
                        <select class="multisteps-form__input form-control" name="pengajuandana_tahun" required>
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
 @foreach($kategoripengajuan as $katper)
<hr class="mt-5 pt-5"></hr>
<span class="card-label font-weight-bolder font-size-h3 text-dark">{{$katper->catpengajuan_nama}}</span>
    <div class="dropdown dropdown-inline float-right">
<!-- Button trigger modal-->
<button type="button" class="btn btn-success btn-sm font-weight-bolder font-size-sm" data-toggle="modal" data-target="#modal{{str_replace(' ', '', $katper->catpengajuan_nama)}}">
    Tambah {{$katper->catpengajuan_nama}}
</button>
</div>

<div class="modal fade" id="modal{{str_replace(' ', '', $katper->catpengajuan_nama)}}" tabindex="-1" role="dialog" aria-labelledby="modal{{str_replace(' ', '', $katper->catpengajuan_nama)}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal{{str_replace(' ', '', $katper->catpengajuan_nama)}}Label">Tambah {{$katper->catpengajuan_nama}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mt-4">
                    <label class="col-md-3">Nama Pengajuan</label>
                    <div class="col-md-9">
                    <input id="nama{{str_replace(' ', '', $katper->catpengajuan_nama)}}field" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-3">Jumlah</label>
                    <div class="col-md-9">
                    <input id="jumlah{{str_replace(' ', '', $katper->catpengajuan_nama)}}field" type="text" class="form-control">
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="create{{str_replace(' ', '', $katper->catpengajuan_nama)}}" class="create{{str_replace(' ', '', $katper->catpengajuan_nama)}} btn btn-primary font-weight-bold" data-dismiss="modal">Tambah Penerimaan</button>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
<table class="table">
<!--begin::Cart Header-->
<thead>
<tr>
<th>{{$katper->catpengajuan_nama}}</th>
<th class="text-right">Total</th>
<th></th>
</tr>
</thead>
<!--end::Cart Header-->
<tbody id="wrapper{{str_replace(' ', '', $katper->catpengajuan_nama)}}">
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
    <td class="font-weight-bolder font-size-h4 text-right">Total <span id="subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}}" data-subtotpen="0">0</span></td>
    </tr>
    <!--end::Cart Footer-->
    </tbody>
    </table>
</div>
@endforeach

<div class="row mt-4">
    <div class="col-md-8">
      <p class="font-weight-bolder font-size-h4 text-right">Take Home Pay</p>
    </div>
    <div class="col-md-4">
        <span id="total" data-total="0" class="font-weight-bolder font-size-h4 text-right">0</span>
    <input type="hidden" id="thp" name="pengajuandana_thp" value="0">
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
      <p class="font-weight-bolder font-size-h4 text-right">Penandatangan</p>
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" name="pengajuandana_ttd">
    </div>
</div>
<div class="row mt-5 mb-5">
    <div class="col-md-9">
    </div>
    <div class="col-md-3">
        <button class="btn btn-md btn-success checkout" style="float:right;">
            Buat Pengajuan Dana
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

 @foreach($kategoripengajuan as $katper)
<script>
var wrapper{{str_replace(' ', '', $katper->catpengajuan_nama)}} = $('#wrapper{{str_replace(' ', '', $katper->catpengajuan_nama)}}'); //Fields wrapper
var {{str_replace(' ', '', $katper->catpengajuan_nama)}} = 0; //initlal text box count 
var subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}} = $('#subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}}');

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

function tambah{{str_replace(' ', '', $katper->catpengajuan_nama)}}(harga){
    subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}} = subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}}+(harga*1)
    subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}}.innerHTML = formatter.format(subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}});

}
function kurang{{str_replace(' ', '', $katper->catpengajuan_nama)}}(harga){
    subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}} = subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}}-(harga*1)
    subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}}.innerHTML = formatter.format(subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}});


}

function sumpen() {
    var inputs = $('.totpen'),
        result = $('#subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}}'),
        sum = 0;

        for(var i=0;i<inputs.length;i++){
        if(parseInt(inputs[i].value))
            sum += parseInt(inputs[i].value) || 0;
    }

    result.html(formatter.format(sum));
    subtotal{{str_replace(' ', '', $katper->catpengajuan_nama)}}.attr("data-subtotpen", sum);
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

var formatter = new Intl.NumberFormat('id-ID', {style: 'currency',currency: 'IDR',});

$("#create{{str_replace(' ', '', $katper->catpengajuan_nama)}}").on("click", function(e){ //user click on remove text
e.preventDefault();
penname = document.getElementById('nama{{str_replace(' ', '', $katper->catpengajuan_nama)}}field').value;
pen = document.getElementById('jumlah{{str_replace(' ', '', $katper->catpengajuan_nama)}}field').value;
if(pen == ''){
{{str_replace(' ', '', $katper->catpengajuan_nama)}} = 0;
}else {
{{str_replace(' ', '', $katper->catpengajuan_nama)}} = pen;
}

wrapper{{str_replace(' ', '', $katper->catpengajuan_nama)}}.append(`<tr id="pen${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}">
<td class="d-flex align-items-center font-weight-bolder">
<a class="text-dark text-hover-primary">${penname}</a>
</td>
<td class="text-right align-middle font-weight-bolder font-size-h5" id="pen${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}" data-pen="${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}">${formatter.format({{str_replace(' ', '', $katper->catpengajuan_nama)}})}</td>
<td class="text-right align-middle">
<button class="btn btn-xs btn-danger remove_{{str_replace(' ', '', $katper->catpengajuan_nama)}} btn-icon" data-idpen="${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}" data-kurpen="${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}">
<i class="fas fa-trash"></i>
</button>
</td>
</tr>`);
wrapper{{str_replace(' ', '', $katper->catpengajuan_nama)}}.append(`<input id="PN${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}" type="hidden" name="{{str_replace(' ', '', $katper->catpengajuan_nama)}}name[]" value="${penname}">`);
wrapper{{str_replace(' ', '', $katper->catpengajuan_nama)}}.append(`<input id="PT${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}" type="hidden" class="totpen" name="{{str_replace(' ', '', $katper->catpengajuan_nama)}}total[]" value="${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}">`);
{{str_replace(' ', '', $katper->catpengajuan_nama)}}++
tambah{{str_replace(' ', '', $katper->catpengajuan_nama)}}(pen);
total = total+parseInt({{str_replace(' ', '', $katper->catpengajuan_nama)}})
document.getElementById('total').innerHTML = formatter.format(total);
$('#PT'+{{str_replace(' ', '', $katper->catpengajuan_nama)}}).val(total);
sumpen();
sumtot();
})


$(wrapper{{str_replace(' ', '', $katper->catpengajuan_nama)}}).on("click",".remove_field", function(e){ //user click on remove text
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

</script>
@endforeach
{{-- <script> 
var max_fields = 100; //maximum input boxes allowed 
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

$("#createpotongan").on("click", function(e){ //user click on remove text
e.preventDefault();
potname = document.getElementById('namapotonganfield').value;
pot = document.getElementById('jumlahpotonganfield').value;
if(pot == ''){
potongan = 0;
}else {
potongan = pot;
}

wrapperpotongan.append(`<tr id="P${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}">
<td class="d-flex align-items-center font-weight-bolder">
<a href="#" class="text-dark text-hover-primary">${potname}</a>
</td>
<td class="text-right align-middle font-weight-bolder font-size-h5" id="pot${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}" data-pot="${potongan}">${formatter.format(potongan)}</td>
<td class="text-right align-middle">
<button class="btn btn-xs btn-danger remove_potongan btn-icon" data-idpot="${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}" data-kurpot="${potongan}">
<i class="fas fa-trash"></i>
</button>
</td>
</tr>`);
wrapperpotongan.append(`<input id="DN${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}" type="hidden" name="potonganname[]" value="${potname}">`);
wrapperpotongan.append(`<input id="DT${{{str_replace(' ', '', $katper->catpengajuan_nama)}}}" type="hidden" class="totpotbrg" name="potongantotal[]" value="${potongan}">`);
y++
tambahpotongan(pot);
total = total-parseInt(potongan)
document.getElementById('total').innerHTML = formatter.format(total);
$('#DT'+y).val(total);
sumpot();
sumtot();
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
produk = this.getAttribute('data-idproduct');
   $.ajax({
   url: '/apigaji/apideletepen',
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

</script> --}}
@endsection
@endsection
