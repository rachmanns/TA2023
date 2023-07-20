<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnIdPeriodeInUraianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uraian', function (Blueprint $table) {
            $table->dropColumn('id_periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uraian', function (Blueprint $table) {
            $table->unsignedInteger('id_periode');
        });
    }
}
