<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKaryawan5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::table('karyawan', function (Blueprint $table) {    
            $table->text('karyawan_kontakdrt1')->nullable();
            $table->text('karyawan_nokontakdrt1')->nullable();  
            $table->text('karyawan_foto')->nullable();
            $table->text('karyawan_fotoktp')->nullable();
            $table->date('karyawan_tanggalbekerja')->nullable(); 
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
