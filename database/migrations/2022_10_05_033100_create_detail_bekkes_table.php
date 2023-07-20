<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBekkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bekkes', function (Blueprint $table) {
            $table->uuid('id_detail_bekkes')->primary();
            $table->uuid('id_mas_bek')->nullable();
            $table->uuid('id_kategori_brg')->nullable();
            $table->string('jenis_brg')->nullable();
            $table->string('nama_brg')->nullable();
            $table->string('satuan')->nullable();
            $table->unsignedInteger('jml')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('detail_bekkes');
    }
}
