<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeInPosSatgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_satgas', function (Blueprint $table) {
            $table->string('pendapatan')->nullable()->change();
            $table->string('kepadatan')->nullable()->change();
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
            $table->decimal('pendapatan', 11, 2)->nullable()->change();
            $table->decimal('kepadatan', 11, 2)->nullable()->change();
        });
    }
}
