<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdRencanaInOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('out_pemakaian', function (Blueprint $table) {
            $table->uuid('id_rencana')->nullable()->after('nominal');
            $table->foreign('id_rencana')->references('id_rencana')->on('rencana_pengeluaran')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('out_tktm', function (Blueprint $table) {
            $table->uuid('id_rencana')->nullable()->after('nominal');
            $table->foreign('id_rencana')->references('id_rencana')->on('rencana_pengeluaran')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('out_hibah', function (Blueprint $table) {
            $table->uuid('id_rencana')->nullable()->after('nominal');
            $table->foreign('id_rencana')->references('id_rencana')->on('rencana_pengeluaran')->onDelete('cascade')->onUpdate('cascade');
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
