<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public static function getNameFromId($id){
		$c = User::find($id);
		return $c['realname'];
	}

	public static function getStatus($id){
		if ($id == 0) {
			return 'Administrator';
		}elseif ($id == 1) {
			return 'Coordinator';
		}elseif ($id == 2) {
			return 'Teacher';
		}else{
			return 'Student';
		}
	}

	public function course(){
		return $this->belongsToMany('Course')->withPivot('current');
	}

	public function material($id = null){
		return $this->belongsToMany('Material')->withPivot('value', 'chance', 'access');
	}

}