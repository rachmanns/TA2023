<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_buku', function (Blueprint $table) {
            $table->uuid('id_event_buku')->primary();
            $table->unsignedInteger('id_kotakab');
            $table->uuid('id_buku');
            $table->date('tgl_event');
            $table->string('satuan');
            $table->unsignedInteger('jml_peserta');
            $table->string('file_lap_keg');
            $table->string('status_keg');
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
        Schema::dropIfExists('event_buku');
    }
}
