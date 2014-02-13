<?php

class Classroom extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function getNameFromId($id){
		$c = Classroom::find($id);
		return $c['name'];
	}

}
