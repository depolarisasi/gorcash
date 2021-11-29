<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorBarangterjual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangterjual', function (Blueprint $table) {
            $table->string('barangterjual_diskon')->nullable();
            $table->string('barangterjual_totalpendapatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangterjual', function (Blueprint $table) {
            //
        });
    }
}
