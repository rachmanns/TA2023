<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBekkesPenugasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bekkes_penugasan', function (Blueprint $table) {
            $table->uuid('id_detail_bekkes_duk')->primary();
            $table->uuid('id_bekkes_penugasan');
            $table->foreign('id_bekkes_penugasan')->references('id_bekkes_penugasan')->on('bekkes_penugasan')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('id_mas_bek');
            $table->foreign('id_mas_bek')->references('id_mas_bek')->on('master_bekkes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('detail_bekkes_penugasan');
    }
}
