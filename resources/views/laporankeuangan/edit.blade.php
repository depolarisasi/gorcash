@extends('layouts.app')
@section('title','Laporan Keuangan Baru - ')
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
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Laporan Keuangan Baru</span>
</h3>
<div class="card-toolbar">
<a href="{{url('surat/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('laporankeuangan/store')}}">
        @csrf
        <div class="form-group row mt-4">
            <label class="col-md-2">Tahun Laporan Keuangan</label>
            <div class="col-md-3">
            <select class="multisteps-form__input form-control" name="laporankeuangan_tahun" > 
            <option value="2022" @if($edit->laporankeuangan_tahun == "2022") selected="selected" @endif>2022</option>
            <option value="2023" @if($edit->laporankeuangan_tahun == "2023") selected="selected" @endif>2023</option>
            <option value="2024" @if($edit->laporankeuangan_tahun == "2024") selected="selected" @endif>2024</option>
            <option value="2025" @if($edit->laporankeuangan_tahun == "2025") selected="selected" @endif>2025</option>
            <option value="2026" @if($edit->laporankeuangan_tahun == "2026") selected="selected" @endif>2026</option>
            <option value="2027" @if($edit->laporankeuangan_tahun == "2027") selected="selected" @endif>2027</option>
            <option value="2028" @if($edit->laporankeuangan_tahun == "2028") selected="selected" @endif>2028</option>
            <option value="2029" @if($edit->laporankeuangan_tahun == "2029") selected="selected" @endif>2029</option>
            <option value="2030" @if($edit->laporankeuangan_tahun == "2030") selected="selected" @endif>2030</option>

          </select>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Bulan Laporan Keuangan</label>
            <div class="col-md-3">
            <select class="multisteps-form__input form-control" name="laporankeuangan_bulan" >  
              <option value="January" @if($edit->laporankeuangan_bulan == "January") selected="selected" @endif>January</option>
              <option value="February" @if($edit->laporankeuangan_bulan == "February") selected="selected" @endif>February</option>
              <option value="March" @if($edit->laporankeuangan_bulan == "March") selected="selected" @endif>March</option> 
              <option value="April" @if($edit->laporankeuangan_bulan == "April") selected="selected" @endif>April</option>
              <option value="May" @if($edit->laporankeuangan_bulan == "May") selected="selected" @endif>May</option>
              <option value="June" @if($edit->laporankeuangan_bulan == "June") selected="selected" @endif>June</option>
              <option value="July" @if($edit->laporankeuangan_bulan == "July") selected="selected" @endif>July</option>
              <option value="August" @if($edit->laporankeuangan_bulan == "August") selected="selected" @endif>August</option>
              <option value="September" @if($edit->laporankeuangan_bulan == "September") selected="selected" @endif>September</option>
              <option value="October" @if($edit->laporankeuangan_bulan == "October") selected="selected" @endif>October</option>
              <option value="November" @if($edit->laporankeuangan_bulan == "November") selected="selected" @endif>November</option>
              <option value="December" @if($edit->laporankeuangan_bulan == "December") selected="selected" @endif>December</option> 
          </select>
            </div>
          </div> 
        <div class="form-group row mt-4">
            <label class="col-md-2">Nama Laporan Keuangan</label>
            <div class="col-md-3">
            <input id="name" type="text" class="form-control" name="laporankeuangan_nama" value="{{$edit->laporankeuangan_nama}}">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Link Laporan Keuangan</label>
            <div class="col-md-3">
            <input id="name" type="text" class="form-control" name="laporankeuangan_link" value="{{$edit->laporankeuangan_link}}">
            </div>
          </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Ubah Laporan Keuangan</button>
        </div>
    </div>

      </form>
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
@endsection
