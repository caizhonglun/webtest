<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_duties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('position')->nullable()->comment('職位');
            $table->string('img_path')->nullable()->comment('大頭貼路徑');
            $table->text('duty')->nullable()->comment('業務內容');
            $table->string('telephone')->comment('電話');
            $table->string('telephone_extension')->nullable()->comment('分機');
            $table->string('direct_telephone')->nullable()->comment('專線');
            $table->string('fax')->nullable()->comment('傳真');
            $table->string('email')->nullable()->comment('聯絡信箱');
            $table->string('agent')->nullable()->comment('代理人');
            $table->text('education')->nullable()->comment('學歷');
            $table->text('experience')->nullable()->comment('經歷');
            $table->text('honor')->nullable()->comment('榮耀');
            $table->integer('unit_id')->unsigned();
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->string('deleted_by')->nullable();

            // foreign key
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_duties');
    }
}
