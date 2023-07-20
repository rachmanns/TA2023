<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRiwayatJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat_jabatan', function (Blueprint $table) {
            $table->string('no_skep_jabatan')->nullable()->change();
            $table->date('tgl_skep_jabatan')->nullable()->change();
            $table->string('no_sprin_jabatan')->nullable()->change();
            $table->date('tgl_sprin_jabatan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayat_jabatan', function (Blueprint $table) {
            $table->string('no_skep_jabatan')->nullable(false)->change();
            $table->date('tgl_skep_jabatan')->nullable(false)->change();
            $table->string('no_sprin_jabatan')->nullable(false)->change();
            $table->date('tgl_sprin_jabatan')->nullable(false)->change();
        });
    }
}
