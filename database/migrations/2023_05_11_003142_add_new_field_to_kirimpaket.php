<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldToKirimpaket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kirimpaket', function (Blueprint $table) {
            $table->integer('kirimpaket_kegiatan')->nullable();
            $table->string('kirimpaket_keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kirimpaket', function (Blueprint $table) {
            //
        });
    }
}
