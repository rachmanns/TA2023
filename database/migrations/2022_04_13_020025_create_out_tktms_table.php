<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutTktmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_tktm', function (Blueprint $table) {
            $table->uuid('id_out_tktm')->primary();
            $table->date('tgl_upload')->nullable();
            $table->string('kode_nota_dinas');
            $table->double('nominal');
            $table->string('no_ppm')->nullable();
            $table->string('file_ppm')->nullable();
            $table->string('no_rth_tm')->nullable();
            $table->string('file_rth_tm')->nullable();
            $table->string('no_rth_tk')->nullable();
            $table->string('file_rth_tk')->nullable();
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
        Schema::dropIfExists('out_tktm');
    }
}
