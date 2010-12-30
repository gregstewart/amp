<?php 
$conn = db_connect(); // try to connect to database
$options = "";

// restrict display if group memebership is custom or author
if ($session_group == '7663a48b49b225e412e80b9578a71f91' || $session_group == 'c900803eec72442b4705903331fbf3e2') {
 $see_all = 0;
} else {
 $see_all = 1;
}
if ($conn) {
    // figure out the depth of the menu first
    
    if (isset($see_all) && $see_all == 1) {
     	$sql = "SELECT content_id, content_title, published, checked_out FROM content";
    	if (isset($o_restrict) && $o_restrict == 1) { 
				$sql .= " WHERE published = 1";
			} else if (isset($o_restrict) && $o_restrict == 0) {
				$sql .= " WHERE published = 0";
			}
		} else {
     	$sql = "SELECT content_id, content_title, published, checked_out FROM content WHERE author = '$session_id'";
		 	if (isset($o_restrict) && $o_restrict == 1) { 
				$sql .= " AND published = 1";
			} else if (isset($o_restrict) && $o_restrict == 0) {
				$sql .= " AND published = 0";
			}
    }
		$sql .= " ORDER BY content_title";
		
    $result = mysql_query($sql);
    if ($result) {
        $total = mysql_numrows($result);
        if ($total == 0)
         $options = $options."<option value=\"\"> &gt;&gt; No content found</option>";
        while ($r = mysql_fetch_array($result)) {
            $d_id = $r[0];
            $d_name = stripslashes($r[1]);
            //If the file is published
            if ($r[2] == '1') {
             $published = "(published)";
            } else {
             $published = "";
            }
						
						//If the file is locked display it
            if ($r[3] == '1') {
             $locked = "(file locked)";
            } else {
             $locked = "";
            }
            // build options for select box in form
            $options = $options."<option value=\"".trim($d_id)."\"> &gt;&gt; ".trim($d_name)." ".$published." ".$locked."</option>";
        }
    } else {
        $msg = "Query error:<br />".$sql."";
    }
} else {
    $msg = "Database connection error";
}
?>