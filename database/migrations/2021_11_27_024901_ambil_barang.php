<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmbilBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangturun', function (Blueprint $table) {
            $table->increments('barangturun_id');
            $table->string('barangturun_sku')->nullable();
            $table->string('barangturun_mastersku')->nullable();
            $table->string('barangturun_namapetugas')->nullable();
            $table->date('barangturun_tanggalambil')->nullable();
            $table->date('barangturun_tanggalkembali')->nullable();
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
        Schema::dropIfExists('barangturun');
    }
}
