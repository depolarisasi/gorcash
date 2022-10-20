<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKaryawan4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('karyawan', function (Blueprint $table) {  
            $table->text('karyawan_namasdr')->nullable();
            $table->text('karyawan_telpsdr')->nullable();
            $table->text('karyawan_alamatsdr')->nullable(); 
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
