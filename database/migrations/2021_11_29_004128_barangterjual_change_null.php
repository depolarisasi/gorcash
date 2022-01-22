<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BarangterjualChangeNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangterjual', function (Blueprint $table) {
            $table->string('barangterjual_idproduk')->nullable()->change();
            $table->string('barangterjual_idpenjualan')->nullable()->change();
            $table->string('barangterjual_qty')->nullable()->change();
            $table->string('barangterjual_totalbarangterjual')->nullable()->change();
            $table->string('barangterjual_tanggalwaktubarangterjual')->nullable()->change();
            $table->integer('barangterjual_userid')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
