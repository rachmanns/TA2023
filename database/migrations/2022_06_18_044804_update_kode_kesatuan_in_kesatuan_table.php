<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKodeKesatuanInKesatuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kesatuan', function (Blueprint $table) {
            $table->unique('kode_kesatuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kesatuan', function (Blueprint $table) {
            $table->dropUnique('kode_kesatuan');
        });
    }
}
