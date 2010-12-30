<?php        
if (isset($err_msg)) {
    echo("<span class=\"alert\">The user you submitted did not contain any group or user access information.</span><br /><br />");
}
?>

::/<?php if (isset($section_title)) {echo($section_title);} ?> site user
            <form action="<?php $http ?>home.php?action=<?php if ($action == "add_users") { echo("add_users2"); } else if ($action == "update_users2") { echo("update_users3"); } else if ($action == "delete_users2") { echo("delete_users3"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_add_user" id="frm_add_user" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
            	<tr><td colspan="5" align="center"><span class="alert" id="elField<?php $elField = 0; echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Name</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_name" id="r_name" value="<?php if (isset($d_firstname)) { echo($d_firstname); } else if (isset($session_fname)) { echo($session_fname); } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This will be the user's first name.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Surname</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_surname" id="r_surname" value="<?php if (isset($session_flname)) { echo($session_flname); } else if (isset($d_name)) { echo($d_name); } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This will be the user's last name.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">E-mail</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_email" id="r_email" value="<?php if (isset($d_email)) { echo($d_email); }  else if (isset($session_femail)) { echo($session_femail); } ?>" size="30" class="norm" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This will the user's e-mail address. Please note this email address is used by the application to notify the users of certain actions and events, please provide a genuine address.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Username</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_username" id="r_username" value="<?php if (isset($d_username)) { echo($d_username); } else if (isset($session_fusername)) { echo($session_fusername); } ?>" size="20" class="norm" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">The user's login username.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Password</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Password" name="r_password" id="r_password" value="<?php //if (isset($d_password)) { echo($d_password); } else if (isset($session_fpassword)) { echo($session_fpassword); } ?>" size="20" class="norm" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">The user's login password.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Verify password</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Password" name="r_verify_password" id="r_verify_password" value="<?php //if (isset($d_password)) { echo($d_password); } else if (isset($session_fpassword)) { echo($session_fpassword); } ?>" size="20" class="norm" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Please re-enter the password.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Group membership</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_group" id="o_group" class="form">
                         <option value="0">Please select a group membership</option>
                         <option value="0">-------------------------</option>
<?php 
                         if (isset($group_options)) {echo($group_options);}
?>
                    </select></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This selction will determine the users access controls. Admin is the highest level giving the user full access. Author, means that the user can only access content entry options (add and update). Editor has similar abilities to the author but can also publish and delete stories.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Access to</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_select_access[]" id="o_select_access[]" size="10" class="form" multiple="multiple">
                         <option value="0">Control access</option>
                         <option value="0">-------------------------</option>
<?php 
                         if (isset($access_options)) {echo($access_options);}
?>
                    </select></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Here you can further limit the users access controls, by customising his access (<span class="alert_small">please note that by selecting these options you are over writing the default settings completely, i.e. you have to manually configure all of the users access control</span>). Assuming that you only wanted to allow an autor say to update stories but not create, you would select the update option from his abilities by selecting that control level from the drop down menu and leaving everything else alone. Only selected items will be added from the access control list.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Department</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_department" id="o_department" value="<?php if (isset($session_fdepartment)) { echo($session_fdepartment); } else if (isset($d_department)) { echo($d_department); } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This allows you to specify which department or business unit the user belongs to</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
<?php 
    if ($action == "update_users2" || $action == "delete_users2") {
        if (isset($access_list) && $a_counter <> 0) {
        echo($access_list);
        $elField = $elField+$a_counter;
    }
?>
                <input type="Hidden" name="hdn_user_id" id="hdn_user_id" value="<?php echo($HTTP_POST_VARS["r_user"]) ?>" />
                <input type="Hidden" name="hdn_counter" id="hdn_counter" value="<?php if (isset($counter)) { echo($counter); } ?>">
<?php 
    }
?>
                <tr>
            	    <td colspan="5" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td>
                </tr>
            </table>
            </form>