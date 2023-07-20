<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKeteranganNullableInBekkesDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bekkes_duk', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bekkes_duk', function (Blueprint $table) {
            $table->string('keterangan')->nullable(false)->change();
        });
    }
}
