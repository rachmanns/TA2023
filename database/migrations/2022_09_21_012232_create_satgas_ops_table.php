<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatgasOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satgas_ops', function (Blueprint $table) {
            $table->uuid('id_satgas_ops')->primary();
            $table->string('nama_kat_satgas');
            $table->char('jenis_satgas', 2);
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
        Schema::dropIfExists('satgas_ops');
    }
}
