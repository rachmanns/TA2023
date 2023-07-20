<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocKermaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_kerma', function (Blueprint $table) {
            $table->uuid('id_doc_kerma')->primary();
            $table->string('jenis_doc_kerma');
            $table->string('pihak');
            $table->string('lembaga');
            $table->string('no_doc');
            $table->date('tgl_terbit');
            $table->string('desc');
            $table->string('keterangan');
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
        Schema::dropIfExists('doc_kerma');
    }
}
