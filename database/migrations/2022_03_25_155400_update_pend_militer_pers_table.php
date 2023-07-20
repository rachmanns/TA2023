<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePendMiliterPersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pend_militer_pers', function (Blueprint $table) {
            $table->dropColumn('id_pend_militer');
            $table->string('nama_sekolah');
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
            $table->dropColumn('nama_sekolah');
            $table->uuid('id_pend_militer');
        });
    }
}
