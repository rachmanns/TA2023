<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJmlPersonilInPenugasanPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penugasan_pos', function (Blueprint $table) {
            $table->unsignedInteger('jml_personil')->nullable()->after('no_telp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penugasan_pos', function (Blueprint $table) {
            $table->dropColumn('jml_personil');
        });
    }
}
