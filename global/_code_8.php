<?php
if ($HTTP_POST_VARS["r_display_name1"]) {
    $msg = "";
    if (!isset($HTTP_POST_VARS["hdn_loops"])) { // to dupe the system if only one resource is being added
        $HTTP_POST_VARS["hdn_loops"] = 1;
    }
    for ($i = 1; $i <= $HTTP_POST_VARS["hdn_loops"]; $i++) { // because dynamic length form
        // not completely flexible as you need to know how many form elements have been submitted but...
        $string = '$r_display_name'.$i; // set a string to be evaluated (firtst form field name minus number plus $i
        $string2 = '$r_select_type'.$i;
        $string3 = '$r_value'.$i;
        $string4 = '$o_description'.$i;
        if ($action != "delete_resources3") {
         $string5 = '$o_upload'.$i;
        }
        eval ("\$string = \"$string\";"); // then evaluate the string to get the current value of form value r_displayname$i
        eval ("\$string2 = \"$string2\";");
        eval ("\$string3 = \"$string3\";");
        eval ("\$string4 = \"$string4\";");
        if ($action != "delete_resources3") {
         eval ("\$string5 = \"$string5\";");
        }
        //eval ("\$string6 = \"$string6\";");
        
        $string = addslashes($string); // add slashes if required, not $string5 is dealt with in the _upload include
        $string3 = addslashes($string3);
        $string4 = addslashes($string4);
        //echo("Display_name".$i.": ".$string."<br />Type".$i.": ".$string2."<br />Value".$i.": ".$string3."<p></p>");
        $connt = db_connect();
        if ($conn) { // start inserting new resource
            if (!isset($hdn_resource_id)) { // if not defined then add resource
                $token = md5(uniqid(rand(),1)); // unique ID
                $result = mysql_query("INSERT INTO resources (resource_id, display_name, value, resource_type, description) VALUES ('$token', '$string', '$string3', '$string2', '$string4')");
                if ($result) { // start inserting the association
                    $msg = $msg."Resource ".$token." added successfully.<br />";
                    
                    // now look to see if you can upload the file
                    if ($string5!="") {
                     $sql2 = "select extension from type where type_id = '".$string2."'";
                     $result2 =  mysql_query($sql2);
                     
                     if($result2) {
                      while ($r2 = mysql_fetch_array($result2)) {
                       $file_extension_allowed = $r2[0];
                      }
                     }
                     if (isset($file_extension_allowed) && $file_extension_allowed != "") {
                      include('global/_upload.php');
                     } else {
                      $msg .= "Sorry the type you specified does not permit uploads. As indicated this item has been now been added, to now upload a file please go and update this item and make sure you select a file type that allows uploads.<br />";
                     }
                    }
                    if (isset($hdn_content_id)) {
                        $result2 = mysql_query("INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('$token', '$hdn_content_id', '$string2')");
                        if ($result2) {
                            $msg = $msg."Resource ".$token." successfully associated with ".$HTTP_POST_VARS["hdn_content_id"].".<br />";
                        } else {
                            $msg = $msg."<br />database error: INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('".$token."', '".$hdn_content_id."', '".$string2."')<br />";
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
										// now look to see if you can upload the file
                    if ($string5!="") {
                     $sql2 = "select extension from type where type_id = '".$string2."'";
                     $result2 =  mysql_query($sql2);
                     
                     if($result2) {
                      while ($r2 = mysql_fetch_array($result2)) {
                       $file_extension_allowed = $r2[0];
                      }
                     }
                     if (isset($file_extension_allowed) && $file_extension_allowed != "") {
                      include('global/_upload.php');
                     } else {
                      $msg .= "Sorry the type you specified does not permit uploads. As indicated this item has been now been added, to now upload a file please go and update this item and make sure you select a file type that allows uploads.<br />";
                     }
                    }
                } else if ($action == "delete_resources3") {
                    $result = mysql_query("DELETE FROM resources WHERE resource_id = '$hdn_resource_id'");
                    if($result) {
                        // just quickly look up the resource in the files table, if there is anything then delete it
                        $sql3 = "select * from files where resource_id = '".$hdn_resource_id."'";
                        $result3 = mysql_query($sql3);
                        
                        if ($result3) {
                         $total3 = mysql_numrows($result3);
                         if ($total3 != 0) { // item found
                          $sql4 = "DELETE FROM files where resource_id = '".$hdn_resource_id."'";
                          $result4 = mysql_query($sql4);
                          
                          if($result4) {
                           $msg .= "File (".$hdn_resource_id.") deleted from database.<br />";
                          } else {
                           $msg .= "File (".$hdn_resource_id.") not deleted from database.<br />";
                          }
                         } else {
                          $msg .= "Query returned 0 records ".$sql3.".<br />";
                         }
                        } else {
                         $msg .= "Query failed: ".$sql3.".<br />";
                        }
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
    }
    //$msg = $msg."<p><a href=\"Preview content\">Coming soon</a></p>";
} else {
    $msg = "Sorry no form content submitted";
}
?>
