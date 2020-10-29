<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_no');
            $table->bigInteger('event_id')->unsigned();
            $table->bigInteger('participant_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('participant_id')->references('id')->on('participants');
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members');
            $table->bigInteger('created_by')->default(0);
            $table->bigInteger('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tickets');
    }
}
