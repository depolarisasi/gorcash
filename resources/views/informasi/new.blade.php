@extends('layouts.app')
@section('title','Informasi Baru - ')
@section('css')
<link rel="stylesheet" type="text/css" id="mce-u0" href="{{asset('assets/js/tinymce/skins/ui/oxide/skin.min.css')}}">
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
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Informasi Baru</span>
</h3>
<div class="card-toolbar">
<a href="{{url('informasi/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('informasi/store')}}">
        @csrf
        <div class="form-group row mt-4">
            <label class="col-md-2">Nama Informasi</label>
            <div class="col-md-6">
            <input type="hidden" name="informasi_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            <input type="text" class="form-control" name="informasi_judul" required autofocus>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Isi Informasi</label>
            <div class="col-md-10">
                <textarea id="noteisi" name="informasi_isi"></textarea>
            </div>
          </div>



      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Tambah Informasi</button>
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
@section('js')
<script src="{{asset('assets/js/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
<script>
   tinymce.init({
            selector: '#noteisi',
            menubar: false,
            toolbar: ['styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic forecolor backcolor | link image | alignleft aligncenter alignright alignjustify',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol'],
            plugins : 'advlist autolink link image lists charmap print preview code forecolor backcolor table'
        });
    </script>
@endsection
@endsection
