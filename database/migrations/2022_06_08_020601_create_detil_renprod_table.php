<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetilRenprodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_renprod', function (Blueprint $table) {
            $table->uuid('id_detil_renprod')->primary();
            $table->uuid('id_renprod');
            $table->string('id_pelaksana');
            $table->integer('no_bets');
            $table->integer('jml_hasil_produksi')->default(0);
            $table->timestamp('tgl_selesai_prod')->nullable();
            $table->integer('jml_keluar')->default(0);
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
        Schema::dropIfExists('detil_renprod');
    }
}
