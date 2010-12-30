<?php 
	function db_connect() {
		global $config;
		
		// database parameters
		// alter this as per your configuration
		$database = $config['dBName'];
		$user = $config['dBUsername'];
		$pass = $config['dBPassword'];
		$hostname = $config['dBHhost'];
		
		$connect = mysql_connect($hostname, $user, $pass);
		if (!$connect) 
			return false;
		if (!mysql_select_db($database))
			return false;
			
		return $connect;
	}
?>