<?php
$msg = "";
$conn = db_connect();

if ($conn) {
    //echo($r_select_category." category_id");
    
    /* since we are carrying out an update we need to archive the existing content
     to build up a version history. First get the existing content, then dump it
     into the archive_content table
    */
    
    $sql0 = "SELECT content_category_id, content_teaser, content_title, content, content_type, published, date_written, date_published, date_expires, date_modified, author FROM content WHERE content_id = '".$cont_id."'";
    $result0 = mysql_query($sql0);
    
    if (!$result0)
     $msg .= "Error occured:<br />Query failed ".$sql0."<br />";
    
    $total0 = mysql_numrows($result0);
    
    if ($total0 != 1) {
     $msg .= "Error occured:<br />Query (".$sql0.") returned 0 or too many records. Archiving halted.<br />";
    } else { // found the record now let's store it in the archive
     $archive_id = md5(uniqid(rand(),1));
     while ($r0 = mysql_fetch_array($result0)) {
      $sql0a = "INSERT INTO content_archive 
      (archive_id, content_id, content_category_id, content_teaser, content_title, content, content_type, published, date_written, date_published, date_expires, date_modified, author) 
      VALUES 
      ('$archive_id', '$cont_id', '$r0[0]', '$r0[1]', '$r0[2]', '$r0[3]', '$r0[4]', $r0[5], '$r0[6]', '$r0[7]', '$r0[8]', '$r0[9]', '$session_id')";

      $result0a = mysql_query($sql0a);
      
      if (!$result0a) {
       $msg .= "Error occured:<br />Query failed ".$sql0a.".<br />";
      } else {
       $msg .= "Version control notification:<br />Old content successfully archived.<br />";
      }
     }
    }
    
    /* now we can update the information first pull out the 
    selected archive information and thn update the content 
    in main table
    */
    
    $sql0b = "select content_category_id, content_teaser, content_title, content, published, date_written, date_published, date_expires, date_modified, author FROM content_archive WHERE archive_id = '".$arch_id."'";
    $result0b = mysql_query($sql0b);
    
    if (!$result0b)
     $msg .= "Query failed: ".$sql0b.".<br />";
    
    $total0b = mysql_numrows($result0b);
    if ($total0b == 1) {
     // 1 row returned
     while ($r0b = mysql_fetch_array($result0b)) {
      $r_select_category = $r0b[0];
      $r_teaser = $r0b[1];
      $r_title = $r0b[2];
      $r_body = $r0b[3];
      $r_published = $r0b[4];
      $date_written = $r0b[5];
      $publish_date = $r0b[6];
      $expiry_date = $r0b[7];
      $r_author = $r0b[9];
     }
     
     $sql = "UPDATE content SET content_category_id = '$r_select_category', content_teaser = '$r_teaser', content_title = '$r_title', content = '$r_body', published = $r_published, date_written = '$date_written', date_published = '$publish_date', date_expires = '$expiry_date', date_modified = NOW(), author = '$r_author', checked_out = 0 WHERE content_id = '".$cont_id."'";
     
     $result2 = mysql_query($sql);
     if($result2) {
         $msg = $msg."Content (".$cont_id.") has been rolled back to previous state.<br />";
     } else {
      $msg .= "Query failed: ".$sql.".<br />";
     }
    } else {
     $msg .= "Query returned 0 records: ".$sql0b.".<br />";
    }
}

// now add the new resources
if (isset($HTTP_POST_VARS["o_select_resource"])) {
    if ($conn) {
        //this query will make sure that no duplicates are inserted
        $result3 = mysql_query("SELECT resource_id FROM related_resources_to_content WHERE content_id = '$token'");
        for ($i = 0; $i < count($HTTP_POST_VARS["o_select_resource"]); $i++) { // duplicate check
            $insert = 1;
            if ($result3) {
                //$total = mysql_num_rows($result3);
                while ($r3 = mysql_fetch_array($result3)) {
                    //echo($r3[0]." = ".$o_select_resource[$i]."<br />");
                    if ($r3[0] == $o_select_resource[$i]) {
                        $insert = 0;
                        break;
                    }
                }
            }
            //echo("resource id = ".$o_select_resource[$i]."<br />");
            if ($o_select_resource[$i] != "") {
                if ($insert == 1) {
                    $result5 = mysql_query("SELECT resource_type FROM resources WHERE resource_id = '$o_select_resource[$i]'");
                    if ($result5) {
                        $total5 = mysql_num_rows($result5);
                        //echo("Total: ".$total5."<br />");
                        if ($total5 == 1) {
                            while ($r5 = mysql_fetch_array($result5)) {
                                $d_type = $r5[0];
                                $set_var = 1;
                            }
                        } else {
                            echo("db error: SELECT resource_type FROM resources WHERE resource_id = '$o_select_resource[$i]'");
                            exit;
                        }
                    }
                    if (isset($set_var)) {
                        $result1 = mysql_query("INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('$o_select_resource[$i]', '$token', '$d_type')");
                        //echo($o_select_resource[$i]." would have been inserted<br />");
                        if ($result1) { // if insert successful...
                            $msg = $msg."<br />Related resource ".$o_select_resource[$i]." has been added.";
                        }
                    }
                } else {
                    $d_type = "not found";
                    $msg = $msg."<br />Related resource ".$o_select_resource[$i]." has been rejected - INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('".$o_select_resource[$i]."', '".$token."', '".$d_type."')";
                }
            } else {
                $msg = $msg."The selected resource was empty.<br />";
            }
        }
    }
}

// same again for related content
if (isset($HTTP_POST_VARS["o_select_related_content"])) {
    if ($conn) {
        $fields_submitted = count($HTTP_POST_VARS["o_select_related_content"]);
        $result3 = mysql_query("SELECT resource_id FROM related_resources_to_content WHERE content_id = '$token'");
        for ($i = 0; $i < $fields_submitted; $i++) {
            $insert = 1;
            if ($result3) {
                while ($r3 = mysql_fetch_array($result3)) {
                    //echo($fields_submitted." is the number of firlds submitted. -- ".$i." is the current array item -- db item ".$r3[0]." = ".$o_select_related_content[$i]." field item<br />");
                    if ($r3[0] == $o_select_related_content[$i]) {
                        $insert = 0;
                        //echo("do not insert above<br />");
                        break;
                    }
                }
            } else {
                echo("no records found for= SELECT resource_id FROM related_resources_to_content WHERE content_id = '".$token."'");
            }
    
            if ($insert == 1) {
                $result1 = mysql_query("INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('$o_select_related_content[$i]', '$token', 'bb4f74b892a4854e3f0bcf262acf1e09')");
                //echo($o_select_related_content[$i]. " = Would have been inserted <br />");
                if ($result1) {
                    $msg = $msg."<br />Related content ".$o_select_related_content[$i]." has been added.";
                }
            } else {
                $msg = $msg."<br />Related content ".$o_select_related_content[$i]." has been rejected";
            }
            //echo("<p>$i</p>");
        }
    }
}

$msg = $msg."<p></p>";
$msg = $msg."<p><a href=\"Preview content\" class=\"normb\">Coming soon</a></p>";
if ($HTTP_POST_VARS["r_new_resource"] AND $HTTP_POST_VARS["r_new_resource"] == 1 AND $HTTP_POST_VARS["o_how_many"] <> 0) {
//include file to generate options for file types
    include("global/sql/_get_types.php");
}
?>