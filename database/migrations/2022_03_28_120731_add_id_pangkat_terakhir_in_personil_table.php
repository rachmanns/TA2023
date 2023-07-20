<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPangkatTerakhirInPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->uuid('id_pangkat_terakhir')->nullable()->after('sumber_masuk');
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
            $table->dropColumn('id_pangkat_terakhir');
        });
    }
}
