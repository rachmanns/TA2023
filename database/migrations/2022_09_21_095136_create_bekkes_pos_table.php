<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBekkesPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bekkes_pos', function (Blueprint $table) {
            $table->uuid('id_bekkes_pos')->primary();
            $table->uuid('id_mas_bek');
            $table->uuid('id_pos_satgas');
            $table->unsignedInteger('jumlah');
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
        Schema::dropIfExists('bekkes_pos');
    }
}
