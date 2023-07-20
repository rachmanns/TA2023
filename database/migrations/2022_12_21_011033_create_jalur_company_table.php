<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJalurCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jalur_company', function (Blueprint $table) {
            $table->uuid('id_jalur_company')->primary();
            $table->string('nama_jalur');
            $table->string('alamat')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('jml_personil')->nullable();
            $table->integer('jml_mesin')->nullable();
            $table->boolean('izin_opr')->nullable();
            $table->boolean('cpob')->nullable();
            $table->string('sumber_puskes')->nullable();
            $table->string('sumber_angkatan')->nullable();
            $table->string('foto')->nullable();
            $table->string('video')->nullable();
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
        Schema::dropIfExists('jalur_company');
    }
}
