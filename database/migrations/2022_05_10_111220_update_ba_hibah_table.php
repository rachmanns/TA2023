<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBaHibahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ba_hibah', function ($table) {
            $table->date('tgl_ba_hibah');
            $table->uuid('id_vendor');
            $table->double('nominal');
            $table->string('file_ba_hibah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ba_hibah', function ($table) {
            $table->dropColumn(['tgl_ba_hibah', 'id_vendor', 'nominal', 'file_ba_hibah']);
        });
    }
}
