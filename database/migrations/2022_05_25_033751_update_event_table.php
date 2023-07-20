<?php

use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropColumn([
                'id',
                'start',
                'tempat_event',
                'finish'
            ]);
            $table->uuid('id_event')->primary()->first();
            $table->uuid('id_jenis_kerma');
            // $table->string('nama_event')->change();
        });
        DB::statement("ALTER TABLE event MODIFY COLUMN nama_event VARCHAR(191) NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Type::hasType('char')) {
            Type::addType('char', StringType::class);
        }
        Schema::table('event', function (Blueprint $table) {
            $table->dropColumn([
                'id_jenis_kerma',
            ]);
            $table->renameColumn('id_event', 'id');
            $table->date('start');
            $table->char('tempat_event');
            $table->date('finish');
            $table->char('nama_event')->change();
        });
        DB::statement("ALTER TABLE event MODIFY COLUMN id INT auto_increment NOT NULL;");
    }
}
