<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPpmColInOutHibah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('out_hibah', function (Blueprint $table) {
            $table->string('file_ppm')->nullable()->after('id_rencana');
            $table->string('no_ppm')->nullable()->after('id_rencana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('out_hibah', function (Blueprint $table) {
            //
        });
    }
}
