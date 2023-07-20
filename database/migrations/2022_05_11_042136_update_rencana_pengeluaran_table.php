<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRencanaPengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rencana_pengeluaran', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->change();
            $table->dropColumn('id_barang_masuk');

            $table->date('tgl_keluar')->nullable();
            $table->string('no_nota_dinas')->nullable();
            $table->string('file_nota_dinas')->nullable();
            $table->string('no_spb')->nullable();
            $table->string('file_spb')->nullable();
            $table->string('no_sprindis')->nullable();
            $table->string('file_sprindis')->nullable();
            $table->string('jenis_pengeluaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencana_pengeluaran', function (Blueprint $table) {
            $table->string('keterangan')->nullable(false)->change();
            $table->uuid('id_barang_masuk');

            $table->dropColumn([
                'tgl_keluar',
                'no_nota_dinas',
                'file_nota_dinas',
                'no_spb',
                'file_spb',
                'no_sprindis',
                'file_sprindis',
                'jenis_pengeluaran',
            ]);
        });
    }
}
