<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInRsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rs', function (Blueprint $table) {
            $table->string('keuangan')->nullable();
            $table->string('akreditasi')->nullable();
            $table->string('ipal')->nullable();
            $table->string('bpjs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rs', function (Blueprint $table) {
            //
        });
    }
}
