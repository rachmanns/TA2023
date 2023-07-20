<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRiwayatPangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat_pangkat', function (Blueprint $table) {
            $table->string('no_skep_pangkat')->nullable()->change();
            $table->date('tgl_skep_pangkat')->nullable()->change();
            $table->renameColumn('no_spin_pangkat', 'no_sprin_pangkat')->change();
            $table->renameColumn('tgl_spin_pangkat', 'tgl_sprin_pangkat')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riwayat_pangkat', function (Blueprint $table) {
            $table->string('no_skep_pangkat')->nullable(false)->change();
            $table->date('tgl_skep_pangkat')->nullable(false)->change();
            $table->renameColumn('no_sprin_pangkat', 'no_spin_pangkat')->change();
            $table->renameColumn('tgl_sprin_pangkat', 'tgl_spin_pangkat')->change();
        });
    }
}
