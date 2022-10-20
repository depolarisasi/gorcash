<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKaryawan2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
       
        Schema::table('karyawan', function (Blueprint $table) { 
            $table->string('karyawan_cacat')->nullable();
            $table->string('karyawan_merokok')->nullable();
            $table->string('karyawan_namaayah')->nullable();
            $table->string('karyawan_telpayah')->nullable();
            $table->string('karyawan_alamatayah')->nullable();
            $table->string('karyawan_namaibu')->nullable();
            $table->string('karyawan_telpibu')->nullable();
            $table->string('karyawan_alamatibu')->nullable(); 
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
