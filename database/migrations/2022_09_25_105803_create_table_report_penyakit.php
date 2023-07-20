<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableReportPenyakit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kasus');
            $table->string('status');
            $table->integer('sebelumnya');
            $table->integer('baru');
            $table->integer('berobat');
            $table->integer('sembuh');
            $table->integer('meninggal');
            $table->string('periode');
            $table->string('angkatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_report_penyakit');
    }
}
