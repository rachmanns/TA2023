<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdGrEsInJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jabatan', function (Blueprint $table) {
            $table->uuid('id_gr_es')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jabatan', function (Blueprint $table) {
            $table->uuid('id_gr_es')->nullable(false)->change();
        });
    }
}
