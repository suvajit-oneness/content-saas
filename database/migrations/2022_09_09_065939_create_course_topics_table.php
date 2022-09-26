<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->nullable();
            $table->integer('module_id')->nullable();
            $table->string('topic')->nullable();
            $table->string('slug')->nullable();
            $table->string('assignment')->nullable();
            $table->text('assignment_file')->nullable();
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
        Schema::dropIfExists('course_topics');
    }
}
