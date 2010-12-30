<!--- 
Project name TCIAS admin section
---------------
Author : Greg Stewart
Company : Tea Cup in a storm
Email : support@teacupinastorm.com
Client : Me
Filename : _content_details.php
Path : /admin/global/forms/
Purpose : Content form
Date Created : 28/4/2002
Last Updated : 2/5/2002
Last Updated by : Greg Stewart (gregs@teacupinastorm.com)
Changes:
Notes: consider creating grouped multiple drop down boxes for existing resources there a lot of them and it might be easier to locate the resource you are after. 
 --->
::/<?php echo($section_title); ?> site content
            <form action="<?php if ($d_is_locked == 1) {echo($HTTP_REFERER);} else { ?><?php echo($http); ?>home.php?action=<?php if($action == "add_content") { echo("add_content2"); } else if ($action == "update_content2") { echo("update_content3"); } else if ($action == "delete_content2") { echo("delete_content3"); } else if ($action == "publish_content2") { echo("publish_content3"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } }?>" method="post" name="frm_add_content" id="frm_add_content" enctype="application/x-www-form-urlencoded" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
            	<tr><td colspan="5" align="center"><span class="alert" id="elField<?php $elField = 0; echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Title</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_title" id="r_title" value="<?php if ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") { if(isset($d_title)){ echo($d_title); } } ?>" size="20" class="form" /></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This will be the title of the article/text/content displayed throughout the site.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Category</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_select_category" id="select_category" class="form">
                         <option value="">Please select a category</option>
                         <option value="">-------------------------</option>
<?php 
                         echo($options);
?>
                    </select></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field refers to the category this article will be related to. Say for example you were publishing an event notice you could categorise it under the menu item company notices.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Teaser</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><textarea name="r_teaser" id="r_teaser" rows="4" cols="40" class="norm"><?php if ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") { if(isset($d_teaser)){ echo($d_teaser); } } ?></textarea></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field refers to the category this article will be related to. Say for example you were publishing an event notice you could categorise it under the menu item company notices.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Body</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td colspan="3" class="norm"><textarea name="r_body" id="r_body" rows="20" cols="100" class="norm"><?php if ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") { if(isset($d_content)){ echo($d_content); } } ?></textarea><br /><br />Enter the body of your page here. Please note HTML tags are permitted.</td>
             </tr>
             <tr><td colspan="5"><hr /></td></tr>
<?php
    if ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") {
        if ($resources && $r_counter <> 0) {
            echo($resources);
            $elField = $elField+$r_counter;
            //echo($r_counter);
?>
                <input type="Hidden" name="hdn_counter" id="hdn_counter" value="<?php if (isset($counter)) { echo($counter); } ?>">
<?php
        }
    }
?>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Resources</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_select_resource[]" id="o_select_resource[]" class="form" size="8" multiple="mulitple">
                         <option value="">Please select some resources</option>
                         <option value="">-------------------------</option>
<?php 
                         echo($options4);
?>
                    </select></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Here you can associate resources, such as books and links with a page.<br /><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span><br />Add more resources for this item?<br /><input type="radio" name="r_new_resource" id="r_new_resource" value="1" class="norm" /> yes | <input type="radio" name="r_new_resource" id="r_new_resource" value="0" class="norm" checked="checked" /> no<br />How many? <input type="Text" name="o_how_many" id="o_how_many" size="3" maxlength="2" class="norm" /></td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
<?php
    if ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") {
        if (isset($articles) && $a_counter <> 0) {
            echo($articles);
            $elField = $elField+$a_counter;
        }
    }
?>               
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Related content</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_select_related_content[]" id="o_select_related_content[]" class="form" size="8" multiple="mulitple">
                         <option value="">Please select related content</option>
                         <option value="">-------------------------</option>
<?php 
                         echo($options2);
?>
                    </select></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Please select any articles that may relate to the content you have just provided.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Publication date</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_publish_day[]" id="o_publish_day[]" class="form">
<?php 
                         if (isset($options_day)) echo($options_day);
?>
                  </select><select name="o_publish_month[]" id="o_publish_month[]" class="form">
<?php 
                         if (isset($options_month)) echo($options_month);
?>
                  </select><select name="o_publish_year[]" id="o_publish_year[]" class="form">
<?php 
                         if (isset($options_year)) echo($options_year);
?>
                  </select></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">You may specify a date for your content to appear on your site. Please use specify the date in this format dd/mm/yyyy.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="80">Expiry date</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="o_expiry_day[]" id="o_expiry_day[]" class="form">
<?php 
                         if (isset($options_e_day)) echo($options_e_day);
?>
                  </select><select name="o_expiry_month[]" id="o_expiry_month[]" class="form">
<?php 
                         if (isset($options_e_month)) echo($options_e_month);
?>
                  </select><select name="o_expiry_year[]" id="o_expiry_year[]" class="form">
<?php 
                         if (isset($options_e_year)) echo($options_e_year);
?>
                  </select></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">You may specify a date for your content to no longer display on your site. Please use specify the date in this format dd/mm/yyyy.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
            	<tr><td colspan="5"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right">Meta data</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><textarea name="o_meta_data" id="o_meta_data" rows="7" cols="50" class="form"><?php if ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") { if(isset($d_cat_meta)){ echo($d_cat_meta); } } ?></textarea></td>
              	<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Optionally you can specify Meta Data keywords for this category. Your developers can then access this information and retrieve content and category specific keywords.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
<?php
    if ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") {
?>
                <input type="Hidden" name="hdn_content_id" id="hdn_content_id" value="<?php echo($r_content) ?>" />
<?php
    }
?>                
             <tr>
            		<td colspan="2" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="<?php if ($d_is_locked == 1) {echo("Back");} else { echo("Submit");} ?>" class="form" /></form></td><td colspan="3"><?php if ($d_is_locked != 1 && ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2")) { ?><form action="home.php?action=update_content_cancel&cat_id=c2640e5a57929591f73fca38f5ac8d00&content_id=<?php echo($r_content); ?>" method="post" name="frm_cancel" id="frm_cancel" enctype="application/x-www-form-urlencoded"><input type="submit" name="btn_cancel" id="btn_cancel" value="cancel" class="form" /></form><?php } ?></td>
            	</tr>
            </table>
            