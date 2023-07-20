<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInReportPenyakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_penyakit', function (Blueprint $table) {
            $table->dropColumn(['jenis_kasus', 'periode', 'angkatan']);
            $table->year('tahun')->nullable();
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
            $table->string('jenis_kasus')->nullable();
            $table->string('periode')->nullable();
            $table->string('angkatan')->nullable();
            $table->dropColumn('tahun');
        });
    }
}
