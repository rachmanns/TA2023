<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bor', function (Blueprint $table) {
            $table->uuid('id_bor')->primary();
            $table->uuid('id_fasilitas_rs');
            $table->date('tgl_update');
            $table->unsignedInteger('tersedia');
            $table->integer('terpakai');
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
        Schema::dropIfExists('bor');
    }
}
