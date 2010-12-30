<?php 
$msg = "";
$conn = db_connect();
if($conn) {
    $result = mysql_query("SELECT type, extension FROM type WHERE type_id = '$r_type'");
    if ($result) {
        while ($r = mysql_fetch_array($result)) {
            $d_display_name = $r[0];
            $d_extension = $r[1];
        }
    } else {
        $msg = $msg."<br />Database error occured could not retrieve the different resources";
    }
} else {
    $msg = $msg."A connection to the database could not be established";
}
?>