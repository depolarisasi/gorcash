<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Karyawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('karyawan_id');
            $table->string('karyawan_jabatan')->nullable();
            $table->string('karyawan_noinduk')->nullable();
            $table->string('karyawan_nama')->nullable(); 
            $table->string('karyawan_kelamin')->nullable();
            $table->string('karyawan_tempatlahir')->nullable();
            $table->string('karyawan_tanggallahir')->nullable();
            $table->string('karyawan_kewarganegaraan')->nullable();
            $table->string('karyawan_nik')->nullable();
            $table->string('karyawan_bpjs')->nullable();
            $table->string('karyawan_status')->nullable();
            $table->string('karyawan_agama')->nullable();
            $table->string('karyawan_alamatsekarang')->nullable();
            $table->string('karyawan_kotasekarang')->nullable();
            $table->string('karyawan_provinsisekarang')->nullable();
            $table->string('karyawan_alamatktp')->nullable();
            $table->string('karyawan_kotaktp')->nullable();
            $table->string('karyawan_provinsiktp')->nullable();
            $table->string('karyawan_nohp')->nullable();
            $table->string('karyawan_email')->nullable();
            $table->string('karyawan_namabank')->nullable();
            $table->string('karyawan_cabangbank')->nullable();
            $table->string('karyawan_norekbank')->nullable();
            $table->string('karyawan_namarekbank')->nullable();
            $table->string('karyawan_pendidikanterakhir')->nullable();
            $table->string('karyawan_pendidikan1')->nullable();
            $table->string('karyawan_jurusanpendidikan1')->nullable();
            $table->string('karyawan_tahunpendidikan1')->nullable();
            $table->string('karyawan_kualifikasipendidikan1')->nullable();
            $table->string('karyawan_pendidikan2')->nullable();
            $table->string('karyawan_jurusanpendidikan2')->nullable();
            $table->string('karyawan_tahunpendidikan2')->nullable();
            $table->string('karyawan_kualifikasipendidikan2')->nullable();
            $table->string('karyawan_bahasa1')->nullable();
            $table->string('karyawan_mendengarbahasa1')->nullable();
            $table->string('karyawan_berbicarabahasa1')->nullable();
            $table->string('karyawan_membacabahasa1')->nullable();
            $table->string('karyawan_menulisbahasa1')->nullable();
            $table->string('karyawan_bahasa2')->nullable();
            $table->string('karyawan_mendengarbahasa2')->nullable();
            $table->string('karyawan_berbicarabahasa2')->nullable();
            $table->string('karyawan_membacabahasa2')->nullable();
            $table->string('karyawan_menulisbahasa2')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log');
    }
}
