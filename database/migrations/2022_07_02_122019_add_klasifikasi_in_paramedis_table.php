<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKlasifikasiInParamedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paramedis', function (Blueprint $table) {
            $table->string('klasifikasi');
            $table->string('matra')->nullable()->change();
            $table->string('satuan_asal')->nullable()->change();
            $table->string('pangkat')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paramedis', function (Blueprint $table) {
            $table->dropColumn('klasifikasi');
            $table->string('matra')->nullable(false)->change();
            $table->string('satuan_asal')->nullable(false)->change();
            $table->string('pangkat')->nullable(false)->change();
        });
    }
}
