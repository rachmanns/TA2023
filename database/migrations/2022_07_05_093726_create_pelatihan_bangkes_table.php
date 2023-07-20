<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihanBangkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihan_bangkes', function (Blueprint $table) {
            $table->uuid('id_pelatihan_bangkes')->primary();
            $table->uuid('id_jenis_pelatihan');
            $table->date('tgl_pelaksanaan');
            $table->string('tempat');
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
        Schema::dropIfExists('pelatihan_bangkes');
    }
}
