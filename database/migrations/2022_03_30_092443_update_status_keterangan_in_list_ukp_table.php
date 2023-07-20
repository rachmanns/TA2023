<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusKeteranganInListUkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_ukp', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->string('keterangan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_ukp', function (Blueprint $table) {
            $table->string('status')->nullable(false)->change();
            $table->string('keterangan')->nullable(false)->change();
        });
    }
}
