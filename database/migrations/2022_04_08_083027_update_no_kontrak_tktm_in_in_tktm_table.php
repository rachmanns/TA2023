<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNoKontrakTktmInInTktmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('in_tktm', function (Blueprint $table) {
            $table->string('no_kontrak_tktm')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('in_tktm', function (Blueprint $table) {
            $table->unsignedInteger('no_kontrak_tktm')->change();
        });
    }
}
