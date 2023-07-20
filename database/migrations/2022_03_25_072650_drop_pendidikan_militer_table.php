<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPendidikanMiliterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pendidikan_militer');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pendidikan_militer', function (Blueprint $table) {
            $table->uuid('id_pendidikan_militer')->primary();
            $table->string('jenis_pendidikan_militer');
            $table->timestamps();
        });
    }
}
