<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RiwayatPotongan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayatpotongan', function (Blueprint $table) {
            $table->increments('riwayatpotongan_id');
            $table->string('riwayatpotongan_namapotongan');
            $table->string('riwayatpotongan_jumlahpotongan');
            $table->string('riwayatpotongan_idpenjualan');
            $table->string('riwayatpotongan_tanggalriwayatpotongan');
            $table->integer('riwayatpotongan_userid');
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
        Schema::dropIfExists('barangterjual');
    }
}
