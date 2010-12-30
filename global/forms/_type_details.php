::/<?php if (isset($section_title)) {echo($section_title);} ?> site resource type
            <form action="<?php $http ?>home.php?action=<?php if ($action == "add type_resources") { echo("add type_resources2"); } else if ($action == "update type_resources2") { echo("update type_resources3"); } else if ($action == "delete type_resources2") { echo("delete type_resources3"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_add_type" id="frm_add_type" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
            	<tr><td colspan="5" align="center"><span class="alert" id="elField<?php $elField = 0; echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">display name</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_display_name" id="r_display_name" value="<?php if (isset($d_display_name)) { echo($d_display_name); } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field refers to the diaply name of the resource type you are adding. For example if you were adding a resource type for word documents you could specify: Word document.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">file extension</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_extension" id="o_extension" value="<?php if (isset($d_extension)) { echo($d_extension); } ?>" size="5" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This refers to the file extension associated for this resource type. <span class="alert">Please note you can only specify one extension type for each resource you are adding. If you plan on adding more than one extenison for each type, pleas emake seperate entries. Also just specify the extension without pre-ceeding it with a full stop, i.e. "gif" instead of ".gif"</span></td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
<?php 
    if ($action == "update type_resources2" || $action == "delete type_resources2") {
?>
                <input type="Hidden" name="hdn_type_id" id="hdn_type_id" value="<?php echo($HTTP_POST_VARS["r_type"]) ?>" />
<?php 
    }
?>
                <tr>
            	    <td colspan="5" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td>
                </tr>
            </table>
            </form>