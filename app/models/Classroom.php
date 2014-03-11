<?php

class Classroom extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function getNameFromId($id){
		$c = Classroom::find($id);
		return $c['name'];
	}

	public function users()
	{
		return $this->belongsToMany('User','classroom_user')->withPivot('status');
	}

	public function userd()
	{
		return $this->belongsToMany('User','classroom_user')->where('status',3);
	}
}
