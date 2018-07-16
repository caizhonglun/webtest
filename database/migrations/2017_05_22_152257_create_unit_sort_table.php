<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitSortTable extends Migration
{
    /**
     * 建立單位分類資料表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_sort', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('sort', 125)->comment('分類');
        });

        if (Schema::hasTable('unit_sort')) {
            DB::table('unit_sort')->insert([
                ['id' => 1, 'sort' => '教育局'],
                ['id' => 2, 'sort' => '市政府'],
                ['id' => 3, 'sort' => '法人團體'],
                ['id' => 4, 'sort' => '其他'],
                ['id' => 5, 'sort' => '教育局附屬機關']
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
        Schema::dropIfExists('unit_sort');
    }
}
