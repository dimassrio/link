<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropClassroomUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classroom_user', function(Blueprint $table) {
			$table->drop('classroom_user');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classroom_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('classroom_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

}
