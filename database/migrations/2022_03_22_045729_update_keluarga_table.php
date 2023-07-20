<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->dropColumn(['no_surat_nikah', 'no_kk', 'no_bpjs', 'no_kpis']);
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('hubungan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->dropColumn(['nama', 'tempat_lahir', 'tgl_lahir', 'hubungan']);
            $table->string('no_surat_nikah');
            $table->string('no_kk');
            $table->string('no_bpjs');
            $table->string('no_kpis');
        });
    }
}
