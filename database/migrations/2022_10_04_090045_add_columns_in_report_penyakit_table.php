<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInReportPenyakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_penyakit', function (Blueprint $table) {
            $table->after('id', function ($table) {
                $table->unsignedInteger('id_angkatan')->nullable();
                $table->uuid('id_penyakit')->nullable();
                $table->uuid('id_periode')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_penyakit', function (Blueprint $table) {
            $table->dropColumn([
                'id_angkatan',
                'id_penyakit',
                'id_periode',
            ]);
        });
    }
}
