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
        Schema::create('users', function (Blueprint $table) 
		{
            $table->bigIncrements('id');
			$table->string('username');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email', 255)->nullable();
			$table->text('password')->nullable();   
			$table->tinyInteger('is_enabled')->default(0);
            
			// Default fields
			$table->string('user_type')->nullable();
			$table->dateTime('created_at');
			$table->bigInteger('created_by');
			$table->dateTime('updated_at')->nullable();
			$table->bigInteger('updated_by')->nullable();
			$table->dateTime('deleted_at')->nullable();
			$table->bigInteger('deleted_by')->nullable();
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
