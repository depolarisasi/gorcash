<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Penjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->increments('penjualan_id');
            $table->string('penjualan_invoice');
            $table->string('penjualan_customername');
            $table->string('penjualan_channel');
            $table->string('penjualan_barangterjual');
            $table->string('penjualan_totalpenjualan');
            $table->string('penjualan_daftarpotongan');
            $table->string('penjualan_totalpotongan');
            $table->string('penjualan_tanggalpenjualan');
            $table->integer('penjualan_userid');
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
        Schema::dropIfExists('penjualan');
    }
}
