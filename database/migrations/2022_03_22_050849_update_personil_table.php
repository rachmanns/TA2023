<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('no_surat_nikah');
            $table->string('no_kk');
            $table->string('no_bpjs');
            $table->string('no_kpis');
            $table->string('npwp');
            $table->string('jenis_rambut');
            $table->string('tinggi_badan');
            $table->string('warna_kulit');
            $table->string('berat_badan');
            $table->renameColumn('id_jabatan_terakhir', 'nama_jabatan_terakhir');
            $table->renameColumn('id_pangkat_terakhir', 'nama_pangkat_terakhir');
            $table->string('grade');
            $table->string('eselon');
            $table->string('psikologi');
            $table->string('jasmani');
            $table->string('kesehatan');
            $table->string('dapen');
            $table->dropColumn([
                'no_skep_jabatan_terakhir',
                'tgl_skep_jabatan_terakhir',
                'no_sprin_jabatan_terakhir',
                'tgl_sprin_jabatan_terakhir',
                'no_skep_pangkat_terakhir',
                'tgl_skep_pangkat_terakhir',
                'no_sprin_pangkat_terakhir',
                'tgl_sprin_pangkat_terakhir',

            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->renameColumn('nama_jabatan_terakhir', 'id_jabatan_terakhir');
            $table->renameColumn('nama_pangkat_terakhir', 'id_pangkat_terakhir');

            $table->string('no_skep_jabatan_terakhir');
            $table->date('tgl_skep_jabatan_terakhir');
            $table->string('no_sprin_jabatan_terakhir');
            $table->date('tgl_sprin_jabatan_terakhir');

            $table->string('no_skep_pangkat_terakhir');
            $table->date('tgl_skep_pangkat_terakhir');
            $table->string('no_sprin_pangkat_terakhir');
            $table->date('tgl_sprin_pangkat_terakhir');

            $table->dropColumn([
                'no_surat_nikah',
                'no_kk',
                'no_bpjs',
                'no_kpis',
                'npwp',
                'jenis_rambut',
                'tinggi_badan',
                'warna_kulit',
                'berat_badan',
                'berat_badan',
                'grade',
                'eselon',
                'psikologi',
                'jasmani',
                'kesehatan',
                'dapen'
            ]);
        });
    }
}
