<?php 
$conn = db_connect(); // try to connect to database
$options = "";

if ($conn) {
    
    $sql = "SELECT category_id, name from categorisation where level = 0";
    
    $result = mysql_query($sql);
    if ($result) {
        $total = mysql_numrows($result);
        if ($total == 0)
         $options = $options."<option value=\"\"> &gt;&gt; No content found</option>";
        while ($r = mysql_fetch_array($result)) {
            $d_id = $r[0];
            $d_name = stripslashes($r[1]);
            //If the file is locked display it
            if ($r[2] == '1') {
             $locked = "(file locked)";
            } else {
             $locked = "";
            }
            // build options for select box in form
            $options = $options."<option value=\"".trim($d_id)."\"> &gt;&gt; ".trim($d_name)." ".$locked."</option>";
        }
    } else {
        $msg = "Query error:<br />".$sql."";
    }
} else {
    $msg = "Database connection error";
}
?>