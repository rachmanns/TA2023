<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInParamedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paramedis', function (Blueprint $table) {
            $table->uuid('id_jenis_paramedis')->unsigned()->change();
            $table->foreign('id_jenis_paramedis')->references('id_jenis_paramedis')->on('jenis_paramedis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paramedis', function (Blueprint $table) {
            $table->dropForeign(['id_jenis_paramedis']);
        });
    }
}
