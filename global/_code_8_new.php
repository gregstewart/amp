<?php
if ($HTTP_POST_VARS["r_display_name"]) {
    $msg = "";
    $connt = db_connect();
    if ($conn) { // start inserting new resource
        if (!isset($hdn_resource_id)) { // if not defined then add resource
            $token = md5(uniqid(rand(),1)); // unique ID
            $result = mysql_query("INSERT INTO resources (resource_id, display_name, value, resource_type, description) VALUES ('$token', '".addslashes($r_display_name)."', '".addslashes($r_value)."', '$r_select_type', '".addslashes($o_description)."')");
            if ($result) { // start inserting the association
                $msg = $msg."Resource ".$token." added successfully.<br />";
                
                // now look to see if you can upload the file
                if ($o_upload!="") {
                 $sql2 = "select extension from type where type_id = '".$r_select_type."'";
                 $result2 =  mysql_query($sql2);
                 
                 if($result2) {
                  while ($r2 = mysql_fetch_array($result2)) {
                   $file_extension_allowed = $r2[0];
                  }
                 }
                 if (isset($file_extension_allowed) && $file_extension_allowed != "") {
                  include("_upload.php");
                 } else {
                  $msg .= "Sorry the type you specified does not permit uploads. As indicated this item has been now been added, to now upload a file please go and update this item and make sure you select a file type that allows uploads.<br />";
                 }
                }
                if (isset($hdn_content_id)) {
                    $result2 = mysql_query("INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('$token', '$hdn_content_id', '$r_select_type')");
                    if ($result2) {
                        $msg = $msg."Resource ".$token." successfully associated with ".$HTTP_POST_VARS["hdn_content_id"].".<br />";
                    } else {
                        $msg = $msg."<br />database error: INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('".$token."', '".$hdn_content_id."', '".$r_select_type."')<br />";
                    }
                }
            } else {
                $msg = $msg."Query error: INSERT INTO resources (resource_id, display_name, value, resource_type) VALUES ('".$token."', '".$string."', '".$string3."', '".$string2."')";
            }
        } else { // update and delete takes place here
            if ($action == "update_resources3") {
                $result = mysql_query("UPDATE resources SET display_name = '$string', value = '$string3', resource_type = '$string2', description = '$string4' WHERE resource_id = '$hdn_resource_id'");
                if($result) {
                    $msg = $msg."Resource ".$hdn_resource_id." updated successfully.<br />";
                } else {
                    $msg = $msg."Resource ".$hdn_resource_id." has not been updated.<br />";
                }
            } else if ($action == "delete_resources3") {
                $result = mysql_query("DELETE FROM resources WHERE resource_id = '$hdn_resource_id'");
                if($result) {
                    $msg = $msg."Resource ".$hdn_resource_id." deleted successfully.<br />";
                } else {
                    $msg = $msg."Resource ".$hdn_resource_id." has not been deleted.<br />";
                }
            } else {
                echo("Update or delete should take place but an error has occured (see line 409 in _home_process.php).");
                exit;
            }
        }
    } else {
        $msg = $msg."Database connection error";
    }
} else {
    $msg = "Sorry no form content submitted";
}
?>
