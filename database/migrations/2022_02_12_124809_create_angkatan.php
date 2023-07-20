<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngkatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angkatan', function (Blueprint $table) {
            $table->id('id_angkatan');
            $table->string('code_angkatan')->nullable();
            $table->string('nama_angkatan');
            $table->string('level',3)->comment('ang : angkatan, kom : komando, sub: subkomando');
            $table->integer('id_provinsi')->nullable();
            $table->integer('parent')->nullable();
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
        Schema::dropIfExists('angkatan');
    }
}
