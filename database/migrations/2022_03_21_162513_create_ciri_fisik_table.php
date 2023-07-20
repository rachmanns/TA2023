<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiriFisikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciri_fisik', function (Blueprint $table) {
            $table->uuid('id_fisik')->primary();
            $table->uuid('id_personil');
            $table->string('jenis_rambut');
            $table->string('tinggi_badan');
            $table->string('warna_kulit');
            $table->string('berat_badan');
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
        Schema::dropIfExists('ciri_fisik');
    }
}
