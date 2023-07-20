<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameKegiatanKermaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('kegiatan_kerma', 'acara_kerma');
        Schema::table('acara_kerma', function (Blueprint $table) {
            $table->renameColumn('nama_kegiatan', 'nama_acara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('acara_kerma', 'kegiatan_kerma');
        Schema::table('kegiatan_kerma', function (Blueprint $table) {
            $table->renameColumn('nama_acara', 'nama_kegiatan');
        });
    }
}
