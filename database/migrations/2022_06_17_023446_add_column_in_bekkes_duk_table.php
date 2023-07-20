<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInBekkesDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bekkes_duk', function (Blueprint $table) {
            $table->string('satgas')->nullable();
            $table->string('pers')->nullable();
            $table->string('nama')->nullable()->change();
            $table->unsignedInteger('jumlah')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bekkes_duk', function (Blueprint $table) {
            $table->dropColumn(['satgas', 'pers']);
            $table->string('nama')->nullable(false)->change();
            $table->unsignedInteger('jumlah')->nullable(false)->change();
        });
    }
}
