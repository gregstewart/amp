<?php 
$msg = "";
$conn = db_connect();
if($conn) {
    $result = mysql_query("SELECT resource_id, display_name FROM resources");
    if ($result) {
        $options = "";
        $total = mysql_numrows($result);
        if ($total == 0)
         $options = $options."<option value=\"\"> &gt;&gt; No content found</option>";
        
        while ($r = mysql_fetch_array($result)) {
            $options = $options."
            <option value=\"".$r[0]."\">".stripslashes($r[1])."</option>";
        }
    } else {
        $msg = $msg."<br />Database error occured could not retrieve the different resources";
    }
} else {
    $msg = $msg."A connection to the database could not be established";
}
?>