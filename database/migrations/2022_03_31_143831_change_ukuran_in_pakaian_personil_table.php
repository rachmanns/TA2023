<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUkuranInPakaianPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pakaian_personil', function (Blueprint $table) {
            $table->string('ukuran')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pakaian_personil', function (Blueprint $table) {
            $table->double('ukuran', 8, 2)->nullable()->change();
        });
    }
}
