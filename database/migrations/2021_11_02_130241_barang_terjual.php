<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BarangTerjual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangterjual', function (Blueprint $table) {
            $table->increments('barangterjual_id');
            $table->string('barangterjual_idproduk');
            $table->string('barangterjual_idpenjualan');
            $table->string('barangterjual_qty');
            $table->string('barangterjual_totalbarangterjual');
            $table->string('barangterjual_tanggalbarangterjual');
            $table->integer('barangterjual_userid');
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
