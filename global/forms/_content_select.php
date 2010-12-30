::/<?php echo($section_title); ?> content
            <form action="<?php $http ?>home.php?action=<?php if($action == "delete_content") { echo("delete_content2"); } else if ($action == "update_content") { echo("update_content2"); } else if ($action == "publish_content") { echo("publish_content2"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_add_category" id="frm_add_category" enctype="application/x-www-form-urlencoded">
            <table border="0" cellpadding="0" cellspacing="0">
              <?php
								if (isset($err)) {
							?>
							<tr><td colspan="3" align="center"><span class="alert">Please either select an article to update or specify whether you wish to display published or unpliched content only before making your selection</span></td></tr>
            	<tr><td colspan="3"><img src="images/s.gif" width="1" height="5" alt="spacer" border="0" /></td></tr>
             	<?php
								}
							?>
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
             <tr><td colspan="3"><img src="images/s.gif" width="1" height="5" alt="spacer" border="0" /></td></tr>
             <tr><td colspan="3"><span class="alert" id="elField1"></span><span class="alert" id="elField2"></span></td></tr>
             <tr>
						 	<td class="normb">Please display only:</td>
           		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
							<td class="norm"><input type="radio" name="o_restrict" id="o_restrict" value="1"<?php if (isset($o_restrict) && $o_restrict == 1) { echo(" checked=\"checked\"");} ?> /> published or <input type="radio" name="o_restrict" id="o_restrict" value="0"<?php if (isset($o_restrict) && $o_restrict == 0) { echo("checked=\"checked\"");} ?> /> not published content</td>
						 </tr>
             <tr><td colspan="3"><img src="images/s.gif" width="1" height="5" alt="spacer" border="0" /></td></tr>
             <tr><td colspan="3" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td></tr>
            </table>
            </form>