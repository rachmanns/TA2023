<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullablePosSatgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_satgas', function (Blueprint $table) {
            $table->boolean('status_endemik')->nullable()->change();
            $table->decimal('pendapatan', 11, 2)->nullable()->change();
            $table->decimal('kepadatan', 11, 2)->nullable()->change();
            $table->string('ekonomi')->nullable()->change();
            $table->string('sosial')->nullable()->change();
            $table->string('budaya')->nullable()->change();
            $table->string('suku')->nullable()->change();
            $table->string('ideologi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
