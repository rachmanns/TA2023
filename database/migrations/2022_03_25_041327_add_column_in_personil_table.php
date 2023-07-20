<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('sumber_masuk')->nullable()->change();
            $table->string('nama_kesatuan');
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
            $table->string('sumber_masuk')->nullable(false)->change();
            $table->dropColumn('nama_kesatuan');
        });
    }
}
