<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolSortTable extends Migration
{
    /**
     * 建立學校分類資料表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_sort', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('sort', 125)->comment('分類');
        });

        if (Schema::hasTable('sch_sort')) {
            DB::table('sch_sort')->insert([
                ['id' => 1, 'sort' => '幼兒園'],
                ['id' => 2, 'sort' => '國小'],
                ['id' => 3, 'sort' => '國中'],
                ['id' => 4, 'sort' => '高中'],
                ['id' => 5, 'sort' => '高職'],
                ['id' => 6, 'sort' => '專科'],
                ['id' => 7, 'sort' => '大學'],
                ['id' => 8, 'sort' => '其他']
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_sort');
    }
}
