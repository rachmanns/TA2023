<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSatgasOpsInPosSatgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_satgas', function (Blueprint $table) {
            $table->uuid('id_satgas_ops')->nullable()->after('id_pos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_satgas', function (Blueprint $table) {
            $table->dropColumn('id_satgas_ops');
        });
    }
}
