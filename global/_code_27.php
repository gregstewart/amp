<?php 
if (isset($r_content)) {
 $conn = db_connect(); // try to connect to database
 
 if (!$conn)
  $msg .= "Database connection failed.<br />";
 
 // firtsly get the current document
 $sql = "select content.content_teaser, content.content_title, content.content, content.published from content where content.content_id = '".$r_content."'";
 $result = mysql_query($sql);
 if(!$result)
  $msg .= "Query failed:<br />".$sql.".<br />";
 
 $total = mysql_numrows($result);
 if ($total == 0)
  $msg .= "Query returned 0 records: ".$sql.".<br />";
 
 if ($total > 1)
  $msg .= "Query returned more than 1 record: ".$sql.".<br />";
 
 while ($r = mysql_fetch_array($result)) {
  $curr_title = "<strong>Title:</strong> ".stripslashes($r[1]);
  $curr_teaser = "<strong>Teaser:</strong> ".stripslashes($r[0]);
  $curr_body = "<strong>Body:</strong> ".stripslashes($r[2]);
  if ($r[3]==1) {
   $curr_pub_status = "<strong>Published:</strong> yes";
  } else {
   $curr_pub_status = "<strong>Published:</strong> no";
  }
  
  // now get the source control content
  $sql1 = "select content_archive.archive_id, content_archive.content_teaser, content_archive.content_title, content_archive.content, content_archive.published, content_archive.date_modified from content_archive where content_archive.content_id = '".$r_content."' order by content_archive.date_modified desc";
  $result1 = mysql_query($sql1);
  if(!$result1)
   $msg .= "Query failed:<br />".$sql1.".<br />";
   
  $total1 = mysql_numrows($result1);
  if ($total1 == 0)
   //$msg .= "Query returned 0 records: ".$sql1.".<br />";
   $archived_content .= "<hr /><strong>Sorry</strong><br />This item of content has no history associated with it. Possibly it has never been udpated.<br />";
  
  $curr_ver = $r[3].".".($total1+1);
  
  while($r1=mysql_fetch_array($result1)) {
   $archived_content .= "<div id=\"version_".$counter."\">
    <hr />
    <div><strong>Version:</strong> ".$r[3].".".$total1."</div>
    <div><strong>Title:</strong> ".stripslashes($r1[2])."</div>
    <div><strong>Teaser:</strong> ".stripslashes($r1[1])."</div>
    <div><strong>Body:</strong> ".stripslashes($r1[3])."</div>
    <div><img src=\"images/s.gif\" width=\"1\" height=\"5\" alt=\"spacer\" border=\"0\" /><br /><a href=\"".$http."home.php?action=rollback_content3&amp;cat_id=".$cat_id."&amp;arch_id=".$r1[0]."&amp;cont_id=".$r_content."\" class=\"norm\">&lt;&lt; rollback</a></div>
   </div>";
   
   $total1--;
  }
 }
}
?>