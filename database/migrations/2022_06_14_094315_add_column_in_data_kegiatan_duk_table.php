<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInDataKegiatanDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_kegiatan_duk', function (Blueprint $table) {
            $table->string('pangkat')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('nrp')->nullable();
            $table->string('jenis_kelamin', 1)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_kegiatan_duk', function (Blueprint $table) {
            $table->dropColumn(['pangkat', 'jabatan', 'nrp']);
            $table->string('jenis_kelamin')->nullable(false)->change();
        });
    }
}
