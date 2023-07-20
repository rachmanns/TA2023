<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListUkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_ukp', function (Blueprint $table) {
            $table->uuid('id_list_ukp')->primary();
            $table->string('periode');
            $table->uuid('id_personil');
            $table->string('pangkat_terakhir');
            $table->date('tmt_pangkat_terakhir');
            $table->date('target_tmt_kenkat');
            $table->string('status');
            $table->string('keterangan');
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
        Schema::dropIfExists('list_ukp');
    }
}
