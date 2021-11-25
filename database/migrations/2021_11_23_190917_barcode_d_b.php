<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BarcodeDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('barcode', function (Blueprint $table) {
            $table->increments('barcode_id');
            $table->string('barcode_mastersku')->nullable();
            $table->string('barcode_productname')->nullable();
            $table->integer('barcode_producttype')->nullable();
            $table->integer('barcode_productcolor')->nullable();
            $table->integer('barcode_productsize')->nullable();
            $table->integer('barcode_productband')->nullable();
            $table->string('barcode_productseri')->nullable();
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
        Schema::dropIfExists('barcode');
    }
}
