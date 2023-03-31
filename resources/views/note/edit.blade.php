@extends('layouts.app')
@section('title','Ubah Note - ')
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
<span class="card-label font-weight-bolder text-dark">Ubah Note</span>
</h3>
<div class="card-toolbar">
<a href="{{url('note/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('note/update')}}">
        @csrf
        <div class="form-group row mt-4">
            <label class="col-md-2">Nama Note</label>
            <input type="hidden" name="note_id" value="{{$edit->note_id}}">
            <div class="col-md-6">
            <input type="text" class="form-control" name="note_judul" value="{{$edit->note_judul}}" required autofocus>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Isi Note</label>
            <div class="col-md-10">
                <textarea id="noteisi" name="note_isi">{!! $edit->note_isi !!}</textarea>
            </div>
          </div>

      <div class="form-group row mt-4">
        <div class="col-md-6">
    <button class="btn btn-md btn-primary" type="submit">Ubah Note</button>
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
    var editor_config = {
       path_absolute : "/",
       selector: '#noteisi',
       relative_urls: false,
       plugins: [
         "advlist autolink lists link image charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen",
         "insertdatetime media nonbreaking save table directionality",
         "emoticons template paste textpattern"
       ],
       toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
       file_picker_callback : function(callback, value, meta) {
         var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
         var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

         var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
         if (meta.filetype == 'image') {
           cmsURL = cmsURL + "&type=Images";
         } else {
           cmsURL = cmsURL + "&type=Files";
         }

         tinyMCE.activeEditor.windowManager.openUrl({
           url : cmsURL,
           title : 'Filemanager',
           width : x * 0.8,
           height : y * 0.8,
           resizable : "yes",
           close_previous : "no",
           onMessage: (api, message) => {
             callback(message.content);
           }
         });
       }
     };
     tinymce.init(editor_config);
     </script>
@endsection
@endsection
