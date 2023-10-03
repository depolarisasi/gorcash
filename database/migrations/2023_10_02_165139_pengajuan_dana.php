<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PengajuanDana extends Migration
{
    /**
     * Run the migrations.
     *'pengajuandana_nama',
        'pengajuandana_pengajuan', 
        'pengajuandana_category', 
        'pengajuandana_bulan', 
        'pengajuandana_tahun', 
        'pengajuandana_group', 
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuandana', function (Blueprint $table) {
            $table->increments('pengajuandana_id');
            $table->string('pengajuandana_nama')->nullable();
            $table->string('pengajuandana_pengajuan')->nullable(); 
            $table->integer('pengajuandana_category')->nullable(); 
            $table->string('pengajuandana_bulan')->nullable(); 
            $table->string('pengajuandana_tahun')->nullable(); 
            $table->string('pengajuandana_group')->nullable(); 
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
