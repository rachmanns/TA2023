<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInDetailBrgMatkesDTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('detail_brg_matkes_d', function (Blueprint $table) {
            $table->uuid('id_matkes_matfas')->unsigned()->change();
            $table->foreign('id_matkes_matfas')->references('id_matkes_matfas')->on('detail_brg_matkes_m')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('detail_brg_matkes_d', function (Blueprint $table) {
            $table->dropForeign(['id_matkes_matfas']);
        });
    }
}
