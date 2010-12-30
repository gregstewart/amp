<?php
	include ("../global/_config_info.php");
	include ("../global/db_stuff.php");
	$http = $config['url'];
  //$http = "http://www.teacupinastorm.com/tcias_admin/";
  if (isset($r_username) && isset($r_password)) {
		if (!$r_username == "" || !$r_password == "") {
			//echo("here the value for username is: ".$r_username." and the value for password is: ".$r_password);
			$conn = db_connect(); // try to connect to database
			if ($conn) {
				$salt = substr($r_password, 0, 2);
    		$userPswd = crypt($r_password, $salt);
    		//echo($userPswd);
    		//echo("<br />connection established: ".$conn);
				$result = mysql_query("SELECT user_id, name, firstname, group_membership FROM users WHERE username = '$r_username' AND password = '$userPswd'");
				if ($result) {
     		$numrows = mysql_num_rows($result);
 				if ($numrows == 1) { // One user found
 					//echo("<br />One user found");
 					while ($r = mysql_fetch_array($result)) { // retrieve the result and set it for use in the page
       			$d_user_id = $r[0];
 						$d_name = $r[1];
 						$d_firstname = $r[2];
       			$d_group = $r[3];
 						//echo("<br />User id is : ".$d_user_id);
 					}
 					if (!isset($d_user_id)) { // no user found
 						header("Location: ".$http."login/?err_msg=4");
 					}
 					// set the session variable
 					session_start();
 					session_register("session_id", "session_name", "session_firstname", "session_group");
 					$session_id = $d_user_id;
 					$session_name = $d_name;
 					$session_firstname = $d_firstname;
      $session_group = $d_group;
      // echo($session_group);
 					// and then redirect to home
 					header("Location: ".$http."home.php");
 				} else if ($numrows > 1) { // more than one user returned
 					header("Location: ".$http."login/?err_msg=3");
 				} else {
      header("Location: ".$http."login/?err_msg=4");
     }
    } else {
     header("Location: ".$http."login/?err_msg=8");
    }
   } else { //  no connection
				header("Location: ".$http."login/?err_msg=5");
			}
		} else { // null values submitted and by passed the jscript redirect once again
			header("Location: ".$http."login/?err_msg=2");
		}
	} else { // no form submitted, i.e. page directly called re-direct
		header("Location: ".$http."login/?err_msg=1");
	}
 ?>
 
<!--- 
Project name TCIAS admin section
---------------
Author : Greg Stewart
Company : Tea Cup in a storm
Email : support@teacupinastorm.com
Client : Me
Filename : login.php
Path : /admin/login/
Purpose : Holds the user authentication logic
Date Created : 13/4/2002
Last Updated : 13/4/2002
Last Updated by : Greg Stewart (gregs@teacupinastorm.com)
Changes: 
 --->