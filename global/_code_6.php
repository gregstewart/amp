<?php 
// if the form submitted requested a restriction in the display redirect back to selection and re-run the query
if ($action == "update_content2") {
	$action2 = "update_content";
} else if ($action == "publish_content2") {
	$action2 = "publish_content";
}
//(isset($_POST['o_restrict']) && ($_POST['o_restrict'] == 1 || $_POST['o_restrict'] == 0))

if ((isset($_POST['o_restrict']) && ($_POST['o_restrict'] == 1 || $_POST['o_restrict'] == 0)) && $_POST['r_content'] == "") {
	$re_direct = "home.php?action=".$action2."&cat_id=".$cat_id."&o_restrict=".$o_restrict."";
	header("location: home.php?action=".$action2."&cat_id=".$cat_id."&o_restrict=".$o_restrict."");
	echo($_POST['o_restrict']." & ".$_POST['r_content']);
}

$conn = db_connect();
// these two coounters are used for displaying purposes on updates and deletes
// used to adjust the number of elFields in the form if selected resources are displayed
$a_counter = 0;
$r_counter = 0;
$msg = "";
if ($conn) {
    if (isset($HTTP_POST_VARS["r_content"]) && $_POST["r_content"] != "") {
				// in the first instance if update or delete get actual content
        $result3 = mysql_query("SELECT content_category_id, content_teaser, content_title, content, date_published, date_expires, checked_out FROM content WHERE content_id = '$r_content'");
        if ($result3) {
            while ($r3 = mysql_fetch_array($result3)) { // set variables for display of actual content
                $d_cat_id = htmlspecialchars(StripSlashes($r3[0]));
                $d_teaser = htmlspecialchars(StripSlashes($r3[1]));
                $d_title = htmlspecialchars(StripSlashes($r3[2]));
                $d_content = htmlspecialchars(StripSlashes($r3[3]));
                $d_published = $r3[4];
                $d_expires = $r3[5];
                
                /* now deal with locking
                 variable $d_is_locked is used to disable form submission in case of locked file
                */
                if ($r3[6] == 1) {
                 /* if the file is locked the user should not be able to submit the content just review it
                  however make sure that it wasn't locked by the current user. If it was then allow editing
                 */
                 
                 //Unlock it by default
                 $d_is_locked = 0;
                 
                 $sql7 = "SELECT lock_id FROM locks WHERE content_id = '$r_content' AND user_id = '$session_id'";
                 $result7 = mysql_query($sql7);
                 if (!$result7)
                  $msg .= "Error occured:<br />Query failed ".$sql7."<br />";
                 
                 $total7 = mysql_numrows($result7);
                 if ($total7 != 1) { 
                  /* The result set is not 1, i.e. it's not the current user or more than one user 
                   has unlocked the file (very bad), so lock the file for editing
                  */
                  $msg .= "Content is locked by another user. You may only review the content but not make any changes.<br />";
                  $d_is_locked = 1;
                 }
                } else {
                 /* the file isn't locked so lock it so that no one else can modify it.
                  First update the field in the content table then store all the related 
                  info in the locks table.
                 */
                 $d_is_locked = $r3[6];
                 
                 $sql7 = "UPDATE content SET checked_out = 1 WHERE content_id = '$r_content'";
                 $result7 = mysql_query($sql7);
                 if (!$result7)
                  $msg .= "Error occured:<br />Unable to lock file. Processing aborted, please use the back button in your browser to try again.<br />";
                  //exit;
                 
                 $lock_id = md5(uniqid(rand(),1));
                 $sql8 = "INSERT INTO locks (lock_id, content_id, user_id, date_locked) VALUES ('$lock_id','$r_content','$session_id', NOW())";
                 $result8 = mysql_query($sql8);
                 if(!$result8)
                  $msg .= "Error occured:<br />Unable to update lock table, query failed (".$sql8.").<br />";
                  //exit;
                  
                 $msg .= "Content is now locked exclusively to you.<br />";
                }
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
                        if ($r5[1] == "bb4f74b892a4854e3f0bcf262acf1e09") {
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
               <tr><td colspan=\"5\"><hr /></td></tr>";
                    $resources = $resources."</td>
                        <td><img src=\"images/s.gif\" width=\"20\" height=\"15\" alt=\"spacer\" border=\"0\" /></td>
<td class=\"norm\">Here is a list of already associated resources. To remove please tick the check box</td>
               </tr>
               <tr><td colspan=\"5\"><hr /></td></tr>";
                 }
            }
            // end associated content
            // get associated meta data
            $sql2 = "select meta_data from meta_data where cat_id = '".$r_content."';";
            $result2 = mysql_query($sql2);
            if($result2) {
             while ($r2 = mysql_fetch_array($result2)) {
              $d_cat_meta = $r2[0];
             }
            } else {
             $msg .= "Query failed:<br />".$sql2."<br />";
            }
        } else {
            $msg = $msg."Query returned no result: SELECT content_category_id, content_teaser, content_title, content FROM content WHERE content_id = '".$r_content."'";
        }
    } else if (isset($r_content) && $r_content == "") { // if the form has value (removed valiudation for view restriction)
			header("location: home.php?action=".$action2."&cat_id=".$cat_id."&err=1");
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
                    if ($d_cat_id == trim(stripslashes($r[0]))) {
                        $options = $options." selected=\"selected\"";
                    }
                  }
              }
              $options = $options.">".$d_related." &gt;&gt; ".trim($d_name)."</option>
              ";
         
    }
    // next build list of articles to relate the new content to
    $result2 = mysql_query("SELECT content_id, content_title FROM content ORDER BY content_title");
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
    $result4 = mysql_query("SELECT resource_id, display_name, resource_type FROM resources ORDER BY resource_type, display_name");
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
    
    /* date drop down builder variables required 
     $s = start point
     $e = end point
     $c = checked (i.e. during update/delete this field will need to be selected)
    */
    function buildDropDown ($s, $e, $c) {
     global $options_dropdown;
     $options_dropdown = "";
     for ($i = $s; $i < $e; $i++) {
      $options_dropdown .= "<option value=\"".$i."\"";
      if (($c != 0) && ($i == $c)) {
       $options_dropdown .= " selected=\"selected\"";
      }
      $options_dropdown .= ">".$i."</option>";
     }
     return $options_dropdown;
    }

    // publish date
    // build up a date (day) drop down
    if(isset($d_published)) {
     $c_month = date("n",strtotime($d_published));
     $c_day = date("j",strtotime($d_published));
     $c_year = date("Y",strtotime($d_published));
     //echo($d_published." ".$c_day." ".$c_month." ".$c_year);
    } else {
     $c_day = 0;
     $c_month = 0;
     $c_year = 0;
    }
    buildDropDown(1,32,$c_day);
    $options_day = $options_dropdown;
    // build up a date (month) drop down
    buildDropDown(1,13,$c_month);
    $options_month = $options_dropdown;
    // build up a date (year) drop down
    buildDropDown(2000,2030,$c_year);
    $options_year = $options_dropdown;
    
    // expiry date
    // build up a date (day) drop down
    if(isset($d_expires)) {
     $c_month = date("n",strtotime($d_expires));
     $c_day = date("j",strtotime($d_expires));
     $c_year = date("Y",strtotime($d_expires));
     //echo($d_published." ".$c_day." ".$c_month." ".$c_year);
    } else {
     $c_day = 0;
     $c_month = 0;
     $c_year = 0;
    }
    buildDropDown(1,32,$c_day);
    $options_e_day = $options_dropdown;
    // build up a date (month) drop down
    buildDropDown(1,13,$c_month);
    $options_e_month = $options_dropdown;
    // build up a date (year) drop down
    buildDropDown(2000,2030,$c_year);
    $options_e_year = $options_dropdown;
    
} else {
    echo("A database error has occured");
}
?>