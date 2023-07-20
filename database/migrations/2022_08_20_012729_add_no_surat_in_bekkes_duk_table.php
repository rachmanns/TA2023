<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoSuratInBekkesDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bekkes_duk', function (Blueprint $table) {
            $table->string('no_surat')->nullable();
            $table->string('file_pengajuan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bekkes_duk', function (Blueprint $table) {
            $table->dropColumn('no_surat');
            $table->string('file_pengajuan')->nullable(false)->change();
        });
    }
}
