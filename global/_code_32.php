<?php 
$conn = db_connect(); // try to connect to database
$options = "";
//session_start();
//echo($session_group);

// restrict display if group memebership is custom or author
if ($session_group == '7663a48b49b225e412e80b9578a71f91' || $session_group == 'c900803eec72442b4705903331fbf3e2') {
 $see_all = 0;
} else {
 $see_all = 1;
}
if ($conn) {
    // figure out the depth of the menu first
    
    if (isset($see_all) && $see_all == 1) {
     $sql = "SELECT content_archive.content_id, content_archive.date_written, content_archive.date_published, content_archive.date_modified, content.content_title, content.checked_out FROM content, content_archive WHERE content_archive.content_id = content.content_id ORDER BY content_archive.date_published";
    } else {
     $sql = "SELECT content_archive.content_id, content_archive.date_written, content_archive.date_published, content_archive.date_modified, content.content_title, content.checked_out FROM content, content_archive WHERE content.author = '$session_id' AND content_archive.content_id = content.content_id ORDER BY content_archive.date_published DESC";
    }
    $result = mysql_query($sql);
    if ($result) {
        $total = mysql_numrows($result);
        if ($total == 0)
         $options = $options."<option value=\"\"> &gt;&gt; No content found</option>";
        $counter = 1;
				$processed = array(1);
				while ($r = mysql_fetch_array($result)) {
					if (!in_array($r[0], $processed)) {
						$processed[$counter] = $r[0];
						$d_id = $r[0];
            $d_name = stripslashes($r[4]);
            //If the file is locked display it
            if ($r[5] == '1') {
             $locked = "(file locked)";
            } else {
             $locked = "";
            }
            // build options for select box in form
            $options = $options."<option value=\"".trim($d_id)."\"> &gt;&gt; ".trim($d_name)." ".$locked."</option>";
					}
					$counter++;
					/*$depth = count($processed);
					for ($i=1; $i < $depth; $i++) {
						echo("Array key ".$i." has a value of ".$processed[$i]."<br />");
					}
					$d_id = $r[0];
					echo($r[4]." ".$r[0]." ".$r[3]."<br />");
					$d_name = stripslashes($r[1]);
					//If the file is locked display it
					if ($r[2] == '1') {
					 $locked = "(file locked)";
					} else {
					 $locked = "";
					}
					// build options for select box in form
					$options = $options."<option value=\"".trim($d_id)."\"> &gt;&gt; ".trim($d_name)." ".$locked."</option>";*/
        }
    } else {
        $msg = "Query error:<br />".$sql."";
    }
} else {
    $msg = "Database connection error";
}
?>