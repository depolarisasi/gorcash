@extends('layouts.app')
@section('title','Detail User - ')
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
<span class="card-label font-weight-bolder text-dark">Informasi Pengguna</span>
</h3>
<div class="card-toolbar">
<a href="{{url('user/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <p><b>Nama </b> : {{$show->name}} </p>
</br>
    <p><b>Email </b> : {{$show->email}} </p>

</br>
    <p><b>Jabatan </b> :
        @if($show->role == 1)
        <span class="label label-lg label-rounded label-danger label-jabatan">Admin Owner</span>
        @elseif($show->role == 2)
        <span class="label label-lg label-rounded label-primary label-jabatan">Online</span>
        @endif
        @elseif($show->role == 3)
        <span class="label label-lg label-rounded label-primary label-jabatan">Sosmed</span>
        @endif
        @elseif($show->role == 4)
        <span class="label label-lg label-rounded label-primary label-jabatan">Gudang</span>
        @elseif($show->role == 5)
        <span class="label label-lg label-rounded label-primary label-jabatan">Kasir</span>
        @elseif($show->role == 6)
        <span class="label label-lg label-rounded label-primary label-jabatan">Administrator</span>
        @endif</p>

</br>
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
