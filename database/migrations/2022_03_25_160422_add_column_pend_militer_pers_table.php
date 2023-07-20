<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPendMiliterPersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pend_militer_pers', function (Blueprint $table) {
            $table->renameColumn('kategori_tingkat', 'kategori_pendidikan');
            $table->string('kriteria_tingkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pend_militer_pers', function (Blueprint $table) {
            $table->renameColumn('kategori_pendidikan', 'kategori_tingkat');
            $table->dropColumn('kriteria_tingkat');
        });
    }
}
