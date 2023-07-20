<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInTktmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_tktm', function (Blueprint $table) {
            $table->uuid('id_in_tktm')->primary();
            $table->date('tgl_upload');
            $table->unsignedInteger('no_kontrak_tktm');
            $table->date('tgl_kontrak_tktm');
            $table->date('pelaksana_tktm');
            $table->string('file_kontrak_tktm');
            $table->double('nominal');
            $table->string('no_rth_tm');
            $table->string('file_rth_tm');
            $table->string('no_rth_tk');
            $table->string('file_rth_tk');
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
        Schema::dropIfExists('in_tktm');
    }
}
