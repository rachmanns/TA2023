<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFileLapKegNullableInEventBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_buku', function (Blueprint $table) {
            $table->string('file_lap_keg')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_buku', function (Blueprint $table) {
            $table->string('file_lap_keg')->nullable(false)->change();
        });
    }
}
