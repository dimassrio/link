<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('CoursesTableSeeder');
		$this->call('MaterialsTableSeeder');
		$this->call('ClassesTableSeeder');
		$this->call('ClassroomsTableSeeder');
		$this->call('FeedbacksTableSeeder');
	}

}