<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnRthInInPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('in_pengadaan', function (Blueprint $table) {
            $table->string('no_rth')->nullable()->change();
            $table->string('file_rth')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('in_pengadaan', function (Blueprint $table) {
            $table->string('no_rth')->nullable(false)->change();
            $table->string('file_rth')->nullable(false)->change();
        });
    }
}
