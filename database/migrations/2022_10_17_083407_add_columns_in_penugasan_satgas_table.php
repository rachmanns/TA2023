<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInPenugasanSatgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penugasan_satgas', function (Blueprint $table) {
            $table->after('id_tugas', function ($table) {
                $table->uuid('id_satgas_ops')->nullable();
                $table->string('nama_satgas')->nullable();
                $table->string('nama_batalyon')->nullable();
                $table->year('tahun_anggaran')->nullable();
            });
            $table->boolean('status_berangkat')->nullable()->after('nota_dinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penugasan_satgas', function (Blueprint $table) {
            $table->dropColumn([
                'id_satgas_ops',
                'nama_satgas',
                'nama_batalyon',
                'tahun_anggaran',
                'status_berangkat'
            ]);
        });
    }
}
