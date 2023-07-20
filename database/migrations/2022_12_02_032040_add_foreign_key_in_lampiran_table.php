<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInLampiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('lampiran', function (Blueprint $table) {
            $table->uuid('id_kontrak')->unsigned()->change();
            $table->foreign('id_kontrak')->references('id_kontrak')->on('kontrak')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('lampiran', function (Blueprint $table) {
            $table->dropForeign(['id_kontrak']);
        });
    }
}
