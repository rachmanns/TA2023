<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->uuid('id_dokter')->change();
            $table->string('klasifikasi');
            $table->string('kode_matra');
            $table->uuid('id_spesialis');
            $table->string('pangkat_korps')->nullable();
            $table->string('no_identitas');
            $table->string('satuan_asal')->nullable();
            $table->string('jabatan_struktural');
            $table->string('jabatan_fungsional');
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
            $table->dropColumn([
                'klasifikasi',
                'kode_matra',
                'id_spesialis',
                'pangkat_korps',
                'no_identitas',
                'satuan_asal',
                'jabatan_struktural',
                'jabatan_fungsional'
            ]);
        });
        DB::statement("ALTER TABLE dokter MODIFY COLUMN id_dokter INT auto_increment NOT NULL;");
    }
}
