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
            <select class="multisteps-form__input form-control" name="laporankeuangan_tahun" required> 
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
          <div class="form-group row mt-4">
            <label class="col-md-2">Bulan Laporan Keuangan</label>
            <div class="col-md-3">
            <select class="multisteps-form__input form-control" name="laporankeuangan_bulan" required> 
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
            <label class="col-md-2">Nama Laporan Keuangan</label>
            <div class="col-md-3">
            <input id="name" type="text" class="form-control" name="laporankeuangan_nama"  required autofocus>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Link Laporan Keuangan</label>
            <div class="col-md-3">
            <input id="name" type="text" class="form-control" name="laporankeuangan_link"  required autofocus>
            </div>
          </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Tambah Laporan Keuangan</button>
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
