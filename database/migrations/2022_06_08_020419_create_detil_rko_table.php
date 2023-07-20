<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetilRKOTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_rko', function (Blueprint $table) {
            $table->uuid('id_detil_rko')->primary();
            $table->uuid('id_rko');
            $table->uuid('id_kemasan');
            $table->integer('jml_penggunaan_per_tahun');
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
        Schema::dropIfExists('detil_rko');
    }
}
