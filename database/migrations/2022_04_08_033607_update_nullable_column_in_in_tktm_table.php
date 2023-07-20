<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableColumnInInTktmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('in_tktm', function (Blueprint $table) {
            $table->date('tgl_upload')->nullable()->change();
            $table->string('pelaksana_tktm')->change();
            $table->string('no_rth_tm')->nullable()->change();
            $table->string('file_rth_tm')->nullable()->change();
            $table->string('no_rth_tk')->nullable()->change();
            $table->string('file_rth_tk')->nullable()->change();
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
            $table->date('tgl_upload')->nullable(false)->change();
            $table->date('pelaksana_tktm')->change();
            $table->string('no_rth_tm')->nullable(false)->change();
            $table->string('file_rth_tm')->nullable(false)->change();
            $table->string('no_rth_tk')->nullable(false)->change();
            $table->string('file_rth_tk')->nullable(false)->change();
        });
    }
}
