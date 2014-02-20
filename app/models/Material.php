<?php

class Material extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function getValueFromUrl($value)
	{
		$val1 = explode("v=", $value);
		$val2 = explode("&", $val1[1]);
		return $val2[0];
	}

	public static function prepareReference($text)
	{
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	// Check if there is a url in the text
	if(preg_match($reg_exUrl, $text, $url)) {
	       // make the urls hyper links
	       return preg_replace($reg_exUrl, "<a href='".$url[0]."''>".$url[0]."</a> ", $text);
	} else {
	       // if no urls in the text just return the text
	       return $text;
	}
	}
}
