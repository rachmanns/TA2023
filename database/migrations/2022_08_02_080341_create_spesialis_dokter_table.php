<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesialisDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesialis_dokter', function (Blueprint $table) {
            $table->uuid('id_spesialis_dokter')->primary();
            $table->uuid('id_spesialis');
            $table->uuid('id_dokter');
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
        Schema::dropIfExists('spesialis_dokter');
    }
}
