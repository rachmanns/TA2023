<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePeriodeIsiTable extends Migration
{
    /**
     * Run the migrations.periode_isi
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('periode_isi', 'periode_laporan');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('periode_laporan', 'periode_isi');
    }
}
