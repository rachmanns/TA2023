<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidangStrukturDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidang_struktur_detail', function (Blueprint $table) {
            $table->id();
            $table->integer("parent");
            $table->string("jabatan")->nullable();
            $table->foreignUuid('personil_id')->references('id_personil')->on("personil")->nullable();
            $table->foreignId('bidang_id')->references('id')->on("bidang_struktur");
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
        Schema::dropIfExists('bidang_struktur_detail');
    }
}
