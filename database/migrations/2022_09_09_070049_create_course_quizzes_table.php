<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->nullable();
            $table->string('question')->nullable();
            $table->string('optionA')->nullable();
            $table->string('optionB')->nullable();
            $table->string('optionC')->nullable();
            $table->string('optionD')->nullable();
            $table->string('right_answer')->nullable();
            $table->tinyInteger('status')->comment('1: active, 0: inactive')->default(1);
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
        Schema::dropIfExists('course_quizzes');
    }
}
