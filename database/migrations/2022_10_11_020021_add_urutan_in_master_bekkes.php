<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrutanInMasterBekkes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_bekkes', function (Blueprint $table) {
            $table->unsignedInteger('urutan')->nullable()->after('nama_bekkes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_bekkes', function (Blueprint $table) {
            $table->dropColumn('urutan');
        });
    }
}
