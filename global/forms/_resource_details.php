::/<?php echo($section_title); ?> site resource
            <form action="<?php $http ?>home.php?action=<?php if($action == "add_content2" || $action == "update_content3" || $action == "publish_content3") { echo("add_content3"); } else if ($action == "add_resources") { echo("add_resources2"); } else if ($action == "update_resources2") { echo("update_resources3"); } else if ($action == "delete_resources2") { echo("delete_resources3"); } ?>&amp;cat_id=<?php if(isset($cat_id)) { echo($cat_id); } ?>" method="post" name="frm_add_resource" id="frm_add_resource" enctype="multipart/form-data" onsubmit="return verify(this);">
            <table border="0" cellpadding="0" cellspacing="0">
<?php 
    if (!isset($HTTP_POST_VARS["o_how_many"])) {
?>
            	<tr><td colspan="5" align="center"><span class="alert" id="elField0"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Display name 1</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_display_name1" id="r_display_name1" value="<?php if ($action == "update_resources2" || $action == "delete_resources2") { if(isset($d_name)){ echo($d_name); } } ?>" size="20" class="form" /></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This will be the display name of the resource.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField1"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Type 1</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_select_type1" id="r_select_type1" class="form">
                         <option value="">Please select a resource type</option>
                         <option value="">-------------------------</option>
<?php 
                         echo($type_options);
?>
                    </select></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field specifies the type of the resoruce you are adding, such a link, book or document</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField2"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Value 1</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_value1" id="r_value1" value="<?php if ($action == "update_resources2" || $action == "delete_resources2") { if(isset($d_value)){ echo($d_value); } } ?>" size="30" class="norm" /></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field can be a url in the case of a link, or a file name (and path) if you are referring to a type of either download, image or document. In the case of a book, enter the link to the amazon web site wih your ID.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField3"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Description 1</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><textarea name="o_description1" id="o_description1" class="norm" rows="5" cols="40"><?php if ($action == "update_resources2" || $action == "delete_resources2") { if(isset($d_description)){ echo($d_description); } } ?></textarea></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Here you can specify some further information about the resources you are adding.</td>
            	</tr>
             <?php 
              if ($action != "delete_resources2") {
             ?>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField4"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Upload 1</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="File" name="o_upload1" id="o_upload1" value="" size="30" class="norm" /></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">If you have selected a type of resource that needs to be uploaded (such as a pdf or image, you can do so here). Also note that restrictions exist on the types of files you can upload based on the the resource type you are selecting.</td>
            	</tr>
             <?php
              }
             ?>
             <!--- -<tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField5"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Destination 1</td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_path1" id="o_path1" value="" size="30" class="norm" /></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Please provide the location where you want to store you uploaded file and this has to be sepcified relative to the admin centre. So for example, you want to upload an image to and images folder off the site root fodler and assuming that admin center is also one off the root you would specify the destination folder as "../images/". If you are unsure please contact your system administrator.</td>
            	</tr>- --->
             <tr><td colspan="5"><hr /></td></tr>
<?php 
    } else if (isset($HTTP_POST_VARS["o_how_many"]) AND $HTTP_POST_VARS["o_how_many"] <> 0 ) {
        $elField = 0;
        for ($i = 1; $i <= $HTTP_POST_VARS["o_how_many"]; $i++) {
            if ($i == 1) {
?>
                <input type="Hidden" name="hdn_loops" id="hdn_loops" value="<?php echo($HTTP_POST_VARS["o_how_many"]); ?>" />
                <input type="Hidden" name="hdn_content_id" id="hdn_content_id" value="<?php echo($token ); ?>" />
<?php
                $elField++;
            }
?>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Display name <?php echo($i); ?></td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_display_name<?php echo($i); ?>" id="r_display_name<?php echo($i); ?>" value="" size="20" class="form" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This will be the display name of the resource.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
               <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Type <?php echo($i); ?></td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><select name="r_select_type<?php echo($i); ?>" id="r_select_type<?php echo($i); ?>" class="form">
                         <option value="">Please select a resource type</option>
                         <option value="">-------------------------</option>
<?php 
                         echo($type_options);
?>
                    </select></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field specifies the type of the resoruce you are adding, such a link, book or document</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
               <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Value <?php echo($i); ?></td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="r_value<?php echo($i); ?>" id="r_value<?php echo($i); ?>" value="" size="30" class="norm" /></td>
                    <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">This field can be a url in the case of a link, or a file name (and path) if you are referring to a type of either download, image or document. In the case of a book, enter the link to the amazon web site wih your ID.</td>
            	</tr>
               <tr><td colspan="5"><hr /></td></tr>
               <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Description <?php echo($i); ?></td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><textarea name="o_description<?php echo($i); ?>" id="o_description<?php echo($i); ?>" class="norm" rows="5" cols="40"><?php if ($action == "update_resources2" || $action == "delete_resources2") { if(isset($d_description)){ echo($d_description); } } ?></textarea></td>
                <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Here you can specify some further information about the resources you are adding.</td>
            	</tr>
             <tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Upload <?php echo($i); ?></td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="File" name="o_upload<?php echo($i); ?>" id="o_upload<?php echo($i); ?>" value="" size="30" class="norm" /></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">If you have selected a type of resource that needs to be uploaded (such as a pdf or image, you can do so here). Also note that restrictions exist on the types of files you can upload based on the the resource type you are selecting.</td>
            	</tr>
             <!--- -<tr><td colspan="5"><hr /></td></tr>
             <tr><td colspan="5" align="center"><span class="alert" id="elField<?php echo($elField); $elField++; ?>"></span></td></tr>
            	<tr valign="top">
            		<td class="normb" align="right" width="100">Destination <?php echo($i); ?></td>
            		<td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td><input type="Text" name="o_path<?php echo($i); ?>" id="o_path<?php echo($i); ?>" value="" size="30" class="norm" /></td>
              <td><img src="images/s.gif" width="20" height="15" alt="spacer" border="0" /></td>
            		<td class="norm">Please provide the location where you want to store you uploaded file and this has to be sepcified relative to the admin centre. So for example, you want to upload an image to and images folder off the site root fodler and assuming that admin center is also one off the root you would specify the destination folder as "../images/". If you are unsure please contact your system administrator.</td>
            	</tr>- --->
             <tr><td colspan="5"><hr /></td></tr>
<?php
        }
    }
    
    if ($action == "update_resources2" || $action == "delete_resources2") {
        if (isset($r_resource)) {
?>
                <input type="Hidden" name="hdn_resource_id" id="hdn_resource_id" value="<?php echo($r_resource); ?>" />
<?php 
        } else {
            echo("The selected resource has not been passed by the form");
            exit;
        }
    } else if (!isset($action)) {
        echo("Action error has occured");
        exit;
    }
?>                
               <tr>
            	    <td colspan="5" align="center"><input type="Submit" name="btn_submit" id="btn_submit" value="Submit" class="form" /></td>
               </tr>
            </table>
            </form>