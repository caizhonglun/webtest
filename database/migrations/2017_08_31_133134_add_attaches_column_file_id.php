<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttachesColumnFileId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attaches', function (Blueprint $table) {
            $table->integer('file_id')->nullable()->comment('對應files table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attaches', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
}
