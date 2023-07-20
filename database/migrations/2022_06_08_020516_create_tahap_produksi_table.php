<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahapProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahap_produksi', function (Blueprint $table) {
            $table->uuid('id_tahap')->primary();
            $table->uuid('id_satuan_produk');
            $table->string('nama_tahap');
            $table->integer('no_urut');
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
        Schema::dropIfExists('tahap_produksis');
    }
}
