<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsiaPensiunColumnInPangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pangkat', function (Blueprint $table) {
            $table->unsignedInteger('usia_pensiun')->default(0);
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
            $table->dropColumn('usia_pensiun');
        });
    }
}
