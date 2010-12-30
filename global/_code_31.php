<?php 
if(isset($content_id)) {
  
  // connect to the database
  $conn = db_connect();
  if(!$conn)
   $msg .= "Database connection failed.<br />";
  
} else {
	header("Location: ".$http."home.php");
}

?>