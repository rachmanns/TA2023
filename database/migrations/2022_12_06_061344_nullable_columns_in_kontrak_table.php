<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableColumnsInKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kontrak', function (Blueprint $table) {
            $table->uuid('id_vendor')->nullable()->change();
            $table->string('nomor_kontrak')->nullable()->change();
            $table->date('tgl_kontrak')->nullable()->change();
            $table->string('file_kontrak')->nullable()->change();
            $table->string('dasar_pengadaan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kontrak', function (Blueprint $table) {
            $table->uuid('id_vendor')->nullable(false)->change();
            $table->string('nomor_kontrak')->nullable(false)->change();
            $table->date('tgl_kontrak')->nullable(false)->change();
            $table->string('file_kontrak')->nullable(false)->change();
            $table->string('dasar_pengadaan')->nullable(false)->change();
        });
    }
}
