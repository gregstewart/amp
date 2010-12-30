<?php 
	// logged in status check first
	session_start();
	if (!session_is_registered("session_id")) {
		header('Location:'.$http.'login/?err_msg=7');
	} else {
    if (eregi('index.php', $_SERVER['SCRIPT_NAME'])) {
    	header('Location:'.$http.'home.php');
	  }
  }
?>