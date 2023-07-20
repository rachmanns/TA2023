<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPelatihanBangkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pelatihan_bangkes', function (Blueprint $table) {
            $table->uuid('id_jenis_pelatihan')->unsigned()->change();
            $table->foreign('id_jenis_pelatihan')->references('id_jenis_pelatihan')->on('jenis_pelatihan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pelatihan_bangkes', function (Blueprint $table) {
            $table->dropForeign(['id_jenis_pelatihan']);
        });
    }
}
