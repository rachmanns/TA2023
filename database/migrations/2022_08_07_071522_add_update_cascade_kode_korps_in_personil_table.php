<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdateCascadeKodeKorpsInPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('kode_korps')->unsigned()->change();
            $table->foreign('kode_korps')->references('kode_korps')->on('korps')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->dropForeign(['kode_korps']);
        });
    }
}
