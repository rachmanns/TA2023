<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInBekkesPenugasanPetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bekkes_penugasan_peta', function (Blueprint $table) {
            $table->foreign('id_penugasan_pos')->references('id_penugasan_pos')->on('penugasan_pos')->onDelete('cascade');
            $table->foreign('id_mas_bek')->references('id_mas_bek')->on('master_bekkes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bekkes_penugasan_peta', function (Blueprint $table) {
            $table->dropForeign(['id_penugasan_pos']);
            $table->dropForeign(['id_mas_bek']);
        });
    }
}
