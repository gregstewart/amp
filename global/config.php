<?php
 // include the config file for site wide variables
 include ("global/_config_info.php");
 // include database connection process and info
 include ("global/db_stuff.php");
 
 // global variables
 global $http;
 $http = $config['url'];
 $page_title = $config['siteName'];
 $site_id = $config['siteID'];
 
 // include session check logic
 include ("global/session_check.php");
 
 // include access control
 //include ("global/check_access.php");
 $denied = 1; // set to one for the time being as default.
 
 //menu builder
 include ("global/_topmenu_builder.php");
?>
