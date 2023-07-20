<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInKegiatanDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan_duk', function (Blueprint $table) {
            $table->string('jenis_kegiatan')->nullable()->after('id_kat_duk');
            $table->string('keterangan')->nullable()->after('tgl_upload');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kegiatan_duk', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_kegiatan',
                'keterangan'
            ]);
        });
    }
}
