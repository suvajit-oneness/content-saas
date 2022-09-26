<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_category_id');
            $table->integer('article_sub_category_id');
            $table->integer('article_tertiary_category_id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('image');
            $table->text('content');
            $table->text('meta_title');
            $table->text('meta_key');
            $table->text('tag');
            $table->text('meta_description');
            $table->text('sticky_heading');
            $table->text('sticky_content');
            $table->text('sticky_btn');
            $table->text('sticky_btn_link');
            $table->text('sticky_image');
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
        Schema::dropIfExists('articles');
    }
}
