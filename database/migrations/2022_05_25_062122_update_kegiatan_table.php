<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn([
                'id_uraian',
                'tahun_anggaran',
                'nomor_dipa',
                'tgl_dipa',
                'jumlah'
            ]);
            $table->uuid('id_event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn('id_event');
            $table->unsignedBigInteger('id_uraian');
            $table->year('tahun_anggaran');
            $table->string('nomor_dipa');
            $table->date('tgl_dipa');
            $table->double('jumlah');
        });
    }
}
