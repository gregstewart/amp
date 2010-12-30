<?php 
$conn = db_connect();
// these two coounters are used for displaying purposes on updates and deletes
// used to adjust the number of elFields in the form if selected resources are displayed
$a_counter = 0;
$r_counter = 0;
if ($conn) {
    if (isset($HTTP_POST_VARS["r_content"])) {
        // in the first instance if update or delete get actual content
        $result3 = mysql_query("SELECT content_category_id, content_teaser, content_title, content FROM content WHERE content_id = '$r_content'");
        if ($result3) {
            while ($r3 = mysql_fetch_array($result3)) { // set variables for display of actual content
                $d_cat_id = htmlspecialchars(StripSlashes($r3[0]));
                $d_teaser = htmlspecialchars(StripSlashes($r3[1]));
                $d_title = htmlspecialchars(StripSlashes($r3[2]));
                $d_content = htmlspecialchars(StripSlashes($r3[3]));
            }
            // get the associated content
            $result5 = mysql_query("SELECT resource_id, type FROM related_resources_to_content WHERE content_id = '$r_content' ORDER BY type");
            if ($result5) { // we will be building a list of chekboxes to display. Select to have the content removed.
                $r5_total = mysql_num_rows($result5);
                $articles = "<tr valign=\"top\">
            		<td class=\"normb\" align=\"right\" width=\"80\">Pre-selected content</td>
            		<td><img src=\"".$http."images/s.gif\" width=\"20\" height=\"15\" alt=\"spacer\" border=\"0\" /></td>
            		<td class=\"norm\">";
                $resources = "<tr valign=\"top\">
            		<td class=\"normb\" align=\"right\" width=\"80\">Pre-selected resources</td>
            		<td><img src=\"".$http."images/s.gif\" width=\"20\" height=\"15\" alt=\"spacer\" border=\"0\" /></td>
            		<td class=\"norm\">";
                $counter = 1;
                if ($r5_total <> 0) {
                    while ($r5 = mysql_fetch_array($result5)) {
                        if ($r5[1] == "article") {
                            $result6 = mysql_query("SELECT content_title FROM content WHERE content_id = '$r5[0]'");
                            if ($result6) {
                                while ($r6 = mysql_fetch_array($result6)) {
                                    $a_counter++;
                                    $str = StripSlashes($r6[0]);
                                    $articles = $articles.$str." <input type=\"Checkbox\" name=\"o_existing".$counter."\" id=\"o_existing".$counter."\" value=\"".$r5[0]."\"><br />";
                                }
                            }
                        } else {
                            $result7 = mysql_query("SELECT display_name, resource_type FROM resources WHERE resource_id = '$r5[0]' GROUP BY resource_type");
                            if ($result7) {
                                while ($r7 = mysql_fetch_array($result7)) {
                                    $r_counter++;
                                    $resources = $resources.$r7[0]."<input type=\"Checkbox\" name=\"o_existing".$counter."\" id=\"o_existing".$counter."\" value=\"".$r5[0]."\"><br />";
                                    //echo($counter.$r7[0].$r5[1].$r5[0].$r_counter);
                                }
                            }
                        }
                        $counter++;
                    }
                    $articles = $articles."</td>
                        <td><img src=\"images/s.gif\" width=\"20\" height=\"15\" alt=\"spacer\" border=\"0\" /></td>
<td class=\"norm\">Here is a list of already associated articles. To remove please tick the check box</td>
               </tr>
               <tr>
                    <td colspan=\"5\"><hr /></td>
               </tr>";
                    $resources = $resources."</td>
                        <td><img src=\"images/s.gif\" width=\"20\" height=\"15\" alt=\"spacer\" border=\"0\" /></td>
<td class=\"norm\">Here is a list of already associated resources. To remove please tick the check box</td>
               </tr>
               <tr>
                    <td colspan=\"5\"><hr /></td>
               </tr>";
                 }
            }
            // end associated content
        } else {
            $msg = $msg."Query returned no result: SELECT content_category_id, content_teaser, content_title, content FROM content WHERE content_id = '".$r_content."'";
        }
    }
    // next build up drop down menu for categories available
    $result = mysql_query("SELECT category_id, name, related_to FROM categorisation");
    $options = "";
    while ($r = mysql_fetch_array($result)) {
         $d_id = stripslashes($r[0]);
         $d_name = stripslashes($r[1]);
         $d_related = "";
         $result3a = mysql_query("SELECT name FROM categorisation WHERE category_id = '$r[2]'");
          while ($r3a = mysql_fetch_array($result3a)) {
               $d_related = $r3a[0];
          }
         $options = $options."<option value=\"".trim($d_id)."\"";
              if ($action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") {
                  if ($d_cat_id) {
                    if ($d_cat_id = trim(stripslashes($r[0]))) {
                        $options = $options." selected=\"selected\"";
                    }
                  }
              }
              $options = $options.">".$d_related." &gt;&gt; ".trim($d_name)."</option>
              ";
         
    }
    // next build list of articles to relate the new content to
    $result2 = mysql_query("SELECT content_id, content_title FROM content");
    $r2_total = mysql_num_rows($result2);
    $options2 = "";
    if ($r2_total <> 0) {
         while ($r2 = mysql_fetch_array($result2)) {
              $options2 = $options2."<option value=\"".trim(stripslashes($r2[0]))."\"> &gt;&gt; ".trim(stripslashes($r2[1]))."</option>
              ";
              /* alternative
              $options2 = $options2."<option value=\"".trim(stripslashes($r2[0]))."\"";
              if ($action == "update_content2" || $action == "delete_content") {
                  if ($result5) {
                        $r5_total = mysql_num_rows($result5);
                        if ($r5_total <> 0) {
                            while ($r5 = mysql_fetch_array($result5)) {
                                if ($r5[1] == "article") {
                                    echo($r5[0]."<br />");
                                    if (trim(stripslashes($r5[0])) == trim(stripslashes($r2[0]))) {
                                        $options2 = $options2." selected=\"selected\"";
                                    }
                                }
                            }
                         }
                  }
              }
              $options2 = $options2."> &gt;&gt; ".trim(stripslashes($r2[1]))."</option>
              ";
              */
         }
    } else {
         $options2 = $options2."<option value=\"0\"> &gt;&gt; No resources found</option>";
    }
    // next build list of resources to relate the new content to
    $result4 = mysql_query("SELECT resource_id, display_name, resource_type FROM resources");
    $r4_total = mysql_num_rows($result4);
    $options4 = "";
    if ($r4_total <> 0) {
         while ($r4 = mysql_fetch_array($result4)) {
                $result7 = mysql_query("SELECT type FROM type WHERE type_id = '$r4[2]' GROUP BY type");
                if ($result7) {
                    $total7 = mysql_num_rows($result7);
                    if ($total7 == 1) {
                        while ($r7 = mysql_fetch_array($result7)) {
                            $d_type = $r7[0];
                        }
                    } else {
                        $d_type = "uknown";
                        $msg = $r4[2]." A database error has occured while selecting the type display name";
                    }
                }
                $options4 = $options4."<option value=\"".trim(stripslashes($r4[0]))."\">".$d_type." &gt;&gt; ".trim(stripslashes($r4[1]))."</option>";
         }
    } else {
         $options4 = $options4."<option value=\"0\"> &gt;&gt; No resources found</option>";
    }
} else {
    echo("A database error has occured");
}
?>