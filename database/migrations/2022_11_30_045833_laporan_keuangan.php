<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanKeuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporankeuangan', function (Blueprint $table) {
            $table->increments('laporankeuangan_id');
            $table->string('laporankeuangan_tahun')->nullable();
            $table->string('laporankeuangan_bulan')->nullable(); 
            $table->string('laporankeuangan_nama')->nullable();
            $table->string('laporankeuangan_link')->nullable();
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
