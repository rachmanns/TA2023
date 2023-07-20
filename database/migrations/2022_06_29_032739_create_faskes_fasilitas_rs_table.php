<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaskesFasilitasRsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faskes_fasilitas_rs', function (Blueprint $table) {
            $table->uuid('id_fasilitas_rs')->primary();
            $table->unsignedInteger('id_rs');
            $table->uuid('id_fasilitas');
            $table->unsignedInteger('jumlah');
            $table->string('keterangan');
            $table->string('status', 10);
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
        Schema::dropIfExists('faskes_fasilitas_rs');
    }
}
