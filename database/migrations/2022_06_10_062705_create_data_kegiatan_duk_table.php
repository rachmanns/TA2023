<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKegiatanDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kegiatan_duk', function (Blueprint $table) {
            $table->uuid('id_data_kegiatan_duk')->primary();
            $table->uuid('id_kegiatan_duk');
            $table->unsignedInteger('no_urt');
            $table->unsignedInteger('no_tes');
            $table->string('nama');
            $table->string('kelas');
            $table->string('prodi');
            $table->string('jenis_kelamin');
            $table->string('tb_bb');
            $table->string('imt');
            $table->string('tensi_nadi');
            $table->string('peny_dalam');
            $table->string('usg')->nullable();
            $table->string('obgyn')->nullable();
            $table->string('jantung')->nullable();
            $table->string('ergometri')->nullable();
            $table->string('paru')->nullable();
            $table->string('ro');
            $table->string('lab');
            $table->string('tht');
            $table->string('kulit');
            $table->string('bedah');
            $table->string('atas');
            $table->string('bawah');
            $table->string('pendengaran_keseimbangan')->nullable();
            $table->string('mata');
            $table->string('gigi');
            $table->string('jiwa');
            $table->string('ekg')->nullable();
            $table->string('hasil_um');
            $table->string('hasil_wa');
            $table->unsignedInteger('ket_nilai');
            $table->string('ket_hasil');
            $table->string('kesimpulan');
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
        Schema::dropIfExists('data_kegiatan_duk');
    }
}
