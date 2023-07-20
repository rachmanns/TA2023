<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInBrgOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('brg_out', function (Blueprint $table) {
            $table->uuid('id_matkes_dobek')->unsigned()->change();
            $table->foreign('id_matkes_dobek')->references('id_matkes_dobek')->on('detail_brg_matkes_d')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('id_rencana')->unsigned()->change();
            $table->foreign('id_rencana')->references('id_rencana')->on('rencana_pengeluaran')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brg_out', function (Blueprint $table) {
            $table->dropForeign(['id_matkes_dobek', 'id_rencana']);
        });
    }
}
