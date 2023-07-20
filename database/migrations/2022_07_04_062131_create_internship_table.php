<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship', function (Blueprint $table) {
            $table->uuid('id_internship')->primary();
            $table->string('matra');
            $table->string('nama');
            $table->string('pangkat');
            $table->string('korps');
            $table->string('nrp')->unique();
            $table->string('jabatan');
            $table->string('kesatuan');
            $table->string('wahana');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();
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
        Schema::dropIfExists('internship');
    }
}
