<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Komponengaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->increments('gaji_id');
            $table->integer('gaji_slipid')->nullable();
            $table->string('gaji_kodeunik')->nullable();
            $table->integer('gaji_typekomponen')->nullable(); 
            $table->string('gaji_komponen')->nullable();   
            $table->string('gaji_jumlah')->nullable();   
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
