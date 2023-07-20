<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameKodeKontrakInInPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('in_pengadaan', function (Blueprint $table) {
            $table->renameColumn('kode_kontrak', 'id_kontrak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('in_pengadaan', function (Blueprint $table) {
            $table->renameColumn('id_kontrak', 'kode_kontrak');
        });
    }
}
