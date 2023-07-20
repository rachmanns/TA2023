<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIdKontrakInDetailBrgMatkesMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_brg_matkes_m', function (Blueprint $table) {
            $table->renameColumn('id_kontrak', 'id_barang_masuk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_brg_matkes_m', function (Blueprint $table) {
            $table->renameColumn('id_barang_masuk', 'id_kontrak');
        });
    }
}
