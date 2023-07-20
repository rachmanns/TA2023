<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCiriFisikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ciri_fisik');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
}
