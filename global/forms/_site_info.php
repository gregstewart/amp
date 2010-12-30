            ::/<?php echo($section_title); ?>
            <form action="<?php $http ?>home.php?action=<? if ($action == "site_info") { echo("site_info2"); } else if ($action == "updatesite_info") { echo("updatesite_info2"); } else if ($action == "deletesite_info") { echo("deletesite_info2"); }?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_add_site_info" id="frm_add_site_info" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
            	<tr><td colspan="5"><span class="alert" id="elField0"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">display name</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_name" id="r_name" value="<?php if(isset($r_name)){ echo($r_name); } ?>" size="20" class="form" disabled="disabled" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field is fore the name of your site, this was specified in the previous form when naming your category.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField1"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">url</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_site" id="r_site" value="<?php if(isset($r_url)){ echo($r_url); } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This is url of the site you are creating.</td>
            	</tr>
            	<tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField2"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">drop down</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_drop_down" id="o_drop_down" class="form">
                        <option value="1"<?php if(isset($r_dropdown) && $r_dropdown == 1){ echo(" selected=\"selected\""); } ?>>Yes</option>
                        <option value="0"<?php if(isset($r_dropdown) && $r_dropdown == 0){ echo(" selected=\"selected\""); } ?>>No</option>
            		</select></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Here you specify whether you wish to have a drop down/pop up driven website. Drop down will generate vertical menus (as on this site) and pop up will create horizontal menus (such as in a right sided navigation with menus opping up the right side of it). Selecting this option will execute a part of the script that will generate the appropriate type.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField3"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">orientation</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_orientation" id="o_orientation" class="form">
                        <option value="1"<?php if(isset($r_orientation) && $r_orientation == 1){ echo(" selected=\"selected\""); } ?>>Left</option>
                        <option value="0"<?php if(isset($r_orientation) && $r_orientation == 0){ echo(" selected=\"selected\""); } ?>>Right</option>
            		</select></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Seelct whether your menu will appear on the left hand side or right hand side of the screen.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField4"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">start position</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_start_position" id="o_start_position" value="<?php if(isset($r_start_pos)){ echo($r_start_pos); } ?>" size="4" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Specify the value in pixels of your pop up/drop down menus starting position offset from the top of the screen.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField5"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">left position</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_left_position" id="o_left_position" value="<?php if(isset($r_left_pos)){ echo($r_left_pos); } ?>" size="4" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Again in pixels specify the left offset fromt he screen starting positoin of your pop up/drop down menu.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField6"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">menu spacing</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_menu_spacing" id="o_menu_spacing" value="<?php if(isset($r_menu_spacing)){ echo($r_menu_spacing); } ?>" size="4" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">The value stored here is to indicate the spacing between the individual menu items. This is needed by the script to determine the dynamic starting positions of the subesequent menu items.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField7"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">upload limit</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm"><input type="Text" name="r_upload_limit" id="r_upload_limit" value="<?php if(isset($r_upload_limit)){ echo($r_upload_limit); } ?>" size="4" class="form" /> bytes</td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">The value value specified here will be used to limit the file size that can be uploaded by a user. Leaving this field blank or set to 0 indicates that you are not restricting the upload file size limit.</td>
            	</tr>
                    <input type="Hidden" name="hdn_site_name" id="hdn_site_name" value="<?php if(isset($r_name)) { echo($r_name); } ?>" />
                    <input type="Hidden" name="hdn_cat_id" id="hdn_cat_id" value="<?php if(isset($hdn_cat_id)) { echo($hdn_cat_id); } ?>" />
              	<tr><td colspan="5"><hr /></td></tr>
            	<tr>
            		<td colspan="5" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td>
            	</tr>
            </table>
            </form>