<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * 建立學校資料表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('e_no')->nullable()->comment('教育部代碼');
            $table->string('g_no')->nullable()->comment('機關代碼');
            $table->string('u_id')->nullable()->comment('公務系統舊代碼');
            $table->string('city')->comment('縣市');
            $table->string('area')->comment('地區');
            $table->string('name')->comment('學校名');
            $table->string('name1')->comment('學校名1');
            $table->string('name2')->comment('學校名2');
            $table->string('engName')->nullable()->comment('英文學校名');
            $table->boolean('private')->default(false)->comment('是否私立');
            $table->integer('sort_id')->unsigned()->comment('所屬分類');
            $table->timestamps();
            $table->softDeletes();

            // foreign key
            $table->foreign('sort_id')->references('id')->on('sch_sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
