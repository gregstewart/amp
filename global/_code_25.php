<?php
 if ($HTTP_POST_VARS["r_display_name"] && $HTTP_POST_VARS["r_display_name"] != "") {
  //$msg .="OK process.<br />";
  
  $conn = db_connect();
  if (!$conn)
   $msg .="Database connection failed.<br />";
  
  $token = md5(uniqid(rand(),1));
  if ($action == "add type_resources2") {
   $sql="INSERT INTO type (type_id, type, extension) VALUES ('$token', '$r_display_name', '$o_extension')";
   $display_action = "added";
  } else if ($action == "update type_resources3") {
   $sql="UPDATE type SET type = '$r_display_name', extension = '$o_extension' WHERE type_id = '$hdn_type_id'";
   $display_action = "updated";
  } else if ($action == "delete type_resources3") {
   $sql="DELETE FROM type  WHERE type_id = '$hdn_type_id'";
   $display_action = "deleted";
  }
  $result = mysql_query($sql);
  if (!$result) {
   $msg .="Query failed: ".$sql.".<br />No type ".$display_action.".<br />";
  } else {
   $msg .="Type ".$display_action." successfully: ".$r_display_name." (id = ".$token.").<br />";
  }
 } else {
  $msg .= "Sorry you have submitted a blank form, please hit back and complete all the relevant fields.<br />";
 }
?>
