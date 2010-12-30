<!--- 
Project name TCIAS admin section
---------------
Author : Greg Stewart
Company : Tea Cup in a storm
Email : support@teacupinastorm.com
Client : Me
Filename : index.php
Path : /admin/login/
Purpose : Index page for login if users is not already logged into application
Date Created : 10/4/2002
Last Updated : 10/4/2002
Last Updated by : Greg Stewart (gregs@teacupinastorm)
Changes: 
 ---> 
<?php 
	include ("../global/_config_info.php");
	$page_title = ":: admin.teacupinastorm.com :: login page";
	$http = $config['url'];
  //$http = "http://www.teacupinastorm.com/tcias_admin/";
	if (isset($err_msg)) {
		if ($err_msg == 1) {
			$msg = "Sorry your form submission appears to have caused an error, reason: No values where passed to the login page. Please make sure to complete all the form elements below";
		} else if ($err_msg == 2) {
			$msg = "Somehow you have managed to submit null values. This is also not permitted please make sure to complete the form in it's entirety. Thanks.";
		} else if ($err_msg == 3) {
			$msg = "Sorry a database error has occured. Please try again later";
		} else if ($err_msg == 4) {
			$msg = "Sorry no user with the username and password combination you submitted has been found. Please try again";
		} else if ($err_msg == 5) {
			$msg = "Sorry unable to connect to the database. Please try again later";
		} else if ($err_msg == 6) {
			$msg = "You have successfully been logged out of the application.";
		} else if ($err_msg == 7) {
			$msg = "You are currently not logged in. Please do so now.";
		} else if ($err_msg == 8) {
			$msg = "Error executing the query.  Sorry about the inconvenience, please come back later and try again.";
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?php echo($page_title); ?></title>
	<!--- -Include style sheet- --->
    <link rel="stylesheet" type="text/css" href="<?php echo($http) ?>global/css/gregs_tcias.css">
	<script language="JavaScript1.2" type="text/javascript" src="<?php echo($http) ?>global/js/c_validation.js"></script>
     <script language="JavaScript1.2" type="text/javascript">
          function setFocus() {
               document.frm_login.r_username.focus();
          }
     </script>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" onload="return setFocus();">
<!--- -page header goes here - gvs - 13/4/2002- --->
<table border="0" cellpadding="0" cellspacing="0" width="780">
	<tr><td colspan="7"><img src="<?php echo($http) ?>images/s.gif" width="1" height="30" alt="spacer" border="0" /></td></tr>
	<tr class="light_gray">
		<td width="1%"><img src="<?php echo($http) ?>images/s.gif" width="15" height="27" alt="spacer" border="0" /></td>
		<td width="50%"><span class="light_grayb"><?php echo($page_title); ?></span><!-- <img src="images/img_title.gif" width="242" height="14" alt=":: greg.Tea cup in a storm.com  ::" border="0"> --></td>
		<td width="1%"><img src="<?php echo($http) ?>images/s.gif" width="20" height="27" alt="spacer" border="0" /></td>
	</tr>
	<tr><td colspan="7"><img src="<?php echo($http) ?>images/s.gif" width="1" height="10" alt="spacer" border="0" /></td></tr>
</table>
<!--- -Message display goes here- --->
<table border="0" cellspacing="0" cellpadding="0" width="500">
	<!--- -Display any error messages in this row here- --->
	<tr>
		<td rowspan="5"><img src="<?php echo($http) ?>images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
		<td colspan="5" align="center"><p><?php
		if (isset($msg)) {
			echo("<span class=\"alert\">".$msg."</span>");
		}
	 ?></p>
	</td></tr>
	<tr><td colspan="5"><img src="<?php echo($http) ?>images/s.gif" width="10" height="15" alt="spacer" border="0" /></td></tr>
	<form action="<?php echo($http) ?>login/login.php" method="POST" name="frm_login" id="frm_login" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
	<tr>
		<td class="normb" align="right">Username: </td>
	    <td><img src="<?php echo($http) ?>images/s.gif" width="10" height="1" alt="spacer" border="0" /></td>
		<td><input type="text" size="10" name="r_username" id="r_username" class="form" /></td>
		<td><img src="<?php echo($http) ?>images/s.gif" width="10" height="1" alt="spacer" border="0" /></td>
		<td><span class="alert" id="elField0"></span></td>
	</tr>
	<tr>
		<td class="normb" align="right">Password: </td>
	    <td><img src="<?php echo($http) ?>images/s.gif" width="10" height="1" alt="spacer" border="0" /></td>
		<td><input type="password" size="10" name="r_password" id="r_password" class="form" /></td>
		<td><img src="<?php echo($http) ?>images/s.gif" width="10" height="1" alt="spacer" border="0" /></td>
		<td><span class="alert" id="elField1"></span></td>
	</tr>
    <input type="Hidden" name="r_verify_password" id="r_verify_password" value="0">
	<tr><td colspan="5"><img src="<?php echo($http) ?>images/s.gif" width="10" height="15" alt="spacer" border="0" /></td></tr>
	<tr>
		<td colspan="5" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Log In" class="form" /></td> 
	</tr> 
	</form> 
</table> 

</body>
</html>