<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
			array('nim' => '000000000', 'username' => 'admin', 'password'=>Hash::make('admin'),'realname'=>'Administrator', 'phone'=>'000000000','email'=>'admin@link.com','level'=>'0'),
			array('nim' => '000000001', 'username' => 'koor', 'password'=>Hash::make('koor'),'realname'=>'Koordinator', 'phone'=>'000000000','email'=>'admin@link.com','level'=>'1'),
			array('nim' => '000000002', 'username' => 'teacher', 'password'=>Hash::make('teacher'),'realname'=>'Teacher', 'phone'=>'000000000','email'=>'admin@link.com','level'=>'2'),
			array('nim' => '000000003', 'username' => 'student', 'password'=>Hash::make('student'),'realname'=>'Student', 'phone'=>'000000000','email'=>'admin@link.com','level'=>'3')
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
