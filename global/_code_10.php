<?php
// first let's remove an unwanted resources
$token = $hdn_content_id;

// if no resources allocated then this value will be null - bug fix
if (!isset($hdn_counter)) {
    $hdn_counter = 1;
}

$hdn_counter = $hdn_counter-1;
$msg = "";
$conn = db_connect();

//echo("counter = ".$hdn_counter."<br />");
for ($i = 1; $i <= $hdn_counter; $i++) { // because dynamic length form
    // not completely flexible as you need to know how many form elements have been submitted but...
    $string = 'o_existing'.$i; // set a string to be evaluated (firtst form field name minus number plus $i
    if(isset($HTTP_POST_VARS[$string])) {
        //echo($HTTP_POST_VARS[$string]."<br />");
        // now we have a condidate for deletion
        if ($conn) {
            $result = mysql_query("DELETE FROM related_resources_to_content WHERE resource_id = '$HTTP_POST_VARS[$string]' AND content_id = '$token'");
            if ($result) {
                $msg = $msg."Previously selected content (".$HTTP_POST_VARS[$string].") has been removed.<br />";
            } else {
                $msg = $msg."database error for: DELETE FROM related_resources_to_content WHERE resource_id = '".$HTTP_POST_VARS[$string]."' AND content_id = '$token'";
            }
        }
    }
}

// now let's update the body of text
$r_select_category = addslashes($r_select_category);
$r_teaser = addslashes($r_teaser);
$r_title = addslashes($r_title);
$r_body = addslashes($r_body);

// create publication date based on drop down selections
$publish_date = date("YmdHis",mktime(0,0,0,$o_publish_month[0], $o_publish_day[0], $o_publish_year[0]));
$expiry_date = date("YmdHis",mktime(0,0,0,$o_expiry_month[0], $o_expiry_day[0], $o_expiry_year[0]));

if ($conn) {
    //echo($r_select_category." category_id");
    
    /* since we are carrying out an update we need to archive the existing content
     to build up a version history. First get the existing content, then dump it
     into the archive_content table
    */
    
    $sql0 = "SELECT content_category_id, content_teaser, content_title, content, content_type, published, date_written, date_published, date_expires, date_modified, author FROM content WHERE content_id = '$token'";
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
      ('$archive_id', '$token', '$r0[0]', '$r0[1]', '$r0[2]', '$r0[3]', '$r0[4]', $r0[5], '$r0[6]', '$r0[7]', '$r0[8]', '$r0[9]', '$session_id')";

      $result0a = mysql_query($sql0a);
      
      if (!$result0a) {
       $msg .= "Error occured:<br />Query failed ".$sql0a.".<br />";
      } else {
       $msg .= "Version control notification:<br />Old content successfully archived.<br />";
      }
     }
    }
    
    // now we can update the information
    if ($action == "publish_content3") {
     $sql = "UPDATE content SET content_category_id = '$r_select_category', content_teaser = '$r_teaser', content_title = '$r_title', content = '$r_body', published = 1, date_published = $publish_date, date_expires = $expiry_date, date_modified = NOW(), author = '$session_id', checked_out = 0 WHERE content_id = '$token'";
    } else {
      $sql = "UPDATE content SET content_category_id = '$r_select_category', content_teaser = '$r_teaser', content_title = '$r_title', content = '$r_body', date_published = $publish_date, date_expires = $expiry_date, date_modified = NOW(), author = '$session_id', checked_out = 0 WHERE content_id = '$token'";
    }
    $result2 = mysql_query($sql);
    if($result2) {
        if ($action == "publish_content3") {
            $msg = $msg."Content (".$hdn_content_id.") has been updated and published.<br />";
        } else {
            $msg = $msg."Content (".$hdn_content_id.") has been updated.<br />";
        }
        /* next we need to remove the lock information form the locks table
        */
        $sql2 = "DELETE FROM locks WHERE content_id = '$token' AND user_id = '$session_id'";
        $result2 = mysql_query($sql2);
        if(!$result2)
         $msg .= "Error occured:<br />Unable to process query (".$sql2.").<br />";
    }
    // now deal with the meta data
    // if meta data submitted
    if ($_POST['o_meta_data'] != '') {
     // now we need to check quickly whether there was any metadata captured previously
     // this will help determine whether to run an update or an insert
     $sql = "select meta_data from meta_data where cat_id = '".$_POST['hdn_content_id']."';";
     $result = mysql_query($sql);
     if($result) {
      $_POST['o_meta_data'] = str_replace(",", "", $_POST['o_meta_data']);
      //echo($_POST['o_meta_data']);
      $total = mysql_numrows($result);
      if ($total == 0) {
       // insert statement
       $sql = "INSERT INTO meta_data (cat_id, meta_data) VALUES ('".$_POST['hdn_content_id']."', '".$_POST['o_meta_data']."');";
      } else {
       // update
       $sql = "UPDATE meta_data  SET meta_data = '".$_POST['o_meta_data']."' WHERE cat_id = '".$_POST['hdn_content_id']."';";
      }
      
      $result = mysql_query($sql);
      if($result) {
       $msg .= "Meta data stored successfully.<br />";
      } else {
       $msg .= "Query failed:<br />".$sql."<br />";
      }
     } else {
      $msg .= "Query failed:<br />".$sql."<br />";
     }
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
//$msg = $msg."<p><a href=\"Preview content\" class=\"normb\">Coming soon</a></p>";
if ($HTTP_POST_VARS["r_new_resource"] AND $HTTP_POST_VARS["r_new_resource"] == 1 AND $HTTP_POST_VARS["o_how_many"] <> 0) {
//include file to generate options for file types
    include("global/sql/_get_types.php");
}
?>