<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNullableInOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('out_pemakaian', function (Blueprint $table) {
            $table->string('kode_nota_dinas')->nullable()->change();
        });
        Schema::table('out_tktm', function (Blueprint $table) {
            $table->string('kode_nota_dinas')->nullable()->change();
        });
        Schema::table('out_hibah', function (Blueprint $table) {
            $table->string('kode_nota_dinas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
