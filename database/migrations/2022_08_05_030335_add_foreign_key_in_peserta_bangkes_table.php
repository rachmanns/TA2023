<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPesertaBangkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peserta_bangkes', function (Blueprint $table) {
            $table->uuid('id_pelatihan_bangkes')->unsigned()->change();
            $table->foreign('id_pelatihan_bangkes')->references('id_pelatihan_bangkes')->on('pelatihan_bangkes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peserta_bangkes', function (Blueprint $table) {
            $table->dropForeign(['id_pelatihan_bangkes']);
        });
    }
}
