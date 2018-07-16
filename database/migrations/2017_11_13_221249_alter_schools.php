<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->string('address')->nullable()->comment('地址');
            $table->double('longitude')->nullable()->default(24.993103)->comment('經度');
            $table->double('latitude')->nullable()->default(121.301049)->comment('緯度');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
        });
    }
}
