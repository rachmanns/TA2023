<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBbmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbm', function (Blueprint $table) {
            $table->uuid('id_bbm')->primary();
            $table->uuid('id_jenis_bbm');
            $table->string('ta', 4);
            $table->string('periode', 10);
            $table->integer('jml_in');
            $table->integer('jml_out');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('bbm');
    }
}
