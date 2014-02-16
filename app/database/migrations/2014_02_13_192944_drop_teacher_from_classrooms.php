<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropTeacherFromClassrooms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->dropColumn('teacher');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->integer('teacher');
		});
	}

}
