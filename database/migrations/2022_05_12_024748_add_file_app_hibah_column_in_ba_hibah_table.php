<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileAppHibahColumnInBaHibahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ba_hibah', function (Blueprint $table) {
            $table->string('no_app_hibah')->nullable();
            $table->string('file_app_hibah')->nullable();
            $table->date('tgl_app_hibah')->nullable();
            $table->renameColumn('tgl_upload', 'tgl_last_upload_doc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ba_hibah', function (Blueprint $table) {
            $table->dropColumn([
                'no_app_hibah',
                'file_app_hibah',
                'tgl_app_hibah',
            ]);
            $table->renameColumn('tgl_last_upload_doc', 'tgl_upload');
        });
    }
}
