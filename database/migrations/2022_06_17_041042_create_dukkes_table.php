<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDukkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dukkes', function (Blueprint $table) {
            $table->uuid('id_dukkes')->primary();
            $table->string('nama_dukkes');
            $table->string('tempat');
            $table->date('tanggal');
            $table->string('keterangan');
            $table->string('lampiran_surat');
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
        Schema::dropIfExists('dukkes');
    }
}
