<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_question_id')->unsigned()->nullable();
            $table->integer('group_id')->unsigned();
            $table->longText('text');
            $table->mediumText('small_text')->nullable();
            $table->string('type', 25)->nullable();
            //'choice','list_dropdown','list_radio','array','date_time','gender','numerical','boilerplate','yes_no','huge_free_text','long_free_text','short_free_text','multiple_choice'
            $table->integer('order');
            $table->boolean('mandatory');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('parent_question_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
