<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotClassroomCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classroom_course', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('classroom_id')->unsigned()->index();
			$table->integer('course_id')->unsigned()->index();
			$table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
			$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classroom_course');
	}

}
