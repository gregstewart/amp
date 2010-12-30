<?php 
$d_name = " ";
$msg = "";
if (isset($HTTP_POST_VARS["r_user"]) && $HTTP_POST_VARS["r_user"]) {
    $conn = db_connect();
    if($conn) {
        $result = mysql_query("SELECT user_id, username, password, name, firstname, email, group_membership, department FROM users WHERE user_id = '$r_user'");
        if ($result) {
            $total = mysql_num_rows($result);
            if ($total > 0) {
                while ($r = mysql_fetch_array($result)) {
                    $d_id = $r[0];
                    $d_firstname = $r[4];
                    $d_name = $r[3];
                    $d_email = $r[5];
                    $d_group_membership = $r[6];
                    $d_username = $r[1];
                    $d_password = $r[2];
                    $d_department = $r[7];
                }
                
                /* Used previously to display selected categories
                $result2 = mysql_query("SELECT category_id FROM user_resource_access WHERE user_id = '$d_id'");
                if ($result2) {
                    $total2 = mysql_num_rows($result2);
                    if ($total2 > 0) {
                        $i = 0;
                        while ($r2 = mysql_fetch_array($result2)) {
                            $d_cat_id[$i] = $r2[0];
                            $i++;
                        }
                    } else {
                        $msg = $msg."Query returned no results: SELECT category_id FROM user_resource_access WHERE user_id = '$d_id'<br />";
                    }
                } else {
                    $msg = $msg."Query failed: SELECT category_id FROM user_resource_access WHERE user_id = '$d_id'<br />";
                }*/
            } else {
                $msg = "Query returned 0 records";
            }
        } else {
            $msg = "Database connection failed";
        }
    }
} else {
    if (isset($HTTP_POST_VARS["r_user"]) && ($HTTP_POST_VARS["r_user"] != "" && $HTTP_POST_VARS["r_user"] != 0)) {
        $msg = "<span class=\"alert\">Sorry no user id has been passed. please click back or select update user from the menu.</span>";
    }
}

$conn = db_connect();
if ($conn) {
    $result = mysql_query("SELECT group_id, display_name FROM groups");
    if ($result) {
        $total_rows = mysql_num_rows($result);
        if ($total_rows > 0) {
            $group_options = "";
            while ($r = mysql_fetch_array($result)) {
                $group_options = $group_options."<option value=\"".$r[0]."\"";
                //echo($d_group_membership);
                if (isset($d_group_membership)) {
                    if ($d_group_membership == $r[0]) {
                        $group_options = $group_options." selected=\"selected\"";
                    }
                } else if (isset($session_fgroup)) {
                     if ($session_fgroup == $r[0]) {
                        $group_options = $group_options." selected=\"selected\"";
                    }
                }
                $group_options = $group_options.">".$r[1]."</option>
                ";
            }
            //echo($group_options." it's here");
        } else {
            $msg = $msg."No rows returned by SELECT group_id, display_name FROM groups<br />";
        }
    } else {
        $msg = $msg."Query failed: SELECT group_id, display_name FROM groups<br />";
    }
    // get the categories for access control (lifted straight from update_categories -- consider storing seperatly) - improved error checking
    $result = mysql_query("SELECT category_id, name, related_to FROM categorisation");
    $access_options = "";
    $a_counter = 0; // set these variable for the display of existing access rights
    
    if ($result) {
        $total_rows = mysql_num_rows($result);
        if ($total_rows > 0) {
            while ($r = mysql_fetch_array($result)) {
                $d_id = $r[0];
                $d_name2 = $r[1];
                $d_related = "";
                //echo($d_name." ".$d_id." SELECT name FROM categorisation WHERE category_id = '".$r[2]."'<br />");
                $result3 = mysql_query("SELECT name FROM categorisation WHERE category_id = '$r[2]'");
                 if ($result3) {
                     while ($r3 = mysql_fetch_array($result3)) {
                          $d_related = $r3[0];
                     }
                    // build options for select box in form
                    if ($action == "add_users") {
                        $access_options = $access_options."<option value=\"".trim($d_id)."\">".$d_related." &gt;&gt; ".trim($d_name2)."</option>
                    ";
                    } else if ($action == "update_users2" || $action == "delete_users2") { // if update/delete then check the items that had been selected
                        $access_options = $access_options."<option value=\"".trim($d_id)."\">".$d_related." &gt;&gt; ".trim($d_name2)."</option>
                    ";
                    }
                } else {
                    $msg = $msg."Query failed or returned 0 records: SELECT name FROM categorisation WHERE category_id = '".$r[2]."'<br />";
                }
            }
            if ($action == "update_users2" || $action == "delete_users2") {
                // now that we now that there are categories and that we are updating/deleting
                // get the associated content
                $result5 = mysql_query("SELECT category_id FROM user_resource_access WHERE user_id = '$r_user'");
                if ($result5) { // we will be building a list of chekboxes to display. Select to have the content removed.
                    $r5_total = mysql_num_rows($result5);
                    $access_list = "<tr valign=\"top\">
                		<td class=\"normb\" align=\"right\" width=\"80\">Pre-selected access list</td>
                		<td><img src=\"".$http."images/s.gif\" width=\"20\" height=\"15\" alt=\"spacer\" border=\"0\" /></td>
                		<td class=\"norm\">";
                    $counter = 1;
                    if ($r5_total <> 0) {
                        while ($r5 = mysql_fetch_array($result5)) {
                            $result7 = mysql_query("SELECT name, related_to FROM categorisation WHERE category_id = '$r5[0]'");
                            if ($result7) {
                                while ($r7 = mysql_fetch_array($result7)) {
                                    $result7a = mysql_query("SELECT name FROM categorisation WHERE category_id = '$r7[1]'");
                                     if ($result7a) {
                                         while ($r7a = mysql_fetch_array($result7a)) {
                                              $d_related = $r7a[0];
                                         }
                                     }
                                    $a_counter++;
                                    $access_list = $access_list.$d_related." &gt;&gt; ".$r7[0]."<input type=\"Checkbox\" name=\"o_existing".$counter."\" id=\"o_existing".$counter."\" value=\"".$r5[0]."\"><br />";
                                    //echo($counter.$r7[0].$r5[1].$r5[0].$r_counter);
                                }
                            }
                            $counter++;
                        }
                        $access_list = $access_list."</td>
                            <td><img src=\"images/s.gif\" width=\"20\" height=\"15\" alt=\"spacer\" border=\"0\" /></td>
		<td class=\"norm\">Here is a list of already associated categories the user has access to. To remove please tick the check box.</td>
                   </tr>
                   <tr>
                        <td colspan=\"5\"><hr /></td>
                   </tr>";
                     }
                }
                // end associated content
            }
        } else {
            $msg = $msg."No rows were returned by SELECT category_id, name, related_to FROM categorisation<br />";
        }
    } else {
        $msg = $msg." Query failed: SELECT category_id, name, related_to FROM categorisation<br />";
    }
} else {
    $msg = $msg."Failed to connect to database<br />";
}
?>