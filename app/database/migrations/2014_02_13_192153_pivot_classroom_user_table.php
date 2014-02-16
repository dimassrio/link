<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotClassroomUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classroom_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('classroom_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classroom_user');
	}

}