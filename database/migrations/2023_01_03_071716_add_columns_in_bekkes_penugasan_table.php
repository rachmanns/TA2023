<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInBekkesPenugasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bekkes_penugasan', function (Blueprint $table) {
            $table->after('id_bekkes_penugasan', function ($table) {
                $table->string('nama_satgas')->nullable();
                $table->string('operasi')->nullable();
                $table->date('tgl_berangkat')->nullable();
                $table->date('tgl_kembali')->nullable();
                $table->unsignedInteger('jumlah_pers')->nullable();
                $table->unsignedSmallInteger('endemik')->nullable();
                $table->string('keterangan')->nullable();
                $table->enum('jenis_satgas', ['dn', 'ln']);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bekkes_penugasan', function (Blueprint $table) {
            $table->dropColumn([
                'nama_satgas',
                'operasi',
                'tgl_berangkat',
                'tgl_kembali',
                'jumlah_pers',
                'endemik',
                'keterangan',
                'jenis_satgas'
            ]);
        });
    }
}
