<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->unsignedInteger('pensiun_bintara')->nullable();
            $table->unsignedInteger('pensiun_tamtama')->nullable();
            $table->unsignedInteger('pensiun_perwira')->nullable();
            $table->unsignedInteger('pensiun_pns')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->dropColumn([
                'penisum_bintara',
                'penisum_tamtama',
                'penisum_perwira',
                'penisum_pns'
            ]);
        });
    }
}
