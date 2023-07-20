<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisi', function (Blueprint $table) {
            $table->uuid('id_supervisi')->primary();
            $table->string('topik');
            $table->date('tgl');
            $table->string('satuan');
            $table->unsignedInteger('id_kotakab');
            $table->string('file_lap_keg');
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
        Schema::dropIfExists('supervisi');
    }
}
