<?php
if ($HTTP_POST_VARS["r_title"]) { // check to see if content submitted
    $conn = db_connect();
    if($conn) {
         $token = md5(uniqid(rand(),1)); // unique ID
         $r_select_category = addslashes($r_select_category);
         $r_teaser = addslashes($r_teaser);
         $r_title = addslashes($r_title);
         $r_body = addslashes($r_body);
         
         // create publication date based on drop down selections
         $publish_date = date("YmdHis",mktime(0,0,0,$o_publish_month[0], $o_publish_day[0], $o_publish_year[0]));
         $expiry_date = date("YmdHis",mktime(0,0,0,$o_expiry_month[0], $o_expiry_day[0], $o_expiry_year[0]));
         
         $sql = "INSERT INTO content (content_id, content_category_id, content_teaser, content_title, content, content_type, published, date_written, date_published, date_expires, date_modified, author, checked_out) VALUES ('$token', '$r_select_category', '$r_teaser', '$r_title', '$r_body', 'bb4f74b892a4854e3f0bcf262acf1e09', 0, NOW(), $publish_date, $expiry_date, NOW(), '$session_id', 0)";
         
         $result = mysql_query($sql);
         if ($result) { // if insert has worked process selected resources and related items
              $msg = "<span class=\"alert\">Content added successfully.</span>";
              // now add the new resources
              if (isset($HTTP_POST_VARS["o_select_resource"])) {
                  for ($i = 0; $i < count($HTTP_POST_VARS["o_select_resource"]); $i++) {
                       $result5 = mysql_query("SELECT resource_type FROM resources WHERE resource_id = '$o_select_resource[$i]'");
                       if ($result5) {
                        $total5 = mysql_num_rows($result5);
                        if ($total5 == 1) {
                            while ($r5 = mysql_fetch_array($result5)) {
                               $result1a = mysql_query("SELECT type FROM type WHERE type_id = '$r5[0]'"); // get their type for the insert
                               if ($result1a) {
                                    while ($r1a = mysql_fetch_array($result1a)) {
                                         $type = $r1a[0];
                                    }
                               } else {
                                    $type = 'unknown';
                               }
                            }
                        } else {
                            echo("db error");
                            exit;
                        }
                       }
                       
                       $$result1 = mysql_query("INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('$o_select_resource[$i]', '$token', '$type')");
                       if ($result1) { // if insert successful...
                            $msg = $msg."<br /><span class=\"alert\">Resource ".$o_select_resource[$i]." has been added.</span>";
                       }
                  }
              }
              // same again for related content
              if (isset($HTTP_POST_VARS["o_select_related_content"])) {
                  for ($i = 0; $i < count($HTTP_POST_VARS["o_select_related_content"]); $i++) {
                       $result1 = mysql_query("INSERT INTO related_resources_to_content (resource_id, content_id, type) VALUES ('$o_select_related_content[$i]', '$token', 'bb4f74b892a4854e3f0bcf262acf1e09')");
                       if ($result1) {
                            $msg = $msg."<br /><span class=\"alert\">Resource ".$o_select_related_content[$i]." has been added.</span>";
                       }
                  }
              }
              $msg = $msg."<p></p>";
              //$msg = $msg."<p><a href=\"Preview content\" class=\"normb\">Coming soon</a></p>";
              if ($HTTP_POST_VARS["r_new_resource"] AND $HTTP_POST_VARS["r_new_resource"] == 1 AND $HTTP_POST_VARS["o_how_many"] <> 0) {
                    //include file to generate options for file types
                    include("global/sql/_get_types.php");
               }
               // now insert meta data if present
               if ($_POST['o_meta_data'] != '') {
                $_POST['o_meta_data'] = str_replace(",", "", $_POST['o_meta_data']);
								// next store the meta data info
                $sql = "INSERT INTO meta_data (cat_id, meta_data) VALUES ('".$token."', '".$_POST['o_meta_data']."');";
                $result = mysql_query($sql);
                if($result) {
                 $msg .= "Meta data successfully captured.<br />";
                } else {
                 $msg .= "Query failed:<br />".$sql."<br />";
                }
               }
         } else {
            $msg = $msg."SQL failed: $sql";
         }
    } else {
        $msg = $msg."Database connection error has occured";
    }
} else {
    $msg = $msg."Sorry no form content has been submitted";
}
?>