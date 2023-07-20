<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pangkat', function (Blueprint $table) {
            $table->uuid('id_riwayat_pangkat')->primary();
            $table->uuid('id_pangkat');
            $table->uuid('id_personil');
            $table->date('tmt_pangkat');
            $table->string('no_skep_pangkat');
            $table->date('tgl_skep_pangkat');
            $table->string('no_spin_pangkat');
            $table->date('tgl_spin_pangkat');
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
        Schema::dropIfExists('riwayat_pangkat');
    }
}
