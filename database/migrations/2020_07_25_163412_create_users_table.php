<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile');
            $table->string('email');
            $table->string('password');
            $table->string('slug');
            $table->string('image');
            $table->string('short_desc', 255)->comment('Short Description/ headline (4-5 words)');
            $table->longText('long_desc')->comment('Long description/ bio');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('postcode');
            $table->text('worked_for')->comment('comma seperated');
            $table->text('categories')->comment('comma seperated');
            $table->string('intro_video');
            $table->text('quote');
            $table->string('quote_by');
            $table->string('color_scheme');
            $table->integer('is_verified')->default(0);
            $table->integer('is_premium')->default(0);
            $table->integer('status')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->text('remember_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
