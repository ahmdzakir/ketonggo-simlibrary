<?php
class Config{
	public static function Connection(){
		return array(
		'driver'=>'mysqli',
		'host'=>'localhost',
		'username'=>'root',
		'password'=>'',
		'database'=>'librarian',
		'debug'=>0
		);
	}
	public static function Title($title="",$add = true){
		if($title && $add)
			return "Librarian || ".$title;
		else if($title && !$add)
			return $title;
		else
			return "Librarian";
	}
	public static function FolderProject(){
		return array('/ketonggo_project/rsi/','/rsi/');
	}
}