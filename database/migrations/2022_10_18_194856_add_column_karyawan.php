<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawan', function (Blueprint $table) { 
        $table->string('karyawan_employment1')->nullable();
        $table->string('karyawan_employmentperiode1')->nullable();
        $table->string('karyawan_employmentjabatan1')->nullable();
        $table->string('karyawan_employmentgaji1')->nullable();
        $table->string('karyawan_employment2')->nullable();
        $table->string('karyawan_employmentperiode2')->nullable();
        $table->string('karyawan_employmentjabatan2')->nullable();
        $table->string('karyawan_employmentgaji2')->nullable(); 
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
