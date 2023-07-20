<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('kontrak', function (Blueprint $table) {
            $table->uuid('id_vendor')->unsigned()->change();
            $table->foreign('id_vendor')->references('id_vendor')->on('vendor')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('kontrak', function (Blueprint $table) {
            $table->dropForeign(['id_vendor']);
        });
    }
}
