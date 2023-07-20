<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutHibahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_hibah', function (Blueprint $table) {
            $table->uuid('id_out_hibah')->primary();
            $table->date('tgl_upload')->nullable();
            $table->string('kode_nota_dinas');
            $table->double('nominal');
            $table->string('no_rth_hibah')->nullable();
            $table->string('file_rth_hibah')->nullable();
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
        Schema::dropIfExists('out_hibah');
    }
}
