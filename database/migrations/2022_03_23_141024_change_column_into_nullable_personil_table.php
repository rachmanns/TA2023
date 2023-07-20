<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnIntoNullablePersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('npwp')->nullable()->change();
            $table->string('no_asabri')->nullable()->change();
            $table->string('no_kk')->nullable()->change();
            $table->string('no_bpjs')->nullable()->change();
            $table->string('no_kpis')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('suku')->nullable()->change();
            $table->string('jenis_rambut')->nullable()->change();
            $table->string('warna_kulit')->nullable()->change();
            $table->string('tinggi_badan')->nullable()->change();
            $table->string('berat_badan')->nullable()->change();
            $table->string('gol_darah')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('npwp')->nullable(false)->change();
            $table->string('no_asabri')->nullable(false)->change();
            $table->string('no_kk')->nullable(false)->change();
            $table->string('no_bpjs')->nullable(false)->change();
            $table->string('no_kpis')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('suku')->nullable(false)->change();
            $table->string('jenis_rambut')->nullable(false)->change();
            $table->string('warna_kulit')->nullable(false)->change();
            $table->string('tinggi_badan')->nullable(false)->change();
            $table->string('berat_badan')->nullable(false)->change();
            $table->string('gol_darah')->nullable(false)->change();
        });
    }
}
