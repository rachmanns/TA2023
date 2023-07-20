<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeTahunAjaranTypeInPatubelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patubel', function (Blueprint $table) {
            $table->string('tahun_ajaran')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patubel', function (Blueprint $table) {
            DB::statement('ALTER TABLE `patubel` MODIFY COLUMN `tahun_ajaran` YEAR');
        });
    }
}
