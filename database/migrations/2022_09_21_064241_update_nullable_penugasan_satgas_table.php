<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullablePenugasanSatgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penugasan_satgas', function (Blueprint $table) {
            $table->uuid('id_pos')->nullable()->change();
            $table->uuid('id_batalyon')->nullable()->change();
            $table->date('arrv_date')->nullable()->change();
            $table->date('dept_date')->nullable()->change();
            $table->string('nama_pers')->nullable()->change();
            $table->string('no_telp')->nullable()->change();
            $table->string('jml_pers')->nullable()->change();
            $table->string('nota_dinas')->nullable()->change();
            $table->uuid('id_bekkes_pos')->nullable()->change();
            $table->boolean('status_dist')->nullable()->change();
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
