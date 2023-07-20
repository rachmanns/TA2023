<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBrgMatkesDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_brg_matkes_d', function (Blueprint $table) {
            $table->uuid('id_matkes_dobek')->primary();
            $table->uuid('id_matkes_matfas');
            $table->string('id_gudang');
            $table->integer('jumlah');
            $table->date('exp_date');
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
        Schema::dropIfExists('detail_brg_matkes_d');
    }
}
