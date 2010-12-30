::/<?php echo($section_title); ?> a category
            <form action="<?php $http ?>home.php?action=<?php if($action == "add_categories") { echo("add_categories2"); } else if ($action == "update_categories2") { echo("update_categories3"); } else if ($action == "delete_categories2") { echo("delete_categories3"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_add_category" id="frm_add_category" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
            	<tr><td colspan="5"><span class="alert" id="elField0"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Display name</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_name" id="r_name" value="<?php if ($action == "update_categories2" || $action == "delete_categories2") { if(isset($d_name)){ echo($d_name); } } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Please note that the name entered here along with the next level up name will be sued to generate the action command for selecting the right template. For example a display name of "update" and next upper related level of "content" would result in "update_content" or more precisely "?action=update_content".</td>
            	</tr>
              <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField1"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Sub to</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_level" id="r_level" onChange="return redirect(this.options.selectedIndex);" class="form">
            			<option value="">Please select the depth of the category</option>
            			<option value="">---------------------------------------</option>
<?php 
            			for ($i=0; $i<=$depth; $i++) {
            				echo("<option value=\"".$i."\"");
                                if ($action == "update_categories2" || $action == "delete_categories2") { 
                                    if(isset($d_level)){ 
                                        if ($d_level == $i) {
                                            echo(" selected=\"selected\"");
                                        }
                                    }
                                }
                            echo(">".$i."</option>");
            			}
?>
            		</select></td>
                <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Select the next level up to which this item is related. For example if the next level up is category and it has level of 1, then this the value you would select.</td>
            	</tr>
            	<tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField2"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Related to</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_related_to_id" id="o_related_to_id" class="form">
<?php 
            			echo($options);
                        if ($action == "update_categories2" || $action == "delete_categories2") { 
                            if(isset($d_related_to)){ 
                                if ($conn) {
                                    // figure out the depth of the menu first
                                    $result3 = mysql_query("SELECT name FROM categorisation WHERE category_id = '$d_related_to'");
                                    while ($r3 = mysql_fetch_array($result3)) {
                                        $d_related_to2 = $r3[0];
                                        echo("<option value=\"".$d_related_to."\" selected=\"selected\">".$d_related_to2."</option>");
                                    }
                                }
                            } 
                        }
?>
            		</select></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This is the element you are creating a sub element for. So if you were looking to implement an update functionality for an element content, you'd select the element content at this stage.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField3"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Image on</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_image_on" id="o_image_on" value="<?php if ($action == "update_categories2" || $action == "delete_categories2") { if(isset($d_image_on)){ echo($d_image_on); } } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field should only be completed if the item in question is part of the top level menu, i.e. the starting point of your navigation. If this is the case these menu items are comprised of roll over images and this is the image to be displayed when the mouse rolls over your menu item.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField4"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Image off</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_image_off" id="o_image_off" value="<?php if ($action == "update_categories2" || $action == "delete_categories2") { if(isset($d_image_off)){ echo($d_image_off); } } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field should only be completed if the item in question is part of the top level menu, i.e. the starting point of your navigation. If this is the case these menu items are comprised of roll over images and this is the image to be displayed when the mouse is not over your menu item.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField4"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Image size</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_image_size" id="o_image_size" value="<?php if ($action == "update_categories2" || $action == "delete_categories2") { if(isset($d_img_size)){ echo($d_img_size); } } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field should only be completed if the item in question is part of the top level menu, i.e. the starting point of your navigation. The application needs to know the width of the images in order to position the drop down menus properly in relation to aforementioned images.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField5"></span></td></tr>
            	<tr>
            		<td class="normb" align="right">Template</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_template" id="o_template" value="<?php if ($action == "update_categories2" || $action == "delete_categories2") { if(isset($d_template)){ echo($d_template); } } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Specify the template that will execute the required action, e.g. home.php.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField6"></span></td></tr>
            	<tr>
            		<td class="normb" align="right">Path</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_directory_path" id="o_directory_path" value="<?php if ($action == "update_categories2" || $action == "delete_categories2") { if(isset($d_dir_path)){ echo($d_dir_path); } } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field stores the path to the template mentioned just above.</td>
            	</tr>
                <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField7"></span></td></tr>
            	<tr>
            		<td class="normb" align="right">Category image</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_cat_image" id="o_cat_image" value="<?php if ($action == "update_categories2" || $action == "delete_categories2") { if(isset($d_cat_image)){ echo($d_cat_image); } } ?>" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field stores an image to be displayed on pages to represent that category.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField9"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Priority</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_priority" id="r_priority" class="form">
            			<option value="">Please select the priority of the category</option>
            			<option value="">---------------------------------------</option>
<?php 
            			for ($i=1; $i<=5; $i++) {
            				echo("<option value=\"".$i."\"");
                                if ($action == "update_categories2" || $action == "delete_categories2") { 
                                    if(isset($d_priority)){ 
                                        if ($d_priority == $i) {
                                            echo(" selected=\"selected\"");
                                        }
                                    }
                                }
                            echo(">".$i."</option>");
            			}
?>
            		</select></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Here you can if required specify the order of the categories. This is usually useful for display purposes. <span class="alert_small">Please note this is currently a manual process, you have to ensure that you do not enter duplicate priorities for a category.</span></td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField10"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Meta data</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><textarea name="o_meta_data" id="o_meta_data" rows="7" cols="50" class="form"><?php if ($action == "update_categories2" || $action == "delete_categories2") { if(isset($d_cat_meta)){ echo($d_cat_meta); } } ?></textarea></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Optionally you can specify Meta Data keywords for this category. Your developers can then access this information and retrieve content and category specific keywords.</td>
            	</tr>
							      <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"></td></tr>
<?php 
                    if ($action == "update_categories2" || $action == "delete_categories2") { 
                        echo("<input type=\"Hidden\" name=\"hdn_cat_id\" id=\"hdn_cat_id\" value=\"".$r_category."\" />");
                    } 
?>
            	<tr>
            		<td colspan="5" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td>
            	</tr>
            </table>
            </form>