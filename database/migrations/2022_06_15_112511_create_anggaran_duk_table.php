<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggaranDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggaran_duk', function (Blueprint $table) {
            $table->uuid('id_anggaran_duk')->primary();
            $table->string('judul');
            $table->string('kategori');
            $table->year('tahun');
            $table->string('file_anggaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggaran_duk');
    }
}
