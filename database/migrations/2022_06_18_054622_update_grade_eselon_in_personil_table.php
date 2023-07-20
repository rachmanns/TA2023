<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGradeEselonInPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('grade')->nullable()->change();
            $table->string('eselon')->nullable()->change();
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
            $table->string('grade')->nullable(false)->change();
            $table->string('eselon')->nullable(false)->change();
        });
    }
}
