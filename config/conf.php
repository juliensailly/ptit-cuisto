<?php
class conf{
	static private $databases = array(
		'hostname' => 'mysql.info.unicaen.fr',
		'database' => 'sailly221_bd',
		'login' => 'sailly221',
		'password' => 'otheuyiisisaa0Yo'
	);

	static public function getLogin(){
		return self::$databases['login'];
	}

	static public function getHostname(){
		return self::$databases['hostname'];
	}

	static public function getDatabase(){
		return self::$databases['database'];
	}

	static public function getPassword(){
		return self::$databases['password'];
	}

	static private $debug = true;

	static public function getDebug(){
		return self::$debug;
	}
}
