@extends('layouts.app')
@section('title','Karyawan Baru - ')
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
  <a href="{{url('karyawan/')}}" class="btn btn-primary btn-md font-size-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
  </div>
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('karyawan/store')}}" enctype="multipart/form-data">
        @csrf  
        <div class="form-group row mt-4">
          <label class="col-md-2">User Sistem</label>
  <div class="col-md-4">
    <select class="form-control" name="karyawan_jabatan" required>
    @foreach($use as $u)
    <option value="{{$u->id}}">{{$u->name}} ({{$u->email}})</option> 
    @endforeach
    </select>
  </div>
</div>
        <div class="form-group row mt-4">
          <label class="col-md-2">Nama</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_nama">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">Tempat Lahir</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_tempatlahir">
          </div>
        </div>
        <div class="form-group row mt-4">
         <label class="col-md-2">Tanggal Lahir</label>
         <div class="col-md-4">
             <input class="form-control" type="date" name="karyawan_tanggallahir"/>
         </div>
       </div>
       <div class="form-group row mt-4">
          <label class="col-md-2">Kewarganegaraan</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan">
          </div>
        </div>
        <div class="form-group row mt-4">
                    <label class="col-md-2">Jenis Kelamin</label>
                    <div class="col-md-4">
                      <select class="form-control" name="karyawan_kelamin" required>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option> 
                      </select>
                    </div>
                  </div>
      <div class="form-group row mt-4">
              <label class="col-md-2">Jabatan</label>
      <div class="col-md-4">
        <select class="form-control" name="karyawan_jabatan" required>
        <option value="Kasir">Kasir</option>
        <option value="Kepala Gudang">Kepala Gudang</option> 
        <option value="Staff Gudang">Staff Gudang</option> 
        <option value="Akuntan">Akuntan</option> 
        <option value="Marketplace">Marketplace</option> 
        <option value="Social Media">Social Media</option> 
        <option value="Fotografer">Fotografer</option> 
        <option value="Manajer">Manajer</option> 
        </select>
      </div>
    </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">Nomor Induk Karyawan</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_noktp" >
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">No KTP</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_nik" >
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">No BPJS</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_bpjs" >
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >Email</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_email">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >No HP</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_nohp">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Alamat Domisili</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_alamatsekarang">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Kota Domisili</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_kotasekarang">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Provinsi Domisili</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_provinsisekarang">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Alamat KTP</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_alamatktp">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Kota KTP</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_kotaktp">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Provinsi KTP</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_provinsiktp">
          </div>
        </div>  

        <div class="form-group row mt-4">
            <label class="col-md-2">Status Perkawinan</label>
            <div class="col-md-4">
                <select class="multisteps-form__input form-control" name="karyawan_status">
                <option value="Belum Kawin">Belum Kawin</option>
                <option value="Kawin, Belum Punya Anak">Kawin, Belum Punya Anak</option>
                <option value="Kawin, 1 Anak">Kawin, 1 Anak</option>
                <option value="Kawin, 2 Anak">Kawin, 2 Anak</option>
                <option value="Kawin, 3 Anak">Kawin, 3 Anak</option> 
              </select>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Agama</label>
            <div class="col-md-4">
                <select class="multisteps-form__input form-control" name="karyawan_agama">
                <option value="Islam">Islam</option>
                <option value="Katolik">Katolik</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option> 
                <option value="Lain-lain">Lain-lain</option>
              </select>
            </div>
          </div> 
    <div class="form-group row mt-4">
          <label class="col-md-2" >Nama Bank</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_namabank">
          </div>
        </div>  
        <div class="form-group row mt-4">
          <label class="col-md-2" >Cabang Bank</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_cabangbank">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Nomor Rekening Bank</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_norekbank">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Nama Rekening Bank</label>
          <div class="col-md-4">
          <input type="text" class="form-control" name="karyawan_namabank">
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
            <input id="name" type="text" class="form-control" name="karyawan_pendidikanterakhir">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">
              <span class="card-label col-md-4 font-weight-bolder text-dark">Rangkuman Pendidikan</span></label>
            
          </div>
          <div class="form-group row mt-4">
           <label class="col-md-2">Sekolah / Universitas / Institusi</label>
           <div class="col-md-4">
               <input class="form-control" type="text" name="karyawan_pendidikan1"/>
           </div>
           <label class="col-md-2">Tahun Lulus</label>
           <div class="col-md-4">
           <input id="name" type="text" class="form-control" name="karyawan_tahunpendidikan1">
           </div>
         </div>
         
          <div class="form-group row mt-4">
            <label class="col-md-2">Jurusan / Konsentrasi</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_jurusanpendidikan1">
            </div>
            <label class="col-md-2">Kualifikasi Pendidikan</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kualifikasipendidikan1">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label class="col-md-2">Sekolah / Universitas / Institusi</label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="karyawan_pendidikan2"/>
            </div>
            <label class="col-md-2">Tahun Lulus</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_tahunpendidikan2">
            </div>
          </div>
          
           <div class="form-group row mt-4">
             <label class="col-md-2">Jurusan / Konsentrasi</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_jurusanpendidikan2">
             </div>
             <label class="col-md-2">Kualifikasi Pendidikan</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_kualifikasipendidikan2">
             </div>
           </div>
            
             <div class="form-group row mt-4">
             <label class="col-md-2">Bahasa 1</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_bahasa1">
             </div>
             
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Mendengar Bahasa 1</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_mendengarbahasa1">
             </div>
            <label class="col-md-2">Berbicara Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_berbicarabahasa1">
            </div>
          </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Membaca Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_membacabahasa1">
            </div>
            <label class="col-md-2">Menulis Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_menulisbahasa1">
            </div>
          </div>

          <div class="form-group row mt-4">
             <label class="col-md-2">Bahasa 2</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_bahasa2">
             </div>
             
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Mendengar Bahasa 2</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_mendengarbahasa2">
             </div>
            <label class="col-md-2">Berbicara Bahasa 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_berbicarabahasa2">
            </div>
          </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Membaca Bahasa 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_membacabahasa2">
            </div>
            <label class="col-md-2">Menulis Bahasa 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_menulisbahasa2">
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
               <input class="form-control" type="date" name="karyawan_employment1"/>
           </div>
           <label class="col-md-2">Periode Perusahaan 1</label>
           <div class="col-md-4">
           <input id="name" type="text" class="form-control" name="karyawan_employmentperiode1">
           </div>
         </div>
         
          <div class="form-group row mt-4">
            <label class="col-md-2">Jabatan Perusahaan 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_employmentjabatan1">
            </div>
            <label class="col-md-2">Gaji Perusahaan 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_employmentgaji1">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label class="col-md-2">Perusahaan 2</label>
            <div class="col-md-4">
                <input class="form-control" type="date" name="karyawan_employment2"/>
            </div>
            <label class="col-md-2">Periode Perusahaan 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_employmentperiode2">
            </div>
          </div>
          
           <div class="form-group row mt-4">
             <label class="col-md-2">Jabatan Perusahaan 2</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_employmentjabatan2">
             </div>
             <label class="col-md-2">Gaji Perusahaan 2</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_employmentgaji2">
             </div>
           </div>
            
           <div class="form-group row mt-4">
            <label class="col-md-2">Penyakit / Cacat yang menggangu bekerja</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_cacat">
            </div> 
           </div>

             
           <div class="form-group row mt-4">
            <label class="col-md-2">Hari tertentu yang tidak bisa bekerja</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_haritertentu">
            </div> 
           </div>
    
           <div class="form-group row mt-4">
            <label class="col-md-2">Perokok / Tidak</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_merokok">
            </div> 
           </div>

           <div class="form-group row mt-4">
            <label class="col-md-2">Pernah Dihukum / Ditahan</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_pernahdihukum">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Pernah Diberhentikan / PHK </label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_pernahdiberhentikan">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Jenis SIM (isi dengan koma apabila lebih dari 1)</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_jenissim">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Tahun Berakhir SIM (isi dengan koma apabila lebih dari 1)</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_berlakusim">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Nama Ayah</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_namaayah">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Alamat Ayah</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_alamatayah">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Telp Ayah</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_telpayah">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Nama Ibu</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_namaibu">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Alamat Ibu</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_alamatibu">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Telp Ibu</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_telpibu">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Nama Saudara</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_namasdr">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Alamat Saudara</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_telpsdr">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Telp Saudara</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_alamatsdr">
            </div> 
           </div> 
           <div class="form-group row mt-4">
            <label class="col-md-2">Nama Kontak Darurat</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kontakdrt1">
            </div> 
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Telp Kontak Darurat</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_nokontakdrt1">
            </div> 
           </div>
            <div class="form-group row mt-4">
                       <label class="col-md-2">Pas Foto</label>
                       <div class="col-md-4"> 
            <div class="custom-file">
                <input  class="custom-file-input" name="karyawan_foto" id="pasfoto" accept="image/*" type="file"/>
                <label class="custom-file-label" for="pasfoto">Choose file</label>
               </div>
                       </div>
                     </div>
         <div class="form-group row mt-4">
        <label class="col-md-2">Scan / Foto KTP</label>
        <div class="col-md-4"> 
          <div class="custom-file">
              <input  class="custom-file-input" name="karyawan_fotoktp" id="fotoktp" accept="image/*" type="file"/>
              <label class="custom-file-label" for="fotoktp">Choose file</label>
             </div>
        </div>
      </div>
        <div class="form-group row mt-4">
          <div class="col-md-6">
      <button class="btn btn-md btn-primary" type="submit">Tambah Pengguna</button>
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
