<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInRkoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rko', function (Blueprint $table) {
            $table->string('status', 20)->after('no_telp')->default('Menunggu Persetujuan');
            $table->timestamp('confirmed_at')->after('status')->nullable();
            $table->string('confirmed_by', 50)->after('confirmed_at')->nullable();
            $table->string('reject_reason')->after('confirmed_by')->nullable();
            $table->string('uploaded_by', 50)->after('waktu_pengajuan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rko', function (Blueprint $table) {
            //
        });
    }
}
