<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKodeMatraInAngkatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('angkatan', function (Blueprint $table) {
            $table->string('kode_matra')->after('code_angkatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('angkatan', function (Blueprint $table) {
            $table->dropColumn('kode_matra');
        });
    }
}
