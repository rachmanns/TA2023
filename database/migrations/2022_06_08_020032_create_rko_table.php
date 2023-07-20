<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRKOTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rko', function (Blueprint $table) {
            $table->uuid('id_rko')->primary();
            $table->uuid('id_rs');
            $table->string('periode_pengajuan', 4);
            $table->timestamp('waktu_pengajuan');
            $table->string('nama_cp_faskes');
            $table->string('email');
            $table->string('no_telp');
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
        Schema::dropIfExists('rko');
    }
}
