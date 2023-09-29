<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Budgeting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgeting', function (Blueprint $table) {
            $table->increments('budgeting_id');
            $table->string('budgeting_name')->nullable();
            $table->string('budgeting_value')->nullable();
            $table->string('budgeting_option')->nullable();
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
        //
    }
}
