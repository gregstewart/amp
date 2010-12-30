::/<?php echo($section_title); ?> type
            <form action="<?php $http ?>home.php?action=<?php if ($action == "update type_resources") { echo("update type_resources2"); } else if ($action == "delete type_resources") { echo("delete type_resources2"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_select_type" id="frm_select_type" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td colspan="3" align="center"><span class="alert" id="elField0"></span></td></tr>
            	<tr>
            		<td class="normb" align="right">type</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_type" id="r_type" class="form">
            			<option value="">select type</option>
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