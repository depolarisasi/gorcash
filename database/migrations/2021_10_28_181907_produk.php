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
            $table->integer('produk_idvendor')->nullable();
            $table->integer('produk_idsize')->nullable();
            $table->integer('produk_idband')->nullable();
            $table->string('produk_hargajual')->nullable();
            $table->string('produk_hargabeli')->nullable();
            $table->string('produk_foto')->nullable();
            $table->integer('produk_stok')->nullable();
            $table->date('produk_tanggalbeli')->nullable();
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
