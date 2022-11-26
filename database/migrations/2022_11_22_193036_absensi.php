<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Absensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->increments('absensi_id');
            $table->integer('absensi_karyawanid')->nullable();
            $table->date('absensi_tanggal')->nullable();
            $table->time('absensi_jammasuk')->nullable();
            $table->time('absensi_jampulang')->nullable();
            $table->integer('absensi_lembur')->nullable();
            $table->integer('absensi_lamakerja')->nullable();
            $table->tinyInteger('absensi_type')->nullable();
            $table->text('absensi_keterangan')->nullable();
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
        //
    }
}
