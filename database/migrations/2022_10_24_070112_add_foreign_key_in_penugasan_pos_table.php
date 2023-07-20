<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPenugasanPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penugasan_pos', function (Blueprint $table) {
            $table->uuid('id_pos')->unsigned()->change();
            $table->foreign('id_pos')->references('id_pos')->on('pos_satgas')->onDelete('cascade');
            $table->uuid('id_tugas')->unsigned()->change();
            $table->foreign('id_tugas')->references('id_tugas')->on('penugasan_satgas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penugasan_pos', function (Blueprint $table) {
            $table->dropForeign(['id_pos']);
            $table->dropForeign(['id_tugas']);
        });
    }
}
