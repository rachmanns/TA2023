<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRanmorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranmor', function (Blueprint $table) {
            $table->uuid('id_ranmor')->primary();
            $table->string('jenis_ranmor', 20);
            $table->string('merk', 50);
            $table->string('no_reg', 50);
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
        Schema::dropIfExists('ranmors');
    }
}
