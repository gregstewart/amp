<?php 
$msg = "";
if(isset($content_id)) {
  
  // connect to the database
  $conn = db_connect();
  if($conn) {
		// first just make sure that the user editing the content is the user who created it
		$sql = "SELECT author FROM content WHERE content_id = '".$content_id."';";
		$result = mysql_query($sql);
		
		if ($result) {
			$total = mysql_numrows($result);
			if($total == 1) {
				// proper result set
				while ($r = mysql_fetch_array($result)) {
					if ($r[0] == $session_id) {
						// it's the right user update the locked field and return to home
						$sql = "UPDATE content SET checked_out = 0 WHERE content_id = '".$content_id."';";
						$result = mysql_query($sql);
						if ($result) {
							//query updated re-direct
							header("Location: ".$http."home.php");
						} else {
							$msg .= "<p>The following query failed:<br />".$sql."</p>";
						}
					} else {
						$msg .= "<p>Inccorect user attempting to access content and update.</p>";
					}
				}
			} else {
				$msg .= "<p>Query returned unexpcted result set(".$total."):<br />".$sql."</p>";
			}
		} else {
			$msg .= "<p>Access error, the query failed:<br />".$sql."</p>";
		}
	} else {
	 	$msg .= "Database connection failed.<br />";
	}
	if ($msg != "") {
			echo($msg);
	}
} else {
	echo("error");
	header("Location: ".$http."home.php");
}

?>