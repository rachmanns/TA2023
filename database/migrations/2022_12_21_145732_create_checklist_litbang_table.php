<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistLitbangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_litbang', function (Blueprint $table) {
            $table->uuid('id_checklist')->primary();
            $table->uuid('id_litbang');
            $table->foreign('id_litbang')->references('id_litbang')->on('litbang')->onDelete('cascade');
            $table->unsignedBigInteger('id_tahap');
            $table->boolean('status')->nullable();
            $table->string('laporan')->nullable();
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
        Schema::dropIfExists('checklist_litbang');
    }
}
