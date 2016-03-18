<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->longText('text')->nullable();
            $table->mediumText('small_text')->nullable();
            $table->string('admin_name', 100);
            $table->string('admin_email');
            $table->boolean('active');
            $table->dateTime('expires')->nullable();
            $table->dateTime('startdate')->nullable();
            $table->boolean('anonymized');
            $table->boolean('allow_registration');
            $table->longText('description_text')->nullable();
            $table->longText('welcome_text')->nullable();
            $table->longText('end_text')->nullable();
            $table->string('url_callback')->nullable();
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
        Schema::drop('surveys');
    }
}
