<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonalDutiesColumnPriority extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_duties', function (Blueprint $table) {
            $table->integer('priority')->nullable()->comment('優先排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_duties', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
}
