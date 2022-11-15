<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KirimBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kirimpaket', function (Blueprint $table) {
            $table->increments('kirimpaket_id');
            $table->integer('kirimpaket_user')->nullable();
            $table->date('kirimpaket_tanggal')->nullable();
            $table->text('kirimpaket_waktupengiriman')->nullable();
            $table->text('kirimpaket_jumlahpaket')->nullable();
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
