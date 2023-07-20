<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableTglUploadInInHibahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('in_hibah', function (Blueprint $table) {
            $table->date('tgl_upload')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('in_hibah', function (Blueprint $table) {
            $table->date('tgl_upload')->nullable(false)->change();
        });
    }
}
