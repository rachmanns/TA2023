<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInHibahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_hibah', function (Blueprint $table) {
            $table->uuid('id_in_hibah')->primary();
            $table->date('tgl_upload');
            $table->string('kode_ba');
            $table->double('nominal');
            $table->string('no_app_hibah')->nullable();
            $table->string('file_app_hibah')->nullable();
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
        Schema::dropIfExists('in_hibah');
    }
}
