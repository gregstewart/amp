<?php 
$conn = db_connect(); // try to connect to database
$options = "";
if ($conn) {
    // figure out the depth of the menu first
    $result = mysql_query("SELECT category_id, name, related_to FROM categorisation");
    $total = mysql_numrows($result);
    if ($total == 0)
     $options = $options."<option value=\"\"> &gt;&gt; No content found</option>";
    while ($r = mysql_fetch_array($result)) {
        $d_id = $r[0];
        $d_name = $r[1];
        $d_related = "";
        //echo($d_name." ".$d_id." SELECT name FROM categorisation WHERE category_id = '".$r[2]."'<br />");
        $result3 = mysql_query("SELECT name FROM categorisation WHERE category_id = '$r[2]'");
             while ($r3 = mysql_fetch_array($result3)) {
                  $d_related = stripslashes($r3[0]);
             }
        // build options for select box in form
        $options = $options."<option value=\"".trim($d_id)."\">".$d_related." &gt;&gt; ".trim($d_name)."</option>";
    }
}
?>