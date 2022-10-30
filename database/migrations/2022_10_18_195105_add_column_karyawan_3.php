<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKaryawan3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawan', function (Blueprint $table) {  
            $table->string('karyawan_haritertentu')->nullable();
            $table->string('karyawan_sim')->nullable();
            $table->string('karyawan_jenissim')->nullable();
            $table->string('karyawan_berlakusim')->nullable();
            $table->string('karyawan_pernahdiberhentikan')->nullable();
            $table->string('karyawan_pernahdihukum')->nullable();
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
