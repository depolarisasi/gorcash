<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Slipgaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slipgaji', function (Blueprint $table) {
            $table->increments('slipgaji_id');
            $table->integer('slipgaji_karyawanid')->nullable();
            $table->integer('slipgaji_userid')->nullable();
            $table->string('slipgaji_bulan')->nullable(); 
            $table->string('slipgaji_tahun')->nullable();
            $table->string('slipgaji_kodeunik')->nullable();
            $table->text('slipgaji_komponenpenerimaan')->nullable();
            $table->text('slipgaji_komponenpotongan')->nullable();
            $table->string('slipgaji_thp')->nullable(); 
            $table->date('slipgaji_tanggalgaji')->nullable(); 
            $table->string('slipgaji_ttd')->nullable(); 
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
