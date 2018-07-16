<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit')->comment('單位');
            $table->string('name')->comment('檔案名稱');
            $table->text('accordance')->comment('保有依據');
            $table->text('purpose')->comment('特定目的');
            $table->text('p_data_sort')->comment('個人資料別');
            $table->text('keep_unit')->comment('保有單位');
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('p_datas');
    }
}
