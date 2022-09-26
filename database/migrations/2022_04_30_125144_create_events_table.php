<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->integer('event_type')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->decimal('lat',10,6)->nullable();
            $table->decimal('lon',10,6)->nullable();
            $table->string('pin')->nullable();
            $table->string('location')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->text('description')->nullable();
            $table->integer('content_type')->comment('1: online, 2: in-person')->default(1);
            $table->text('online_link')->nullable();
            $table->text('event_link')->nullable();
            $table->integer('business_id')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('event_host')->nullable();
            $table->integer('language_id')->nullable();
            $table->integer('format_id')->nullable();
            $table->integer('is_paid')->default(0);
            $table->double('event_cost',8,2)->nullable();
            $table->string('is_recurring')->nullable();
            $table->integer('no_of_followers')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('events');
    }
}
