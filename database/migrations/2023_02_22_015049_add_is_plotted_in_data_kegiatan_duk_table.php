<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPlottedInDataKegiatanDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_kegiatan_duk', function (Blueprint $table) {
            $table->unsignedTinyInteger('isPlotted')->default(0);
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
            $table->dropColumn('isPlotted');
        });
    }
}
