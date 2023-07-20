<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglBerakhirAndStatusPerjanjianInDocKermaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doc_kerma', function (Blueprint $table) {
            $table->date('tgl_berakhir')->after('tgl_terbit');
            $table->string('status_perjanjian')->after('tgl_berakhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doc_kerma', function (Blueprint $table) {
            $table->dropColumn(['tgl_berakhir', 'status_perjanjian']);
        });
    }
}
