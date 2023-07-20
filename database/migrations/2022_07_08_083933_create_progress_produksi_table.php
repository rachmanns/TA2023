<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_produksi', function (Blueprint $table) {
            $table->uuid('id_progress')->primary();
            $table->uuid('id_detil_renprod');
            $table->uuid('id_tahap');
            $table->string('status', 20)->default('Belum Mulai');
            $table->timestamp('tgl_rencana_mulai')->nullable();
            $table->timestamp('tgl_rencana_selesai')->nullable();
            $table->timestamp('tgl_aktual_mulai')->nullable();
            $table->timestamp('tgl_aktual_selesai')->nullable();
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
        Schema::dropIfExists('progress_produksi');
    }
}
