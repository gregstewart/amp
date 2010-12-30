<?php
if ($HTTP_POST_VARS["r_name"]) {
    if (isset($hdn_group_id)) {
        $token = $hdn_group_id;
    }
    
    // if no resources allocated then this value will be null - bug fix
    if (!isset($hdn_counter)) {
        $hdn_counter = 1;
    }
    
    $hdn_counter = $hdn_counter-1;
    $msg = "";
    $conn = db_connect();
    if ($action == "add_groups2") {
        if ($conn) {
            $token = md5(uniqid(rand(),1)); // unique ID
            $result = mysql_query("INSERT INTO groups (group_id, display_name) VALUES ('$token', '$r_name')");
            if($result) {
                $msg = $msg."Group ($r_name) added to system.<br />";
            }
            // now add the groups rights to the user_resource_Access table for later retrieval
            for ($i = 0; $i < count($HTTP_POST_VARS["r_category_id"]); $i++) {
                $result2=mysql_query("INSERT INTO user_resource_access (user_id, category_id) VALUES ('$token', '$r_category_id[$i]')");
                if($result2) {
                    $msg = $msg."Category access associated  for $r_category_id[$i] with $r_name ($token).<br />";
                }
            }
        } else {
            $msg = $mag."Could not connect to database<br />";
        }
    } else if ($action == "update_groups3") {
        if ($conn) {
            $result = mysql_query("UPDATE groups SET display_name = '$r_name' WHERE group_id = '$hdn_group_id'");
            if ($result) {
                $msg = $msg."Group ".$r_name." (".$hdn_group_id.") has been updated.<br />";
                // now deal with the associations... 10/6/2002
                if (isset($HTTP_POST_VARS)) {
                    // now delete the existing ones
                    for ($i = 1; $i <= $hdn_counter; $i++) { // because dynamic length form
                        // not completely flexible as you need to know how many form elements have been submitted but...
                        $string = 'o_existing'.$i; // set a string to be evaluated (firtst form field name minus number plus $i
                        
                        if(isset($HTTP_POST_VARS[$string])) {
                            //echo($HTTP_POST_VARS[$string]."<br />");
                            
                            // now we have a condidate for deletion
                            if ($conn) {
                                $result = mysql_query("DELETE FROM user_resource_access WHERE category_id = '$HTTP_POST_VARS[$string]' AND user_id = '$token'");
                                //$result = 1;
                                //echo($HTTP_POST_VARS[$string]." and ".$token." are the criteria to delete.<br />");
                                if ($result) {
                                    $msg = $msg."<br />Previously selected category (".$HTTP_POST_VARS[$string].") has been removed from the access list.<br />";
                                } else {
                                    $msg = $msg."database error for: DELETE FROM user_resource_access WHERE category_id = '".$HTTP_POST_VARS[$string]."' AND user_id = '$token'";
                                }
                            }
                        }
                    }
                    
                    // do the updates
                    if(isset($HTTP_POST_VARS["o_category_id"])) {
                        if ($conn) {
                            $fields_submitted = count($HTTP_POST_VARS["o_category_id"]);
                            for ($i = 0; $i < $fields_submitted; $i++) {
                                $result3 = mysql_query("SELECT category_id FROM user_resource_access WHERE user_id = '$token'");
                                //echo("<p>".$o_category_id[$i]."<br />");
                                $insert = 1;
                                if ($result3) {
                                    $total3 = mysql_num_rows($result3);
                                    //echo("Total of query = ".$total3."<br />");
                                    if ($total3 != 0) {
                                        //echo("here now<br />");
                                        while ($r3 = mysql_fetch_array($result3)) {
                                            //echo($fields_submitted." is the number of firlds submitted. -- ".$i." is the current array item -- db item ".$r3[0]." = ".$o_category_id[$i]." field item<br />");
                                            if ($r3[0] == $o_category_id[$i]) {
                                                $insert = 0;
                                                //echo("do not insert above<br />");
                                                break;
                                            }
                                        }
                                    } else {
                                        $msg = $msg."The query failes and did not reuturn a result: SELECT category_id FROM user_resource_access WHERE user_id = '$token'.<br />";
                                    }
                                } else {
                                    echo("no records found for= SELECT category_id FROM user_resource_access WHERE user_id = '$token'");
                                }
                        
                                if ($insert == 1) {
                                    $result1 = mysql_query("INSERT INTO user_resource_access (user_id, category_id) VALUES ('$token', '$o_category_id[$i]')");
                                    //echo($o_category_id[$i]. " = Would have been inserted <br />");
                                    if ($result1) {
                                        $msg = $msg."<br />Category access ".$o_category_id[$i]." has been added.";
                                    }
                                } else {
                                    $msg = $msg."<br />Category access ".$o_category_id[$i]." has been rejected";
                                }
                                //echo("$i</p>");
                            }
                        }
                    }
                }
            } else {
                $msg = $msg."Query error: UPDATE groups SET display_name = '$r_name' WHERE group_id = 'hdn_group_id'";
            }
        } else {
            $msg = $msg."No database connection.<br />";
        }
    } else if ($action == "delete_groups3") {
        if ($conn) {
            $sql = "DELETE FROM groups WHERE group_id = '$token'";
            $result = mysql_query($sql);
            if ($result) {
                $msg = $msg."Group details deleted.<br />";
                // ok group details deleted now delete the categories it had access to
                $sql2 = "DELETE FROM user_resource_access WHERE user_id = '$token'";
                $result2 = mysql_query($sql2);
                if ($result2) {
                    $msg = $msg."Resources this group had access to, have been deleted.<br />";
                } else {
                    $msg = $msg."Query failed: ".$sql2."<br />";
                }
            } else {
                $msg = $msg."Query failed: ".$sql."";
            }
        } else {
            $msg = $msg."Database connection failed.";
        }
    }
}
?>