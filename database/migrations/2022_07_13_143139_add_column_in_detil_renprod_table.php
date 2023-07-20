<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInDetilRenprodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detil_renprod', function (Blueprint $table) {
            $table->timestamp('tgl_expired')->nullable()->after('tgl_selesai_prod');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detil_renprod', function (Blueprint $table) {
            //
        });
    }
}
