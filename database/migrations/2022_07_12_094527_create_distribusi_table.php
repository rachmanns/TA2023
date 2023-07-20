<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribusiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribusi', function (Blueprint $table) {
            $table->uuid('id_distribusi')->primary();
            $table->uuid('id_kemasan');
            $table->uuid('id_rs')->nullable();
            $table->string('kategori', 15);
            $table->string('tujuan');
            $table->timestamp('tgl_distribusi');
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
        Schema::dropIfExists('distribusi');
    }
}
