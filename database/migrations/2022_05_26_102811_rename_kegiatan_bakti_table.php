<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameKegiatanBaktiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('kegiatan_bakti', 'acara_bakti');
        Schema::table('acara_bakti', function (Blueprint $table) {
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
        Schema::rename('acara_bakti', 'kegiatan_bakti');
        Schema::table('kegiatan_bakti', function (Blueprint $table) {
            $table->renameColumn('nama_acara', 'nama_kegiatan');
        });
    }
}
