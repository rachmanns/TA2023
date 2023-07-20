<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsInDistribusiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distribusi', function (Blueprint $table) {
            $table->after('tgl_distribusi', function ($table) {
                $table->string('kode_produksi')->nullable();
                $table->string('produsen')->nullable();
                $table->date('exp_date')->nullable();
                $table->integer('dobek_masuk')->default(0);
                $table->integer('dobek_keluar')->default(0);
                $table->string('dobek_ket')->nullable();
                $table->integer('dist_masuk')->default(0);
                $table->integer('dist_keluar')->default(0);
                $table->string('dist_ket')->nullable();
                $table->string('laporan')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distribusi', function (Blueprint $table) {
            //
        });
    }
}
