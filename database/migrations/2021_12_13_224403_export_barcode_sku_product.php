<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExportBarcodeSkuProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exportsku', function (Blueprint $table) {
            $table->increments('exportsku_id');
            $table->string('exportsku_name')->nullable();
            $table->string('exportsku_productsku')->nullable();
            $table->date('exportsku_tanggal')->nullable();
            $table->string('exportsku_groupid')->nullable();
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
        Schema::dropIfExists('exportsku');
    }
}
