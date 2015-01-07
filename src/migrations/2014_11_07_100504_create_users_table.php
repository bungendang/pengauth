<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{ 
		   $table->increments('id');  
		   $table->string('username', 20)->unique();  
		   $table->string('email', 100)->unique();  
		   $table->string('password', 64);
		   $table->string('activation_code', 64)->nullable();
		   $table->integer('status');
		   $table->integer('type');
   		   $table->string('remember_token', 100)->nullable(); 
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
		Schema::drop('users');
	}

}
