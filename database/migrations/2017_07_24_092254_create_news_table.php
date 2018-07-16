<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sort')->comment('類別');
            $table->string('title');
            $table->text('content');
            $table->boolean('is_show')->default(false)->comment('是否顯示');
            $table->string('contact_phone', 45)->comment('聯絡電話');
            $table->string('organizer', 40)->comment('承辦單位');
            $table->string('contractor', 40)->comment('承辦人');
            $table->date('announce_start')->comment('公告起始日');
            $table->date('announce_end')->comment('公告迄止日');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
