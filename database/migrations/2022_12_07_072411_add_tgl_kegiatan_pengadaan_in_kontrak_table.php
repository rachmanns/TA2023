<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglKegiatanPengadaanInKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kontrak', function (Blueprint $table) {
            $table->date('tgl_kegiatan_pengadaan');
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
            $table->dropColumn('tgl_kegiatan_pengadaan');
        });
    }
}
