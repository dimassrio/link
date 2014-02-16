<?php

class Course extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function user()
	{
		return $this->belongsToMany('User', 'course_user')->withPivot('current');
	}
}
