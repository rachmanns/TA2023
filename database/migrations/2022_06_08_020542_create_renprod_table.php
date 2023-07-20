<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenprodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renprod', function (Blueprint $table) {
            $table->uuid('id_renprod')->primary();
            $table->uuid('id_kemasan');
            $table->string('periode_produksi', 4);
            $table->integer('jml_spp');
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
        Schema::dropIfExists('renprod');
    }
}
