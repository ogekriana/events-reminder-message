<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_reminders', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('event_id');
            $table->date('remind_date');
            $table->text('message')->nullable();
            $table->text('remind_to');
            $table->timestamps();

            $table->index('event_id');
            $table->index('remind_date');

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_reminders');
    }
}
