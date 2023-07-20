<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdRencanaInDetailBrgMatkesMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_brg_matkes_m', function (Blueprint $table) {
            $table->uuid('id_rencana')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_brg_matkes_m', function (Blueprint $table) {
            $table->dropColumn('id_rencana');
        });
    }
}
