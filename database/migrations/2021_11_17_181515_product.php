<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_barcodevendor')->nullable();
            $table->string('product_mastersku')->nullable();
            $table->string('product_sku')->unique()->nullable();
            $table->string('product_nama')->nullable();
            $table->string('product_vendor')->nullable();
            $table->integer('product_idsize')->nullable();
            $table->integer('product_idband')->nullable();
            $table->string('product_hargajual')->nullable();
            $table->string('product_hargabeli')->nullable();
            $table->string('product_tag')->nullable();
            $table->string('product_material')->nullable();
            $table->string('product_madein')->nullable();
            $table->string('product_condition')->nullable();
            $table->string('product_foto')->nullable();
            $table->integer('product_stok')->nullable();
            $table->date('product_tanggalbeli')->nullable();
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
        Schema::dropIfExists('product');
    }
}
