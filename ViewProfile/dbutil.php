<?php
class DbUtil{
	public static $loginUser = "musify"; 
	public static $loginPass = "musify1234@123";
	public static $host = "localhost"; // DB Host
	public static $schema = "musify"; // DB Schemaa
	
	public static function loginConnection(){
		$db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);
	
		if($db->connect_errno){
			echo("Could not connect to db");
			$db->close();
			exit();
		}
		
		return $db;
	}
	
}
?>

