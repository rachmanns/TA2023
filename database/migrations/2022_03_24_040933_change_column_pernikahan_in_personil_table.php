<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPernikahanInPersonilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('no_surat_nikah')->nullable()->change();
            $table->string('status_pernikahan')->after('no_surat_nikah');
            $table->date('tgl_pernikahan')->nullable()->after('no_surat_nikah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personil', function (Blueprint $table) {
            $table->string('no_surat_nikah')->nullable(false)->change();
            $table->dropColumn(['status_pernikahan', 'tgl_pernikahan']);
        });
    }
}
