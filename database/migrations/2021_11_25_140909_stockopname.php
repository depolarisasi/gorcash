<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stockopname extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stokopname', function (Blueprint $table) {
            $table->increments('so_id');
            $table->date('so_date')->nullable();
            $table->integer('so_pubid')->nullable();
            $table->string('so_mastersku')->nullable();
            $table->string('so_sku')->nullable();
            $table->string('so_stok')->nullable();
            $table->string('so_stokakhir')->nullable();
            $table->string('so_stokgudang')->nullable();
            $table->string('so_stoktoko')->nullable();
            $table->string('so_stokakhirreal')->nullable();
            $table->string('so_stokgudangreal')->nullable();
            $table->string('so_stoktokoreal')->nullable();
            $table->integer('so_selisih')->nullable(); //1 mingguan, 2 bulanan
            $table->integer('so_keterangan')->nullable(); //1 mingguan, 2 bulanan
            $table->integer('so_type')->nullable(); //1 mingguan, 2 bulanan
            $table->integer('so_status')->nullable(); //1 mingguan, 2 bulanan
            $table->integer('so_userid')->nullable(); //1 mingguan, 2 bulanan
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
        Schema::dropIfExists('stokopname');
    }
}
