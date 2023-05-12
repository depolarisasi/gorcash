<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKendaraanToTransport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kirimpaket', function (Blueprint $table) {
            $table->string('kirimpaket_ekspedisi')->nullable();
            $table->string('kirimpaket_kendaraan')->nullable();
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
