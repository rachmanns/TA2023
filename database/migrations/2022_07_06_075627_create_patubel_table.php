<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatubelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patubel', function (Blueprint $table) {
            $table->uuid('id_patubel')->primary();
            $table->year('tahun_ajaran');
            $table->string('ket_peserta');
            $table->uuid('id_nakes');
            $table->string('jenjang');
            $table->string('peminatan');
            $table->string('kampus');
            $table->date('tmt')->nullable();
            $table->string('file_sprin')->nullable();
            $table->string('peminatan2')->nullable();
            $table->string('kampus2')->nullable();
            $table->string('file_sprin2')->nullable();
            $table->string('status');
            $table->date('tgl_lulus')->nullable();
            $table->string('ipk')->nullable();
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
        Schema::dropIfExists('patubel');
    }
}
