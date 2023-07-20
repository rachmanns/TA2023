<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropJudulKegiatanInKegiatanDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan_duk', function (Blueprint $table) {
            $table->dropColumn('judul_kegiatan');
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
            $table->string('judul_kegiatan');
        });
    }
}
