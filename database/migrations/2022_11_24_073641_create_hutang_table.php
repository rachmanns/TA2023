<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hutang', function (Blueprint $table) {
            $table->uuid('id_hutang')->primary();
            $table->string('batalyon')->nullable();
            $table->string('operasi')->nullable();
            $table->unsignedInteger('jml_pers')->nullable();
            $table->unsignedInteger('indeks')->nullable();
            $table->decimal('jml_tagihan', 15, 2)->nullable();
            $table->decimal('jml_bayar', 15, 2)->nullable();
            $table->date('tgl_hutang')->nullable();
            $table->date('tgl_lunas')->nullable();
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
        Schema::dropIfExists('hutang');
    }
}
