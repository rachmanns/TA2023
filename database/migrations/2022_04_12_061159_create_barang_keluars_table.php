<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->uuid('id_nota_dinas')->primary();
            $table->string('jenis_kegiatan');
            $table->string('kode_nota_dinas');
            $table->string('no_nota_dinas');
            $table->string('file_nota_dinas');
            $table->string('no_spb');
            $table->string('file_spb');
            $table->double('nominal');
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
        Schema::dropIfExists('barang_keluar');
    }
}
