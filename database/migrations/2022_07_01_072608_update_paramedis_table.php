<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateParamedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paramedis', function (Blueprint $table) {
            $table->dropColumn(['id_rs', 'id_posisi']);
            $table->uuid('id_paramedis')->change();
            $table->uuid('id_jenis_paramedis');
            $table->string('matra');
            $table->string('jenis_ijazah');
            $table->string('jenjang');
            $table->string('no_identitas');
            $table->string('satuan_asal');
            $table->string('pangkat');
            $table->string('jabatan_struktural');
            $table->string('jabatan_fungsional');
            $table->string('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paramedis', function (Blueprint $table) {
            $table->string('id_rs');
            $table->string('id_posisi');
            $table->dropColumn([
                'id_jenis_paramedis',
                'matra',
                'jenis_ijazah',
                'jenjang',
                'no_identitas',
                'satuan_asal',
                'pangkat',
                'jabatan_struktural',
                'jabatan_fungsional',
                'keterangan',
            ]);
        });
        DB::statement("ALTER TABLE paramedis MODIFY COLUMN id_paramedis INT auto_increment NOT NULL;");
    }
}
