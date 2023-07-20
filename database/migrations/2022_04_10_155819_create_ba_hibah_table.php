<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaHibahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_hibah', function (Blueprint $table) {
            $table->uuid('id_ba_hibah')->primary();
            $table->string('kode_ba_hibah');
            $table->string('no_ba_hibah');
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
        Schema::dropIfExists('ba_hibah');
    }
}
