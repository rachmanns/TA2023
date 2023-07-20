<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableSprinInRiwayatPangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat_pangkat', function (Blueprint $table) {
            $table->string('no_sprin_pangkat')->nullable()->change();
            $table->date('tgl_sprin_pangkat')->nullable()->change();
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
            $table->string('no_sprin_pangkat')->nullable(false)->change();
            $table->date('tgl_sprin_pangkat')->nullable(false)->change();
        });
    }
}
