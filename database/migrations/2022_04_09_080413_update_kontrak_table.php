<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\Type;

class UpdateKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Type::hasType('double')) {
            Type::addType('double', FloatType::class);
        }
        Schema::table('kontrak', function (Blueprint $table) {
            $table->dropColumn('id_kegiatan');
            $table->string('nama_kegiatan');
            $table->string('no_dipa');
            $table->string('kode_dipa');
            $table->date('tgl_dipa');
            $table->double('jumlah');
            $table->unsignedInteger('masa_berlaku')->nullable()->change();
            $table->string('keterangan')->nullable()->change();
            $table->double('lapju_min')->nullable()->change();
            $table->double('lapju_sik')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Type::hasType('double')) {
            Type::addType('double', FloatType::class);
        }
        Schema::table('kontrak', function (Blueprint $table) {
            $table->uuid('id_kegiatan');
            $table->dropColumn(['nama_kegiatan', 'no_dipa', 'kode_dipa', 'tgl_dipa', 'jumlah']);
            $table->unsignedInteger('masa_berlaku')->nullable(false)->change();
            $table->string('keterangan')->nullable(false)->change();
            $table->double('lapju_min')->nullable(false)->change();
            $table->double('lapju_sik')->nullable(false)->change();
        });
    }
}
