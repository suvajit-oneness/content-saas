<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTertiaryCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tertiary_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sub_category_id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('content')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('article_tertiary_categories');
    }
}
