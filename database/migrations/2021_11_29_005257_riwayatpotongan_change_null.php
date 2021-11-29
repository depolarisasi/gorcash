<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RiwayatpotonganChangeNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayatpotongan', function (Blueprint $table) {
            $table->string('riwayatpotongan_namapotongan')->nullable()->change();
            $table->string('riwayatpotongan_jumlahpotongan')->nullable()->change();
            $table->string('riwayatpotongan_idpenjualan')->nullable()->change();
            $table->string('riwayatpotongan_tanggalriwayatpotongan')->nullable()->change();
            $table->integer('riwayatpotongan_userid')->nullable()->change();
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
