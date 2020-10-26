<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('event_id')->unsigned();
            $table->bigInteger('member_id')->unsigned();
            $table->bigInteger('participant_id')->unsigned();
            $table->string('participant_name');
            $table->string('branch');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('participant_id')->references('id')->on('participants');
            $table->string('ticket_no');
            $table->string('prize');
            $table->string('prize_type');
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
        Schema::dropIfExists('winners');
    }
}
