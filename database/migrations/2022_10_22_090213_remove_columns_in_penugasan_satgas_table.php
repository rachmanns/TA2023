<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsInPenugasanSatgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penugasan_satgas', function (Blueprint $table) {
            $table->dropColumn([
                'id_pos',
                'id_batalyon',
                'nama_pers',
                'no_telp',
                'jml_pers'
            ]);
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
            $table->uuid('id_pos')->nullable();
            $table->uuid('id_batalyon')->nullable();
            $table->string('nama_pers')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('jml_pers')->nullable();
        });
    }
}
