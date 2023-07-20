<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanitiaSupervisiDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panitia_supervisi_detail', function (Blueprint $table) {
            $table->uuid('id_panitia')->primary();
            $table->uuid('id_supervisi');
            $table->uuid('id_panitia_supervisi');
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
        Schema::dropIfExists('panitia_supervisi_detail');
    }
}
