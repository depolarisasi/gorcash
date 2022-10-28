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
</div>
<!--end::Header-->

<!--begin::Body-->
<div class="card-body pt-0 pb-3">
<div class="tab-content">
    <form method="POST" action="{{url('karyawan/store')}}" enctype="multipart/form-data">
        @csrf  
        <div class="form-group row mt-4">
          <label class="col-md-2">Nama</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_nama"  autocomplete="name">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2">Tempat Lahir</label>
          <div class="col-md-4">
          <input id="name" type="text" class="form-control" name="karyawan_tempatlahir"  autocomplete="name">
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
          <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
          </div>
        </div>
        <div class="form-group row mt-4">
                    <label class="col-md-2">Jenis Kelamin</label>
                    <div class="col-md-4">
                      <select class="form-control" name="karyawan_jeniskelamin" id="selectjeniskelamin" required>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option> 
                      </select>
                    </div>
                  </div>
      <div class="form-group row mt-4">
              <label class="col-md-2">Jabatan</label>
      <div class="col-md-4">
        <select class="form-control" name="karyawan_jeniskelamin" id="selectjeniskelamin" required>
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
          <input id="email" type="email" class="form-control" name="karyawan_email">
          </div>
        </div>
        <div class="form-group row mt-4">
          <label class="col-md-2" >No HP</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_nohp">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Alamat Domisili</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_alamatsekarang">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Kota Domisili</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_kotasekarang">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Provinsi Domisili</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_provinsisekarang">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Alamat KTP</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_alamatktp">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Kota KTP</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_kotaktp">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Provinsi KTP</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_provinsiktp">
          </div>
        </div>  

        <div class="form-group row mt-4">
            <label class="col-md-2">Status Perkawinan</label>
            <div class="col-md-4">
                <select class="multisteps-form__input form-control" name="karyawan_status">
                <option value="1">Belum Kawin</option>
                <option value="2">Kawin, Belum Punya Anak</option>
                <option value="2">Kawin, 1 Anak</option>
                <option value="2">Kawin, 2 Anak</option>
                <option value="2">Kawin, 3 Anak</option> 
              </select>
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2">Agama</label>
            <div class="col-md-4">
                <select class="multisteps-form__input form-control" name="karyawan_agama">
                <option value="1">Islam</option>
                <option value="2">Katolik</option>
                <option value="3">Kristen</option>
                <option value="4">Hindu</option>
                <option value="5">Budha</option> 
                <option value="6">Lain-lain</option>
              </select>
            </div>
          </div> 
    <div class="form-group row mt-4">
          <label class="col-md-2" >Nama Bank</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_namabank">
          </div>
        </div>  
        <div class="form-group row mt-4">
          <label class="col-md-2" >Cabang Bank</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_cabangbank">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Nomor Rekening Bank</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_norekbank">
          </div>
        </div> 
        <div class="form-group row mt-4">
          <label class="col-md-2" >Nama Rekening Bank</label>
          <div class="col-md-4">
          <input id="email" type="email" class="form-control" name="karyawan_namabank">
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
            <input id="name" type="text" class="form-control" name="karyawan_nama"  autocomplete="name">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-4">
              <span class="card-label col-md-4 font-weight-bolder text-dark">Rangkuman Pendidikan</span></label>
            
          </div>
          <div class="form-group row mt-4">
           <label class="col-md-2">Sekolah / Universitas / Institusi</label>
           <div class="col-md-4">
               <input class="form-control" type="date" name="karyawan_tanggallahir"/>
           </div>
           <label class="col-md-2">Tahun Lulus</label>
           <div class="col-md-4">
           <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
           </div>
         </div>
         
          <div class="form-group row mt-4">
            <label class="col-md-2">Jurusan / Konsentrasi</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
            </div>
            <label class="col-md-2">Kualifikasi Pendidikan</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label class="col-md-2">Sekolah / Universitas / Institusi</label>
            <div class="col-md-4">
                <input class="form-control" type="date" name="karyawan_tanggallahir"/>
            </div>
            <label class="col-md-2">Tahun Lulus</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
            </div>
          </div>
          
           <div class="form-group row mt-4">
             <label class="col-md-2">Jurusan / Konsentrasi</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
             </div>
             <label class="col-md-2">Kualifikasi Pendidikan</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
             </div>
           </div>
            
             <div class="form-group row mt-4">
             <label class="col-md-2">Bahasa 1</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
             </div>
             
           </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Mendengar Bahasa 1</label>
             <div class="col-md-4">
             <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
             </div>
            <label class="col-md-2">Mendengar Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
            </div>
          </div>
           <div class="form-group row mt-4">
            <label class="col-md-2">Berbicara Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
            </div>
            <label class="col-md-2">Membaca Bahasa 1</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label class="col-md-2">Bahasa 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
            </div>
            
          </div>
          <div class="form-group row mt-4">
           <label class="col-md-2">Mendengar Bahasa 2</label>
            <div class="col-md-4">
            <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
            </div>
           <label class="col-md-2">Mendengar Bahasa 2</label>
           <div class="col-md-4">
           <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
           </div>
         </div>
          <div class="form-group row mt-4">
           <label class="col-md-2">Berbicara Bahasa 2</label>
           <div class="col-md-4">
           <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
           </div>
           <label class="col-md-2">Membaca Bahasa 2</label>
           <div class="col-md-4">
           <input id="name" type="text" class="form-control" name="karyawan_kewarganegaraan"  autocomplete="name">
           </div>
         </div>
           
          <div class="form-group row mt-4">
                      <label class="col-md-2">Jenis Kelamin</label>
                      <div class="col-md-4">
                        <select class="form-control" name="karyawan_jeniskelamin" id="selectjeniskelamin" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option> 
                        </select>
                      </div>
                    </div>
        <div class="form-group row mt-4">
                <label class="col-md-2">Jabatan</label>
        <div class="col-md-4">
          <select class="form-control" name="karyawan_jeniskelamin" id="selectjeniskelamin" required>
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
            <input id="email" type="email" class="form-control" name="karyawan_email">
            </div>
          </div>
          <div class="form-group row mt-4">
            <label class="col-md-2" >No HP</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_nohp">
            </div>
          </div> 
          <div class="form-group row mt-4">
            <label class="col-md-2" >Alamat Domisili</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_alamatsekarang">
            </div>
          </div> 
          <div class="form-group row mt-4">
            <label class="col-md-2" >Kota Domisili</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_kotasekarang">
            </div>
          </div> 
          <div class="form-group row mt-4">
            <label class="col-md-2" >Provinsi Domisili</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_provinsisekarang">
            </div>
          </div> 
          <div class="form-group row mt-4">
            <label class="col-md-2" >Alamat KTP</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_alamatktp">
            </div>
          </div> 
          <div class="form-group row mt-4">
            <label class="col-md-2" >Kota KTP</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_kotaktp">
            </div>
          </div> 
          <div class="form-group row mt-4">
            <label class="col-md-2" >Provinsi KTP</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_provinsiktp">
            </div>
          </div>  
  
          <div class="form-group row mt-4">
              <label class="col-md-2">Status Perkawinan</label>
              <div class="col-md-4">
                  <select class="multisteps-form__input form-control" name="karyawan_status">
                  <option value="1">Belum Kawin</option>
                  <option value="2">Kawin, Belum Punya Anak</option>
                  <option value="2">Kawin, 1 Anak</option>
                  <option value="2">Kawin, 2 Anak</option>
                  <option value="2">Kawin, 3 Anak</option> 
                </select>
              </div>
            </div>
            <div class="form-group row mt-4">
              <label class="col-md-2">Agama</label>
              <div class="col-md-4">
                  <select class="multisteps-form__input form-control" name="karyawan_agama">
                  <option value="1">Islam</option>
                  <option value="2">Katolik</option>
                  <option value="3">Kristen</option>
                  <option value="4">Hindu</option>
                  <option value="5">Budha</option> 
                  <option value="6">Lain-lain</option>
                </select>
              </div>
            </div> 
      <div class="form-group row mt-4">
            <label class="col-md-2" >Nama Bank</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_namabank">
            </div>
          </div>  
          <div class="form-group row mt-4">
            <label class="col-md-2" >Cabang Bank</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_cabangbank">
            </div>
          </div> 
          <div class="form-group row mt-4">
            <label class="col-md-2" >Nomor Rekening Bank</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_norekbank">
            </div>
          </div> 
          <div class="form-group row mt-4">
            <label class="col-md-2" >Nama Rekening Bank</label>
            <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="karyawan_namabank">
            </div>
          </div>  
          
            <div class="form-group row mt-4">
                        <label class="col-md-2">Foto</label>
                        <div class="col-md-4">
                          <img src="#" class="img-fluid w-50 h-75">
                          <div class="custom-file">
                              <input  class="custom-file-input" name="product_foto" id="fotoproduk" accept="image/*" type="file"/>
                              <label class="custom-file-label" for="fotoproduk">Choose file</label>
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
