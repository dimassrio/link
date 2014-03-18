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
	public static function isStudent(){
		if(Auth::user()->level == 3){
			return true;
		}else{
			return false;
		}
	}
	
	public static function isTeacher(){
		if (Auth::user()->level < 3) {
			return true;
		}else{
			return false;
		}
	}
	public static function isKoordinator(){
		if (Auth::user()->level<2) {
			return true;
		}else{
			return false;
		}
	}
	public static function isAdmin(){
		if (Auth::user()->level<1) {
			return true;
		}else{
			return false;
		}
	}

	public static function getIdFromNim($nim){
		$u = User::where('nim', '=', $nim)->get();
		if(!$u->first()==null){
		return $u->first()->id;
		}else{
			return null;
		}
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

	public function classroom(){
		return $this->belongsToMany('Classroom','classroom_user')->withPivot('status');
	}
	public function course(){
		return $this->belongsToMany('Course','course_user')->withPivot('current');
	}

	public function material($id = null){
		return $this->belongsToMany('Material')->withPivot('value', 'chance', 'access');
	}

	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source http://gravatar.com/site/implement/images/php/
	 */
	public static function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	    $url = 'http://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $email ) ) );
	    $url .= "?s=$s&d=$d&r=$r";
	    if ( $img ) {
	        $url = '<img src="' . $url . '"';
	        foreach ( $atts as $key => $val )
	            $url .= ' ' . $key . '="' . $val . '"';
	        $url .= ' />';
	    }
	    return $url;
	}
}