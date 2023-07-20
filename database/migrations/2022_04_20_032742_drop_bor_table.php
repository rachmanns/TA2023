<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropBorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bor');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
}
