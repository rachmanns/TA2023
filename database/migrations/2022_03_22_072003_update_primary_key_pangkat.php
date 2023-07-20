<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePrimaryKeyPangkat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pangkat', function (Blueprint $table) {
            $table->uuid('id_pangkat')->change();
            $table->dropColumn('kode_pangkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pangkat', function (Blueprint $table) {
            $table->id('id_pangkat')->change();
            $table->string('kode_pangkat')->unique();
        });
    }
}
