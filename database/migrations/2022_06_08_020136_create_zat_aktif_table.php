<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZatAktifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zat_aktif', function (Blueprint $table) {
            $table->uuid('id_zat_aktif')->primary();
            $table->uuid('id_produk');
            $table->string('nama_zat');
            $table->string('takaran');
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
        Schema::dropIfExists('zat_aktif');
    }
}
