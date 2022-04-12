<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRealTokoGudangStokopname extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('stokopname', function($table) {
           $table->dropColumn('so_stokgudangreal');
           $table->dropColumn('so_stoktokoreal');
        });
    }

    public function down()
    {
        Schema::table('stokopname', function($table) {
           $table->integer('so_stokgudangreal');
           $table->integer('so_stoktokoreal');
        });
    }
}
