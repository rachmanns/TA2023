<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInPosSatgasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_satgas', function (Blueprint $table) {
            $table->after('longitude', function ($table) {
                $table->uuid('id_geografis')->nullable();
                $table->boolean('status_endemik');
                $table->double('pendapatan', 11, 2);
                $table->double('kepadatan', 11, 2);
                $table->string('ekonomi');
                $table->string('sosial');
                $table->string('budaya');
                $table->string('suku');
                $table->string('ideologi');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_satgas', function (Blueprint $table) {
            $table->dropColumn([
                'id_geografis',
                'status_endemik',
                'pendapatan',
                'kepadatan',
                'ekonomi',
                'sosial',
                'budaya',
                'suku',
                'ideologi'
            ]);
        });
    }
}
