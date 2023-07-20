<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJenisTktmInInTktmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('in_tktm', function (Blueprint $table) {
            $table->string('jenis_tktm');
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
            $table->dropColumn('jenis_tktm');
        });
    }
}
