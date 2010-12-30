::/<?php echo($section_title); ?> content
            <form action="<?php $http ?>home.php?action=<?php if($action == "rollback_content") { echo("rollback_content2"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_add_category" id="frm_add_category" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td colspan="3" align="center"><span class="alert" id="elField0"></span></td></tr>
            	<tr>
            		<td class="normb" align="right">content</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_content" id="r_content" class="form">
            			<option value="">Select content</option>
            			<option value="">---------------------------------------</option>
<?php 
            			echo($options);
?>
            		</select></td>
            	</tr>
             <tr><td colspan="3"><span class="alert" id="elField1"></span></td></tr>
            	<tr><td colspan="3"><img src="images/s.gif" width="1" height="5" alt="spacer" border="0" /></td></tr>
             <tr><td colspan="3" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td></tr>
            </table>
            </form>