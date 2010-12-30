<?php
$msg = "";
$conn = db_connect();
if ($conn) {
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
                //echo($d_name2." ".$d_id." SELECT name FROM categorisation WHERE category_id = '".$r[2]."'<br />");
                $result3 = mysql_query("SELECT name FROM categorisation WHERE category_id = '$r[2]'");
                 if ($result3) {
                     while ($r3 = mysql_fetch_array($result3)) {
                          $d_related = $r3[0];
                     }
                    // build options for select box in form
                    if ($action == "add_groups") {
                        $access_options = $access_options."<option value=\"".trim($d_id)."\">".$d_related." &gt;&gt; ".trim($d_name2)."</option>
                    ";
                    } else if ($action == "update_groups2" || $action == "delete_groups2") { // if update/delete then check the items that had been selected
                        $access_options = $access_options."<option value=\"".trim($d_id)."\">".$d_related." &gt;&gt; ".trim($d_name2)."</option>
                    ";
                    }
                } else {
                    $msg = $msg."Query failed or returned 0 records: SELECT name FROM categorisation WHERE category_id = '".$r[2]."'<br />";
                }
            }
            if ($action == "update_groups2" || $action == "delete_groups2") {
                // now that we now that there are categories and that we are updating/deleting
                // get the associated content
                $result5 = mysql_query("SELECT category_id FROM user_resource_access WHERE user_id = '$r_group'");
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
                $sql6 = "SELECT display_name FROM groups WHERE group_id = '$r_group'";
                $result6 = mysql_query($sql6);
                if ($result6) {
                    while ($r6 = mysql_fetch_array($result6)) {
                        $group_name = $r6[0];
                    }
                }
            }
        } else {
            $msg = $msg."No rows were returned by SELECT category_id, name, related_to FROM categorisation<br />";
        }
    }  else {
        $msg = $msg." Query failed: SELECT category_id, name, related_to FROM categorisation<br />";
    }
} else {
    $msg = $msg."Failed to connect to database<br />";
}
?>