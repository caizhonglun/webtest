<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attaches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_id')
                  ->nullable()
                  ->unsigned()->comment('對應最新消息');
            $table->integer('policy_id')
                  ->nullable()
                  ->unsigned()->comment('對應政策宣導');
            $table->string('name');
            $table->string('path');
            $table->timestamps();
            $table->string('created_by')->nullable();

            // foreign key
            $table->foreign('news_id')->references('id')->on('news');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attaches');
    }
}
