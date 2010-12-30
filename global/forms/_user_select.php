::/<?php echo($section_title); ?> user
            <form action="<?php $http ?>home.php?action=<?php if ($action == "update_users") { echo("update_users2"); } else if ($action == "delete_users") { echo("delete_users2"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_select_user" id="frm_select_user" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td colspan="3" align="center"><span class="alert" id="elField0"></span></td></tr>
            	<tr>
            		<td class="normb" align="right">user</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_user" id="r_user" class="form">
            			<option value="">Select user</option>
            			<option value="">---------------------------------------</option>
<?php 
            			if (isset($options)) {echo($options);}
?>
            		</select></td>
            	</tr>
             <tr><td colspan="3"><span class="alert" id="elField1"></span></td></tr>
            	<tr><td colspan="3"><img src="images/s.gif" width="1" height="5" alt="spacer" border="0" /></td></tr>
             <tr><td colspan="3" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td></tr>
            </table>
            </form>