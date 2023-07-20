<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrgOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brg_out', function (Blueprint $table) {
            $table->uuid('id_brg_out')->primary();
            $table->uuid('id_matkes_dobek');
            $table->uuid('id_rencana');
            $table->integer('jml_keluar');
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
        Schema::dropIfExists('brg_out');
    }
}
