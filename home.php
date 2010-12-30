<?php include("global/config.php") ?>
<?php $page_title = $page_title." home"; ?>
<?php
	if (isset($action)) {
        // first thing we'll do is chekc for access rights
	    $conn = db_connect(); // connect to the database
        if ($conn) { // success
            $sql = "SELECT user_id FROM user_resource_access WHERE user_id = '".$session_id."' AND category_id = '".$cat_id."'";
            $result = mysql_query($sql);
            if ($result) { // query executed successfully
                $total = mysql_numrows($result);
                if ($total == 1) { // User has access
                    // $msg = "Access granted.<br />";
                    $display_content = 1; // set flag to display content
                    // now process the logic
                    include("global/_home_process.php");
                } else { // user doesn't have access hide content and show message
                    $display_content = 0;
                    $msg = "Access to this resource has been restricted. Please contact your sysadmin to obtain access to this resource.<br />";
                }
            } else {
                $msg = "Query error: SELECT user_id FROM user_resource_access WHERE user_id = '".$session_id."' AND category_id = '".$cat_id."'.<br />";
            }
        } else {
            $msg = "Database connection error.<br />";
        }
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><?php echo($page_title); ?></title>
	<!--- -Include style sheet- --->
 <link rel="stylesheet" type="text/css" href="global/css/gregs_tcias.css">
	<!--- -roll over script- --->
	<script language="JavaScript1.2" type="text/javascript" src="global/js/_roll_over.js"></script>
 <!--- -validation script- --->
	<script language="JavaScript1.2" type="text/javascript" src="global/js/c_validation.js"></script>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	<!--
	
	if(window.event + "" == "undefined") event = null;
	function HM_f_PopUp(){return false};
	function HM_f_PopDown(){return false};
	popUp = HM_f_PopUp;
	popDown = HM_f_PopDown;
	
	//-->
	</SCRIPT>
	<!--- -Include menu main script- --->
	<SCRIPT LANGUAGE="JavaScript1.2" TYPE="text/javascript" src="global/js/HM_Main.js"></SCRIPT>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<!--- -header included here - gvs 13/4/2002- --->
<?php include("global/_header.php") ?>

<!--- -breadcrumb included here - gvs 13/4/2002- --->
<?php include("global/_breadcrumb.php") ?>

<!--- -Main starts here - gvs - 13/4/2002- --->
<table border="0" cellpadding="0" cellspacing="0" width="765">
	<tr>
		<td rowspan="3" width="1%"><img src="images/s.gif" width="40" height="15" alt="spacer" border="0" /></td>
		<td class="normb" width="99%"><div align="center">Welcome to the site admin section.</div></td>
	</tr>
     <tr><td><img src="images/s.gif" width="1" height="15" alt="spacer" border="0" /></td></tr>
	<tr><td class="normb">
<?php 
	if (isset($action) && $denied == 1) {
        if (isset($msg)) {
            echo("<div><p><span class=\"alert\">".$msg."</span></p></div>");
        }
        
        // this include contains all the conditional display information
        if ($display_content == 1) { // if the user has access then display the content
            include ("global/_home_display.php");
        }
	} else { // this appears when the user first logs in
        echo("Hey there ".$session_firstname." ".$session_name." with ID ".$session_id."<br />");
        if (isset($msg)) {
            echo("<br /><span class=\"alert\">".$msg."</span>");
        }
	}
?>
	</td></tr>
</table>


<!--- -body ends here - gvs - 5/4/2002- --->

<!--- -include footer here- --->
<?php include("global/_footer.php") ?>

<?php
	if (isset($action)) {
		if ($action == "add_categories" || $action == "update_categories2" || $action == "delete_categories2") {
               include("global/js/_drop_relate.php");
							 // To be used to determine which priorities are to be used for a category
							 //include("global/js/_drop_relate2.php");
		}
	}
?>
</body>
</html>
