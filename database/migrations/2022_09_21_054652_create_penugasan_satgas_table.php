<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasanSatgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasan_satgas', function (Blueprint $table) {
            $table->uuid('id_tugas')->primary();
            $table->uuid('id_pos');
            $table->uuid('id_batalyon');
            $table->date('arrv_date');
            $table->date('dept_date');
            $table->string('nama_pers');
            $table->string('no_telp');
            $table->string('jml_pers');
            $table->string('nota_dinas');
            $table->uuid('id_bekkes_pos');
            $table->boolean('status_dist');
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
        Schema::dropIfExists('penugasan_satgas');
    }
}
