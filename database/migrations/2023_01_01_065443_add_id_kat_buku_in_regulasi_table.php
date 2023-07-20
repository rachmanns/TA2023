<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdKatBukuInRegulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regulasi', function (Blueprint $table) {
            $table->uuid('id_kat_buku')->nullable()->after('file');
            $table->foreign('id_kat_buku')->references('id_kat_buku')->on('kat_buku')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regulasi', function (Blueprint $table) {
            $table->dropColumn('id_kat_buku');
        });
    }
}
