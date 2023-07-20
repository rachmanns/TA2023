<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaPengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_pengeluaran', function (Blueprint $table) {
            $table->uuid('id_rencana')->primary();
            $table->string('penerima');
            $table->string('tujuan_penggunaan');
            $table->string('keterangan');
            $table->uuid('id_kontrak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rencana_pengeluaran');
    }
}
