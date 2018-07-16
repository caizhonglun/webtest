<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->string('sort')->nullable()->change();
            $table->integer('sort_id')->nullable()->unsigned()->comment('所屬分類');

            // foreign key
            $table->foreign('sort_id')->references('id')->on('link_sorts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sort')->change();
            $table->dropColumn('sort_id');
        });
    }
}
