<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('produk_id');
            $table->string('produk_sku');
            $table->string('produk_nama');
            $table->string('produk_idvendor');
            $table->string('produk_idsize');
            $table->string('produk_idband');
            $table->string('produk_hargajual');
            $table->string('produk_hargabeli');
            $table->string('produk_stok');
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
        Schema::dropIfExists('produk');
    }
}
