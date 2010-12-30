<?php 
$msg = "";
$conn = db_connect();
if($conn) {
    $result = mysql_query("SELECT type_id, type, extension FROM type");
    if ($result) {
        $type_options = "";
        $total = mysql_numrows($result);
        if ($total == 0)
         $type_options = $type_options."<option value=\"\"> &gt;&gt; No content found</option>";
        
        while ($r = mysql_fetch_array($result)) {
            $type_options = $type_options."
            <option value=\"".$r[0]."\">".$r[1]." ";
            if($r[2]!="") {
             $type_options = $type_options."(.".$r[2].")";
            }
            $type_options = $type_options."</option>";
        }
    } else {
        $msg = $msg."<br />Database error occured could not retrieve the different file types";
    }
} else {
    $msg = $msg."A connection to the database could not be established";
}
?>