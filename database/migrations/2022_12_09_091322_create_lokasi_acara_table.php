<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiAcaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_acara', function (Blueprint $table) {
            $table->uuid('id_lokasi')->primary();
            $table->uuid('id_kerma');
            $table->foreign('id_kerma')->references('id_kerma')->on('acara_kerma')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_tempat')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
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
        Schema::dropIfExists('lokasi_acara');
    }
}
