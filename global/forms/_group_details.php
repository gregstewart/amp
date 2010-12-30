::/<?php echo($section_title); ?> a group
            <form action="<?php $http ?>home.php?action=<?php if($action == "add_groups") { echo("add_groups2"); } else if ($action == "update_groups2") { echo("update_groups3"); } else if ($action == "delete_groups2") { echo("delete_groups3"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_add_category" id="frm_add_category" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
            	<tr><td colspan="5"><span class="alert" id="elField<?php $elField = 0; echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Display name</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_name" id="r_name" value="<?php if ($action == "update_groups2" || $action == "delete_groups2") { if(isset($group_name)){ echo($group_name); } } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Just enter the name of you group here. This name wiull be a representation of the access rights you select from the drop down below. This means that when you add user and assign him a group membership, the user will inherit the access rights of that group.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Categories</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="<?php if ($action == "update_groups2" || $action == "delete_groups2") { echo("o_"); } else { echo("r_"); } ?>category_id[]" id="<?php if ($action == "update_groups2" || $action == "delete_groups2") { echo("o_"); } else { echo("r_"); } ?>category_id[]" multiple="multiple" size="15" class="form">
            			<option value="">Please select the depth of the category</option>
            			<option value="">---------------------------------------</option>
<?php 
            			echo($access_options);
?>
            		</select></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Select the next level up to which this item is related. For example if the next level up is category and it has level of 1, then this the value you would select.</td>
            	</tr>
            	<tr><td colspan="5"><hr /></td></tr>
            	<?php 
                if (isset($access_list)) {
						      echo($access_list); 
                }
                ?>
                <input type="Hidden" name="hdn_counter" id="hdn_counter" value="<?php if (isset($counter)) { echo($counter); } ?>">
                <tr><td colspan="5"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
<?php 
                    if ($action == "update_groups2" || $action == "delete_groups2") { 
                        echo("<input type=\"Hidden\" name=\"hdn_group_id\" id=\"hdn_group_id\" value=\"".$r_group."\" />");
                    } 
?>
            	<tr>
            		<td colspan="5" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td>
            	</tr>
            </table>
            </form>