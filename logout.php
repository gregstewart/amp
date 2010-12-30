<?php 
	include ("global/_config_info.php");
	$http = $config['url'];
  session_start();
	
	$old_user = $session_id;
	$result = session_unregister("session_id");
	$result1 = session_unregister("session_name");
	$result2 = session_unregister("session_firstname");
	$result3 = session_unregister("session_group");
	session_destroy();
	
	if (!empty($old_user)) {
		if ($result) {
			header('Location: '.$http.'login/?err_msg=6');
		} else {
			echo("Sorry you could not be logged out!! <br />Please <a href=\"logout.php\">try again here</a>");
		}
	}
?>