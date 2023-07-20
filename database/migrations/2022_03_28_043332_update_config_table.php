<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->unsignedInteger('var_dsp')->nullable()->change();
            $table->uuid('var_rh')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->unsignedInteger('var_dsp')->nullable(false)->change();
            $table->uuid('var_rh')->nullable(false)->change();
        });
    }
}
