<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosyanduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posyandu', function (Blueprint $table) {
            $table->uuid('id_posyandu')->primary();
            $table->unsignedInteger('id_matra')->nullable();
            $table->string('nama_posy');
            $table->string('alamat_posy')->nullable();
            $table->unsignedInteger('id_kotakab')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('prog_germas')->nullable();
            $table->string('prog_posy')->nullable();
            $table->string('hub_sektoral')->nullable();
            $table->unsignedInteger('jml_kader_germas')->nullable();
            $table->unsignedInteger('jml_kader_posy')->nullable();
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
        Schema::dropIfExists('posyandu');
    }
}
