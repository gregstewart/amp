<?php 
 $conn = db_connect();
 //echo("<p>The selected site id ".$r_site."</p>");
 if(!$conn)
  $msg .= "Database connection failed.<br />";
 
 function checkSite($cat_id, $depth) {
   $sql0 = "select categorisation.category_id, categorisation.related_to, categorisation.level from categorisation where categorisation.category_id = '".$cat_id."'";
   $result0 = mysql_query($sql0);
   
   if(!$result0)
    $msg .= "Query failed:<br />".$sql0."<br />";
 
   $total0 = mysql_numrows($result0);
   if($total0 == 0) {
    //echo("No records found:<br />".$sql0."<br />");
    return;
   } else {
    while ($r0 = mysql_fetch_array($result0)) {
     if($r0[2] != 0) {
      checkSite($r0[1],$r0[2]);
     } else {
      global $cid;
      $cid = $r0[0];
      //echo($cid."<strong> site id</strong><br />");
      return $cid;
     }
    }
   }
   //echo($msg."<br />");
 }
 
 $sql = "select content.content_id, content.content_category_id, content.content_title, content.date_published, categorisation.level from content, categorisation where content.content_category_id = categorisation.category_id order by content.date_published desc";
 $result = mysql_query($sql);
 
 if(!$result)
  $msg .= "Query failed: ".$sql.".<br />";

 $total = mysql_numrows($result);
 if ($total == 0) {
  $msg .= "Query returned 0 results: ".$sql."<br />";
 } else {
  while($r = mysql_fetch_array($result)) {
   //$options .= "<option value=\"".$r[0]."\">".$r[2]."</option>";
   if ($r[4] != 0) {
    //echo($r[1]." <strong>cat</strong> <br />");
    checkSite($r[1], $r[4]);
    if (isset($cid) && $cid == $r_site) {
     $options .= "<option value=\"".$r[0]."\">".$r[2]."</option>";
    }
   } else {
    if ($r_site = $r[1]) {
     $options .= "<option value=\"".$r[0]."\">".$r[2]."</option>";
    }
   }
  }
 }
  
  // now get the homepage content
  $sql = "select homepage.content_id, homepage.pos, content.content_title from homepage, content where homepage.site_id = '".$_POST['r_site']."' and homepage.content_id = content.content_id order by homepage.pos asc";
 $result = mysql_query($sql);
 
 if(!$result)
  $msg .= "Query failed: ".$sql.".<br />";

 $total = mysql_numrows($result);
 if ($total == 0) {
  $msg .= "Query returned 0 results: ".$sql."<br />";
 } else {
  while($r = mysql_fetch_array($result)) {
   $home_options .= "<option value=\"".$r[0]."\">".$r[2]."</option>";
  }
 }
?>