@extends('layouts.app')
@section('title','Ubah Slip Gaji - ')
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
<span class="card-label font-weight-bolder font-size-h3 text-dark">Ubah Slip Gaji {{$edit->name}} {{$edit->slipgaji_bulan}} {{$edit->slipgaji_tahun}}</span>
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
                        <p>@if($edit) {{$edit->karyawan_nama}} @endif</p>
                  </div>
                </div>
                <input type="hidden" name="slipgaji_karyawanid" value="{{Request::get('k')}}">
                  <div class="form-group row mt-4">
                    <label class="col-md-4"><b>No Induk Karyawan</b></label>
                    <div class="col-md-8">
                    <p>@if($edit) {{$edit->karyawan_noinduk}} @endif</p>
                    </div>
                  </div>
                  <div class="form-group row mt-4">
                    <label class="col-md-4"><b>Jabatan</b></label>
                    <div class="col-md-8">
                    <p>@if($edit) {{$edit->karyawan_jabatan}} @endif</p>
                    </div>
                  </div>
                </div>
            <div class="col-md-6">
                <div class="form-group row mt-4">
                    <label class="col-md-4"><b>Lama Bekerja</b></label>
                    <div class="col-md-8">
                        @if($edit)
                    @php
        $time = \Carbon\Carbon::now()->diff($edit->karyawan_tanggalbekerja);
        @endphp
                    <p>{{$time->y}} Tahun, {{$time->m}} Bulan, {{$time->d}} Hari</p>
                    @endif
                    </div>
                  </div>
                    <div class="form-group row mt-4">
                        <label class="col-md-4"><b>Bulan Gaji</b></label>
                        <div class="col-md-8">
                            <p>@if($edit) {{$edit->slipgaji_bulan}} @endif</p>
                        </div>
                      </div>
                      <div class="form-group row mt-4">
                        <label class="col-md-4"><b>Tahun Gaji</b></label>
                        <div class="col-md-8">
                            <p>@if($edit) {{$edit->slipgaji_tahun}} @endif</p>
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
    @php
     $cp = 0;
     $penerimaan = 0;
     @endphp
    @foreach($komponenpenerimaan as $kp)
<tr id="pen{{$cp}}" data-old="1">
        <td class="d-flex align-items-center font-weight-bolder">
        <a class="text-dark text-hover-primary">{{$kp->gaji_komponen}}</a>
        </td>
        <td class="text-right align-middle font-weight-bolder font-size-h5" id="pen{{$cp}}" data-pen="{{$kp->gaji_jumlah}}">@money($kp->gaji_jumlah)</td>
        <td class="text-right align-middle">
        <button class="btn btn-xs btn-danger remove_penerimaan btn-icon" id="delpen{{$cp}}" data-existing="1" data-idpen="{{$cp}}" data-idpenerimaan="{{$kp->gaji_id}}" data-idslip="{{$kp->gaji_slipid}}" data-kurpen="{{$kp->gaji_jumlah}}">
        <i class="fas fa-trash"></i>
        </button>
        </td>
        </tr>
    <input id="PN{{$cp}}" type="hidden" name="penerimaanname[]" value="{{$kp->gaji_komponen}}">
    <input id="PT{{$cp}}" type="hidden" class="totpen" name="penerimaantotal[]" value="{{$kp->gaji_jumlah}}">

    @php
     $cp++;
     $penerimaan = $penerimaan+$kp->gaji_jumlah;
     @endphp
    @endforeach
</tbody>
</table>
<div class="table-responsive">
    <table class="table">
    <!--begin::Cart Header-->

    <!--end::Cart Header-->
    <tbody>
    <tr>
    <td colspan="2"></td>
    <td class="font-weight-bolder font-size-h4 text-right">Subtotal <span id="subtotalpenerimaan" data-subtotpen="{{$penerimaan}}">@money($penerimaan)</span></td>
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
        @php
        $cpot = 0;
        $potongan = 0;
        @endphp
       @foreach($komponenpotongan as $kp)
       <tr id="P{{$cpot}}" data-old="1">
        <td class="d-flex align-items-center font-weight-bolder">
        <a href="#" class="text-dark text-hover-primary">{{$kp->gaji_komponen}}</a>
        </td>
        <td class="text-right align-middle font-weight-bolder font-size-h5" id="pot{{$cpot}}" data-pot="{{$kp->gaji_jumlah}}">@money($kp->gaji_jumlah)</td>
        <td class="text-right align-middle"> 
        <button class="btn btn-xs btn-danger remove_potongan btn-icon" data-idpot="{{$cpot}}" data-existing="1"  data-idpotongan="{{$kp->gaji_id}}" data-kurpot="{{$kp->gaji_jumlah}}">
        <i class="fas fa-trash"></i>
        </button>
        </td>
        </tr>
        <input id="DN{{$cpot}}" type="hidden" name="potonganname[]" value="{{$kp->gaji_komponen}}">
        <input id="DT{{$cpot}}" type="hidden" class="totpotbrg" name="potongantotal[]" value="{{$kp->gaji_jumlah}}">
       @php
        $cpot++;
        $potongan = $potongan+$kp->gaji_jumlah;
        @endphp
       @endforeach
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
    <td class="font-weight-bolder font-size-h4 text-right">Subtotal <span id="subtotalpotongan" data-subtotpot="{{$potongan}}">@money($potongan)</span></td>
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
        <span id="total" data-total="0" class="font-weight-bolder font-size-h4 text-right">@money($penerimaan-$potongan)</span>
    <input type="hidden" id="thp" name="slipgaji_thp" value="{{$penerimaan-$potongan}}">
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
var x = {{$c_pen}}; //initlal text box count
var y = {{$c_pot}}; //initlal text box count
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

wrapperpotongan.append(`<tr id="P${y}">
<td class="d-flex align-items-center font-weight-bolder">
<a href="#" class="text-dark text-hover-primary">${potname}</a>
</td>
<td class="text-right align-middle font-weight-bolder font-size-h5" id="pot${y}" data-pot="${potongan}">${formatter.format(potongan)}</td>
<td class="text-right align-middle">
<button class="btn btn-xs btn-danger remove_potongan btn-icon" id="delpot${x}" data-existing="0" data-idpot="${y}" data-kurpot="${potongan}">
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

wrapperpenerimaan.append(`<tr id="pen${x}" data-old="0">
<td class="d-flex align-items-center font-weight-bolder">
<a class="text-dark text-hover-primary">${penname}</a>
</td>
<td class="text-right align-middle font-weight-bolder font-size-h5" id="pen${x}" data-pen="${penerimaan}">${formatter.format(penerimaan)}</td>
<td class="text-right align-middle">
<button class="btn btn-xs btn-danger remove_penerimaan btn-icon"  id="delpen${x}" data-existing="0" data-idpen="${x}" data-kurpen="${penerimaan}">
<i class="fas fa-trash"></i>
</button>
</td>
</tr>`);
wrapperpenerimaan.append(`<input id="PN${x}" type="hidden" name="penerimaanname[]" value="${penname}">`);
wrapperpenerimaan.append(`<input id="PT${x}" type="hidden" class="totpen" name="penerimaantotal[]" value="${penerimaan}">`);
x++
tambahpenerimaan(pen);
total = total+parseInt(penerimaan)
document.getElementById('total').innerHTML = formatter.format(total);
$('#PT'+x).val(total);
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
idpotongan = this.getAttribute('data-idpotongan');
idslip = this.getAttribute('data-idslip');
existing = this.getAttribute('data-existing');
if(existing == "1") {
    $.ajax({
   url: '/gajiapi/apideletepot',
   type: 'POST',
   data: {
     _token :  "{{csrf_token()}}",
      gaji_id: idpenerimaan,
      gaji_idslip: idslip,
        },
       success: function(data){
        kurangpotongan($('#delpot'+idpot).attr('data-kurpot'));
total = total+parseInt($('#delpot'+idpot).attr('data-kurpot'));
document.getElementById('total').innerHTML = formatter.format(total);
$('#delpot'+idpot).parent().parent('tr').remove();
$('#DN'+idpot).remove();
$('#DT'+idpot).remove();
sumpot();
sumtot();
y--;
        },
     error: function(data) {
        console.log('Cannot retrieve data.');
         }
    });
}else {
kurangpotongan(this.getAttribute('data-kurpot'));
total = total+parseInt(this.getAttribute('data-kurpot'));
document.getElementById('total').innerHTML = formatter.format(total);
$(this).parent().parent('tr').remove();
$('#DN'+idpot).remove();
$('#DT'+idpot).remove();
sumpot();
sumtot();
y--;

}

})

$(wrapperpenerimaan).on("click",".remove_penerimaan", function(e){ //user click on remove text
e.preventDefault();
idpen = this.getAttribute('data-idpen');
idpenerimaan = this.getAttribute('data-idpenerimaan');
idslip = this.getAttribute('data-idslip');
existing = this.getAttribute('data-existing');
if(existing == "1") {
    $.ajax({
   url: '/gajiapi/apideletepen',
   type: 'POST',
   data: {
     _token :  "{{csrf_token()}}",
      gaji_id: idpenerimaan,
      gaji_idslip: idslip,
        },
       success: function(data){
kurangpenerimaan($('#delpen'+idpen).attr('data-kurpen'));
total = total-parseInt($('#delpen'+idpen).attr('data-kurpen'));
document.getElementById('total').innerHTML = formatter.format(total);

$('#delpen'+idpen).parent().parent('tr').remove();
$('#PN'+idpen).remove();
$('#PT'+idpen).remove();

sumpen();
sumtot();
x--;
        },
     error: function(data) {
        console.log('Cannot retrieve data.');
         }
    });
}else {
    kurangpenerimaan(this.getAttribute('data-kurpen'));
total = total-parseInt(this.getAttribute('data-kurpen'));
document.getElementById('total').innerHTML = formatter.format(total);

$(this).parent().parent('tr').remove();
$('#PN'+idpen).remove();
$('#PT'+idpen).remove();

sumpen();
sumtot();
x--;
}



})

</script>
@endsection
@endsection
