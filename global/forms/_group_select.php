::/<?php echo($section_title); ?> group
            <form action="<?php $http ?>home.php?action=<?php if ($action == "update_groups") { echo("update_groups2"); } else if ($action == "delete_groups") { echo("delete_groups2"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_select_group" id="frm_select_group" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td colspan="3" align="center"><span class="alert" id="elField0"></span></td></tr>
            	<tr>
            		<td class="normb" align="right">group</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_group" id="r_group" class="form">
            			<option value="">Select group</option>
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