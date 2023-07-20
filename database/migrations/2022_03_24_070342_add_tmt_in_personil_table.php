<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTmtInPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->date('tmt_tni');
            $table->date('tmt_bintara')->nullable();
            $table->date('tmt_perwira')->nullable();
            $table->date('tmt_tamtama')->nullable();
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
            $table->dropColumn([
                'tmt_tni',
                'tmt_bintara',
                'tmt_perwira',
                'tmt_tamtama',
            ]);
        });
    }
}
