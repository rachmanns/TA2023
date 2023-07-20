<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPeriodeLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('periode_laporan');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('periode_laporan', function (Blueprint $table) {
            $table->bigIncrements('id_periode');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->timestamps();
        });
    }
}
