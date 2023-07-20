<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTmtInPatubelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patubel', function (Blueprint $table) {
            $table->dropColumn('tmt');
            $table->date('tmt_awal')->nullable();
            $table->date('tmt_akhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patubel', function (Blueprint $table) {
            $table->dropColumn(['tmt_awal', 'tmt_akhir']);
            $table->date('tmt')->nullable();
        });
    }
}
