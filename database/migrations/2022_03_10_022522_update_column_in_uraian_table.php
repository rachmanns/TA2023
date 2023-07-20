<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateColumnInUraianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uraian', function (Blueprint $table) {
            $table->unsignedInteger('id_parent')->nullable()->change();
            $table->string('kode_akun')->nullable()->change();
            // $table->year('tahun_anggaran')->change();
        });
        DB::statement('ALTER TABLE `uraian` MODIFY `tahun_anggaran` year NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uraian', function (Blueprint $table) {
            $table->unsignedInteger('id_parent')->change();
            $table->unsignedInteger('kode_akun')->change();
            $table->unsignedInteger('tahun_anggaran')->change();
        });
    }
}
