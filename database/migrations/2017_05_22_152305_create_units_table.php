<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * 建立單位資料表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('e_no')->nullable()->comment('教育部代碼');
            $table->string('g_no')->nullable()->comment('機關代碼');
            $table->string('u_id')->nullable()->comment('公務系統舊代碼');
            $table->string('city')->comment('縣市');
            $table->string('area')->nullable()->comment('地區');
            $table->string('name')->comment('單位名');
            $table->string('name1')->comment('單位名1');
            $table->string('name2')->comment('單位名2');
            $table->string('engName')->nullable()->comment('單位英文名');
            $table->text('duty')->nullable()->comment('科室職掌');
            $table->boolean('is_show')->default(true)->comment('科室職掌顯示');
            $table->integer('sort_id')->unsigned()->comment('所屬分類');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->string('deleted_by')->nullable();

            $table->foreign('sort_id')->references('id')->on('unit_sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
