<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePakaianPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakaian_personil', function (Blueprint $table) {
            $table->uuid('id_pakaian_personil')->primary();
            $table->uuid('id_personil');
            $table->uuid('id_pakaian');
            $table->double('ukuran', 8, 2);
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
        Schema::dropIfExists('pakaian_personil');
    }
}
