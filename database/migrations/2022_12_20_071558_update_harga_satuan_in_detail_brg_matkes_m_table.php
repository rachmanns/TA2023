<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHargaSatuanInDetailBrgMatkesMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_brg_matkes_m', function (Blueprint $table) {
            $table->decimal('harga_satuan', 15, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_brg_matkes_m', function (Blueprint $table) {
            //
        });
    }
}
