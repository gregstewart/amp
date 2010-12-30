<?php
	// check if array exists
	if(!isset($config)) {
		global $config;
		$config = array();
	}
	
	// populate the array with config settings
	$config['siteID'] = 'f926b87567d4affc6618d83f73c2cc87';
	$config['url'] = 'http://some.url.com/tcias_admin/';
	$config['path'] = 'c:/path/to/my/website/tcias_admin/';
	$config['siteName'] = 'AMP Admin';
	$config['dBName'] = 'dataabaseName';
	$config['dBHost'] = 'localhost';
	$config['dBUsername'] = 'databaseUsername';
	$config['dBPassword'] = 'databasePassword';
?>