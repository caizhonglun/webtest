<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('新聞標題');
            $table->string('theme_img_path')->comment('標題圖片路徑');
            $table->boolean('is_show')->default(false)->comment('是否顯示');
            $table->string('organizer')->comment('承辦單位');
            $table->string('contractor')->comment('承辦人');
            $table->string('contact_phone')->comment('聯絡電話');
            $table->string('activity_start')->comment('活動起始日');
            $table->string('activity_end')->comment('活動結束日');
            $table->text('content')->comment('新聞內容');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->string('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edu_news');
    }
}
