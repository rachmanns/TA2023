<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNilaiKontrakInKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kontrak', function (Blueprint $table) {
            $table->renameColumn('nilai_kontrak', 'nominal_kontrak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kontrak', function (Blueprint $table) {
            $table->renameColumn('nominal_kontrak', 'nilai_kontrak');
        });
    }
}
