<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCicilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicilan', function (Blueprint $table) {
            $table->uuid('id_cicilan')->primary();
            $table->uuid('id_hutang');
            $table->foreign('id_hutang')->references('id_hutang')->on('hutang')->onDelete('cascade');
            $table->date('tgl_bayar');
            $table->decimal('jml_bayar', 15, 2);
            $table->string('bukti_bayar');
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
        Schema::dropIfExists('cicilan');
    }
}
