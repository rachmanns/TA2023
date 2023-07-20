<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanitiaSupervisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panitia_supervisi', function (Blueprint $table) {
            $table->uuid('id_panitia_supervisi')->primary();
            $table->string('nama');
            $table->string('nrp');
            $table->string('pangkat');
            $table->string('jabatan');
            $table->string('satuan');
            $table->string('status');
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
        Schema::dropIfExists('panitia_supervisi');
    }
}
