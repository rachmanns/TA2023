<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddIdDataBekkesInDetailBekkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('detail_bekkes', function (Blueprint $table) {
            $table->uuid('id_data_bekkes')->nullable();
            $table->foreign('id_data_bekkes')->references('id_data_bekkes')->on('data_bekkes')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('id_kategori_brg')->unsigned()->change();
            $table->foreign('id_kategori_brg')->references('id_kategori')->on('kategori_brg')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_bekkes', function (Blueprint $table) {
            $table->dropColumn('id_data_bekkes');
            $table->dropForeign(['id_kategori_brg']);
        });
    }
}
