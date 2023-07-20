<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKemasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemasan', function (Blueprint $table) {
            $table->uuid('id_kemasan')->primary();
            $table->uuid('id_produk');
            $table->uuid('id_satuan_produk');
            $table->string('nama_kemasan');
            $table->string('NIE')->nullable();
            $table->integer('bets');
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
        Schema::dropIfExists('kemasan');
    }
}
