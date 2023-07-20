<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->dropColumn('kode_matra');
            $table->string('matra')->nullable()->after('klasifikasi');
            $table->unsignedBigInteger('id_rs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->dropColumn(['matra', 'id_rs']);
            $table->string('kode_matra')->after('klasifikasi');
        });
    }
}
