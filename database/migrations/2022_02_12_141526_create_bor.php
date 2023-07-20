<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bor', function (Blueprint $table) {
            $table->id('id_bor');
            $table->string('id_rs');
            $table->date('tanggal');
            $table->integer('all_tt');
            $table->integer('icu_slot');
            $table->integer('icu_isi');
            $table->integer('isolate_slot');
            $table->integer('isolate_isi');
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
        Schema::dropIfExists('bor');
    }
}
