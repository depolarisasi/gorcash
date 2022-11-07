@extends('layouts.app')
@section('title','Ubah - ')
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
<div class="col-lg-12">
<!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
<!--begin::Header-->
<div class="card-header border-0 py-5">
<h3 class="card-title align-items-start flex-column">
<span class="card-label font-weight-bolder text-dark">Data Diri Karyawan</span>
</h3>

<div class="card-toolbar">
  <a href="{{url('profil-karyawan/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
  </div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('profil-karyawan/update')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="karyawan_id" value="{{$edit->karyawan_id}}">
        <div class="form-group row mt-4">
          <label class="col-md-2">Nama</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_nama" value="{{$edit->karyawan_nama}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">Tempat Lahir</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_tempatlahir" value="{{$edit->karyawan_tempatlahir}}">
          </div>
        </div>
        <div class="form-group row mt-4">
         <label class="col-md-2">Tanggal Lahir</label>
         <div class="col-md-4">
             <input class="form-control" type="date" name="karyawan_tanggallahir" value="{{$edit->karyawan_tanggallahir}}">
         </div>
       </div>
       <div class="form-group row mt-4">
          <label class="col-md-2">Kewarganegaraan</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan" value="{{$edit->karyawan_kewarganegaraan}}">
          </div>
        </div>
        <div class="form-group row mt-4">
                    <label class="col-md-2">Jenis Kelamin</label>
                    <div class="col-md-4">
                      <select class="form-control" name="karyawan_kelamin" required>
                      <option value="Laki-laki" @if($edit->karyawan_kelamin == "Laki-laki") selected="selected" @endif>Laki-laki</option>
                      <option value="Perempuan" @if($edit->karyawan_kelamin == "Perempuan") selected="selected" @endif>Perempuan</option>
                      </select>
                    </div>
                  </div>
      <div class="form-group row mt-4">
              <label class="col-md-2">Jabatan</label>
      <div class="col-md-4">
        <select class="form-control" name="karyawan_jabatan" required>
        <option value="Kasir" @if($edit->karyawan_jabatan == "Kasir") selected="selected" @endif>Kasir</option>
        <option value="Kepala Gudang" @if($edit->karyawan_jabatan == "Kepala Gudang") selected="selected" @endif>Kepala Gudang</option>
        <option value="Staff Gudang" @if($edit->karyawan_jabatan == "Staff Gudang") selected="selected" @endif>Staff Gudang</option>
        <option value="Akuntan" @if($edit->karyawan_jabatan == "Akuntan") selected="selected" @endif>Akuntan</option>
        <option value="Marketplace" @if($edit->karyawan_jabatan == "Marketplace") selected="selected" @endif>Marketplace</option>
        <option value="Social Media" @if($edit->karyawan_jabatan == "Social Media") selected="selected" @endif>Social Media</option>
        <option value="Fotografer" @if($edit->karyawan_jabatan == "Fotografer") selected="selected" @endif>Fotografer</option>
        <option value="Manajer" @if($edit->karyawan_jabatan == "Manajer") selected="selected" @endif>Manajer</option>
        </select>
      </div>
    </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">Nomor Induk Karyawan</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_noinduk" value="{{$edit->karyawan_noinduk}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">No KTP</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_nik" value="{{$edit->karyawan_nik}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">No BPJS</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_bpjs" value="{{$edit->karyawan_bpjs}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Email</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_email" value="{{$edit->karyawan_email}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >No HP</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_nohp" value="{{$edit->karyawan_nohp}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Alamat Domisili</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_alamatsekarang" value="{{$edit->karyawan_alamatsekarang}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Kota Domisili</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_kotasekarang" value="{{$edit->karyawan_kotasekarang}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Provinsi Domisili</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_provinsisekarang" value="{{$edit->karyawan_provinsisekarang}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Alamat KTP</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_alamatktp" value="{{$edit->karyawan_alamatktp}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Kota KTP</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_kotaktp" value="{{$edit->karyawan_kotaktp}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Provinsi KTP</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_provinsiktp" value="{{$edit->karyawan_provinsiktp}}">
          </div>
        </div>

        <div class="form-group row mt-4">
            <label class="col-md-2">Status Perkawinan</label>
            <div class="col-md-4">
                <select class="multisteps-form__input form-control" name="karyawan_status">
                <option value="Belum Kawin" @if($edit->karyawan_status == "Belum Kawin") selected="selected" @endif>Belum Kawin</option>
                <option value="Kawin, Belum Punya Anak" @if($edit->karyawan_status == "Kawin, Belum Punya Anak") selected="selected" @endif>Kawin, Belum Punya Anak</option>
                <option value="Kawin, 1 Anak" @if($edit->karyawan_status == "Kawin, 1 Anak") selected="selected" @endif>Kawin, 1 Anak</option>
                <option value="Kawin, 2 Anak" @if($edit->karyawan_status == "Kawin, 2 Anak") selected="selected" @endif>Kawin, 2 Anak</option>
                <option value="Kawin, 3 Anak" @if($edit->karyawan_status == "Kawin, 3 Anak") selected="selected" @endif>Kawin, 3 Anak</option>
              </select>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Agama</label>
            <div class="col-md-4">
                <select class="multisteps-form__input form-control" name="karyawan_agama">
                <option value="Islam" @if($edit->karyawan_agama == "Islam") selected="selected" @endif>Islam</option>
                <option value="Katolik" @if($edit->karyawan_agama == "Katolik") selected="selected" @endif>Katolik</option>
                <option value="Kristen" @if($edit->karyawan_agama == "Kristen") selected="selected" @endif>Kristen</option>
                <option value="Hindu" @if($edit->karyawan_agama == "Hindu") selected="selected" @endif>Hindu</option>
                <option value="Budha" @if($edit->karyawan_agama == "Budha") selected="selected" @endif>Budha</option>
                <option value="Lain-lain" @if($edit->karyawan_agama == "Lain-lain") selected="selected" @endif>Lain-lain</option>
              </select>
            </div>
          </div>
    <div class="form-group row mt-4">
          <label class="col-md-2" >Nama Bank</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_namabank" value="{{$edit->karyawan_namabank}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Cabang Bank</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_cabangbank" value="{{$edit->karyawan_cabangbank}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Nomor Rekening Bank</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_norekbank" value="{{$edit->karyawan_norekbank}}">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Nama Rekening Bank</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_namarekbank" value="{{$edit->karyawan_namarekbank}}">
          </div>
        </div>


</div>
</div>
<!--end::Body-->
</div>
<!--end::Advance Table Widget 4-->
</div>

<div class="col-lg-12">
  <!--begin::Advance Table Widget 4-->
  <div class="card card-custom card-stretch gutter-b">
  <!--begin::Header-->
  <div class="card-header border-0 py-5">
  <h3 class="card-title align-items-start flex-column">
  <span class="card-label font-weight-bolder text-dark">Pendidikan</span>
  </h3>
  </div>
  <!--end::Header-->

  <!--begin::Body-->
  <div class="card-body pt-0 pb-3">
  <div class="tab-content">
          <div class="form-group row mt-4">
            <label class="col-md-2">Pendidikan Terakhir</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_pendidikanterakhir" value="{{$edit->karyawan_pendidikanterakhir}}">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">
              <span class="card-label col-md-4 font-weight-bolder text-dark">Rangkuman Pendidikan</span></label>

          </div>
          <div class="form-group row mt-4">
           <label class="col-md-2">Sekolah / Universitas / Institusi</label>
           <div class="col-md-4">
               <input class="form-control" type="text" name="karyawan_pendidikan1" value="{{$edit->karyawan_pendidikan1}}"/>
           </div>
           <label class="col-md-2">Tahun Lulus</label>
           <div class="col-md-4">
           <input id="name" type="text" class="form-control" name="karyawan_tahunpendidikan1" value="{{$edit->karyawan_tahunpendidikan1}}">
           </div>
         </div>

          <div class="form-group row mt-4">
            <label class="col-md-2">Jurusan / Konsentrasi</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_jurusanpendidikan1" value="{{$edit->karyawan_jurusanpendidikan1}}">
            </div>
            <label class="col-md-2">Kualifikasi Pendidikan</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kualifikasipendidikan1" value="{{$edit->karyawan_kualifikasipendidikan1}}">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label class="col-md-2">Sekolah / Universitas / Institusi</label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="karyawan_pendidikan2" value="{{$edit->karyawan_pendidikan2}}"/>
            </div>
            <label class="col-md-2">Tahun Lulus</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_tahunpendidikan2" value="{{$edit->karyawan_tahunpendidikan2}}">
            </div>
          </div>

           <div class="form-group row mt-4">
             <label class="col-md-2">Jurusan / Konsentrasi</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_jurusanpendidikan2" value="{{$edit->karyawan_jurusanpendidikan2}}">
             </div>
             <label class="col-md-2">Kualifikasi Pendidikan</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_kualifikasipendidikan2" value="{{$edit->karyawan_kualifikasipendidikan2}}">
             </div>
           </div>

             <div class="form-group row mt-4">
             <label class="col-md-2">Bahasa 1</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_bahasa1" value="{{$edit->karyawan_bahasa1}}">
             </div>

           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Mendengar Bahasa 1</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_mendengarbahasa1" value="{{$edit->karyawan_mendengarbahasa1}}">
             </div>
            <label class="col-md-2">Berbicara Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_berbicarabahasa1" value="{{$edit->karyawan_berbicarabahasa1}}">
            </div>
          </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Membaca Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_membacabahasa1" value="{{$edit->karyawan_membacabahasa1}}">
            </div>
            <label class="col-md-2">Menulis Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_menulisbahasa1" value="{{$edit->karyawan_menulisbahasa1}}">
            </div>
          </div>

          <div class="form-group row mt-4">
             <label class="col-md-2">Bahasa 2</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_bahasa2" value="{{$edit->karyawan_bahasa2}}">
             </div>

           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Mendengar Bahasa 2</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_mendengarbahasa2" value="{{$edit->karyawan_mendengarbahasa2}}">
             </div>
            <label class="col-md-2">Berbicara Bahasa 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_berbicarabahasa2" value="{{$edit->karyawan_berbicarabahasa2}}">
            </div>
          </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Membaca Bahasa 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_membacabahasa2" value="{{$edit->karyawan_membacabahasa2}}">
            </div>
            <label class="col-md-2">Menulis Bahasa 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_menulisbahasa2" value="{{$edit->karyawan_menulisbahasa2}}">
            </div>
          </div>


  </div>
  </div>
  <!--end::Body-->
  </div>
  <!--end::Advance Table Widget 4-->
  </div>

<div class="col-lg-12">
  <!--begin::Advance Table Widget 4-->
  <div class="card card-custom card-stretch gutter-b">
  <!--begin::Header-->
  <div class="card-header border-0 py-5">
  <h3 class="card-title align-items-start flex-column">
  <span class="card-label font-weight-bolder text-dark">Riwayat Bekerja & Informasi Lain</span>
  </h3>
  </div>
  <!--end::Header-->

  <!--begin::Body-->
  <div class="card-body pt-0 pb-3">
  <div class="tab-content">

          <div class="form-group row mt-4">
           <label class="col-md-2">Perusahaan 1</label>
           <div class="col-md-4">
               <input class="form-control" type="text" name="karyawan_employment1" value="{{$edit->karyawan_employment1}}"/>
           </div>
           <label class="col-md-2">Periode Perusahaan 1</label>
           <div class="col-md-4">
           <input id="name" type="text" class="form-control" name="karyawan_employmentperiode1" value="{{$edit->karyawan_employmentperiode1}}">
           </div>
         </div>

          <div class="form-group row mt-4">
            <label class="col-md-2">Jabatan Perusahaan 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_employmentjabatan1" value="{{$edit->karyawan_employmentjabatan1}}">
            </div>
            <label class="col-md-2">Gaji Perusahaan 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_employmentgaji1" value="{{$edit->karyawan_employmentgaji1}}">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label class="col-md-2">Perusahaan 2</label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="karyawan_employment2" value="{{$edit->karyawan_employment2}}"/>
            </div>
            <label class="col-md-2">Periode Perusahaan 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_employmentperiode2" value="{{$edit->karyawan_employmentperiode2}}">
            </div>
          </div>

           <div class="form-group row mt-4">
             <label class="col-md-2">Jabatan Perusahaan 2</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_employmentjabatan2" value="{{$edit->karyawan_employmentjabatan2}}">
             </div>
             <label class="col-md-2">Gaji Perusahaan 2</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_employmentgaji2" value="{{$edit->karyawan_employmentgaji2}}">
             </div>
           </div>

           <div class="form-group row mt-4">
            <label class="col-md-2">Penyakit / Cacat yang menggangu bekerja</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_cacat" value="{{$edit->karyawan_cacat}}">
            </div>
           </div>


           <div class="form-group row mt-4">
            <label class="col-md-2">Hari tertentu yang tidak bisa bekerja</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_haritertentu" value="{{$edit->karyawan_haritertentu}}">
            </div>
           </div>

           <div class="form-group row mt-4">
            <label class="col-md-2">Perokok / Tidak</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_merokok" value="{{$edit->karyawan_merokok}}">
            </div>
           </div>

           <div class="form-group row mt-4">
            <label class="col-md-2">Pernah Dihukum / Ditahan</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_pernahdihukum" value="{{$edit->karyawan_pernahdihukum}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Pernah Diberhentikan / PHK </label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_pernahdiberhentikan" value="{{$edit->karyawan_pernahdiberhentikan}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Jenis SIM (isi dengan koma apabila lebih dari 1)</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_jenissim" value="{{$edit->karyawan_jenissim}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Tahun Berakhir SIM (isi dengan koma apabila lebih dari 1)</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_berlakusim" value="{{$edit->karyawan_berlakusim}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Nama Ayah</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_namaayah" value="{{$edit->karyawan_namaayah}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Alamat Ayah</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_alamatayah" value="{{$edit->karyawan_alamatayah}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Telp Ayah</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_telpayah" value="{{$edit->karyawan_telpayah}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Nama Ibu</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_namaibu" value="{{$edit->karyawan_namaibu}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Alamat Ibu</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_alamatibu" value="{{$edit->karyawan_alamatibu}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Telp Ibu</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_telpibu" value="{{$edit->karyawan_telpibu}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Nama Saudara</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_namasdr" value="{{$edit->karyawan_namasdr}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Alamat Saudara</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_telpsdr" value="{{$edit->karyawan_telpsdr}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Telp Saudara</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_alamatsdr" value="{{$edit->karyawan_alamatsdr}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Nama Kontak Darurat</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kontakdrt1" value="{{$edit->karyawan_kontakdrt1}}">
            </div>
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Telp Kontak Darurat</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_nokontakdrt1" value="{{$edit->karyawan_nokontakdrt1}}">
            </div>
           </div>
            <div class="form-group row mt-4">
                       <label class="col-md-2">Pas Foto</label>
                       <div class="col-md-4">
                       <img src="{{asset($edit->karyawan_foto)}}" class="img-fluid w-50 h-75">
            <div class="custom-file">
                <input  class="custom-file-input" name="karyawan_foto" id="pasfoto" accept="image/*" type="file"/>
                <label class="custom-file-label" for="pasfoto">Choose file</label>
               </div>
                       </div>
                     </div>
         <div class="form-group row mt-4">
        <label class="col-md-2">Scan / Foto KTP</label>
        <div class="col-md-4">
        <img src="{{asset($edit->karyawan_fotoktp)}}" class="img-fluid w-50 h-75">
          <div class="custom-file">
              <input  class="custom-file-input" name="karyawan_fotoktp" id="fotoktp" accept="image/*" type="file"/>
              <label class="custom-file-label" for="fotoktp">Choose file</label>
             </div>
        </div>
      </div>
        <div class="form-group row mt-4">
          <div class="col-md-6">
      <button class="btn btn-md btn-primary" type="submit">Ubah Pengguna</button>
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
