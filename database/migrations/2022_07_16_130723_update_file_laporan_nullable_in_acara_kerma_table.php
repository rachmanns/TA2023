<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFileLaporanNullableInAcaraKermaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acara_kerma', function (Blueprint $table) {
            $table->string('file_laporan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acara_kerma', function (Blueprint $table) {
            $table->string('file_laporan')->nullable(false)->change();
        });
    }
}
