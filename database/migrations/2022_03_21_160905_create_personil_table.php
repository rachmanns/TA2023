<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personil', function (Blueprint $table) {
            $table->uuid('id_personil')->primary();
            $table->string('kode_korps');
            $table->string('nrp');
            $table->string('nik');
            $table->string('nbi');
            $table->string('no_asabri');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->char('jenis_kelamin');
            $table->string('agama');
            $table->string('suku');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('email')->unique();
            $table->string('foto');
            $table->string('gol_darah');
            $table->string('sumber_masuk');
            $table->uuid('id_jabatan_terakhir');
            $table->date('tmt_jabatan_terakhir');
            $table->string('no_skep_jabatan_terakhir');
            $table->date('tgl_skep_jabatan_terakhir');
            $table->string('no_sprin_jabatan_terakhir');
            $table->date('tgl_sprin_jabatan_terakhir');
            $table->uuid('id_pangkat_terakhir');
            $table->date('tmt_pangkat_terakhir');
            $table->string('no_skep_pangkat_terakhir');
            $table->date('tgl_skep_pangkat_terakhir');
            $table->string('no_sprin_pangkat_terakhir');
            $table->date('tgl_sprin_pangkat_terakhir');
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
        Schema::dropIfExists('personil');
    }
}
