<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInRsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rs', function (Blueprint $table) {
            $table->string('jenis_rs', 50)->after('nama_rs')->nullable();
            $table->string('telp', 20)->nullable();
            $table->string('wilayah_kerja', 50)->nullable();
            $table->string('no_ijin_opr', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rs', function (Blueprint $table) {
            //
        });
    }
}
