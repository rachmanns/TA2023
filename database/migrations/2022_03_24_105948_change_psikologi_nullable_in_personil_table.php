<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePsikologiNullableInPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('psikologi')->nullable()->change();
            $table->string('jasmani')->nullable()->change();
            $table->string('kesehatan')->nullable()->change();
            $table->string('dapen')->nullable()->change();
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
            $table->string('psikologi')->nullable(false)->change();
            $table->string('jasmani')->nullable(false)->change();
            $table->string('kesehatan')->nullable(false)->change();
            $table->string('dapen')->nullable(false)->change();
        });
    }
}
