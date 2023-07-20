<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKodePangkatInGradeEselonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grade_eselon', function (Blueprint $table) {
            $table->dropColumn('kode_pangkat');
            $table->uuid('id_pangkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grade_eselon', function (Blueprint $table) {
            $table->string('kode_pangkat');
            $table->dropColumn('id_pangkat');
        });
    }
}
