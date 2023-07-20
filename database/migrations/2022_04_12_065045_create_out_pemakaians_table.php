<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutPemakaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_pemakaian', function (Blueprint $table) {
            $table->uuid('id_out_pemakaian')->primary();
            $table->date('tgl_upload')->nullable();
            $table->string('kode_nota_dinas');
            $table->double('nominal');
            $table->string('no_ppm')->nullable();
            $table->string('file_ppm')->nullable();
            $table->string('no_rth')->nullable();
            $table->string('file_rth')->nullable();
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
        Schema::dropIfExists('out_pemakaian');
    }
}
