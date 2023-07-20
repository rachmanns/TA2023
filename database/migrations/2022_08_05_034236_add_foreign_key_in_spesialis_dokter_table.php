<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInSpesialisDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spesialis_dokter', function (Blueprint $table) {
            $table->uuid('id_dokter')->unsigned()->change();
            $table->foreign('id_dokter')->references('id_dokter')->on('dokter')->onDelete('cascade');
            $table->uuid('id_spesialis')->unsigned()->change();
            $table->foreign('id_spesialis')->references('id_spesialis')->on('jenis_spesialis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spesialis_dokter', function (Blueprint $table) {
            $table->dropForeign(['id_dokter']);
            $table->dropForeign(['id_spesialis']);
        });
    }
}
