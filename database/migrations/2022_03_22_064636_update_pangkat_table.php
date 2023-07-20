<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pangkat', function (Blueprint $table) {
            $table->string('kode_matra');
            $table->unsignedInteger('masa_kenkat');
            $table->string('jenis_pangkat');
            $table->string('next_pangkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pangkat', function (Blueprint $table) {
            $table->dropColumn(['kode_matra', 'masa_kenkat', 'jenis_pangkat', 'next_pangkat']);
        });
    }
}
