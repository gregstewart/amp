<?php 
// ok delete time based on $hdn_content_id
// first the content
$conn = db_connect();
if ($conn) {
    $result = mysql_query("DELETE FROM content WHERE content_id = '$hdn_content_id'");
    if ($result) {
        $msg = "Content:".$hdn_content_id." has been deleted from the database.<br />";
        $result1 = mysql_query("DELETE FROM related_resources_to_content WHERE content_id = '$hdn_content_id'");
        if ($result1) {
            $msg = $msg." Related resrources for content (".$hdn_content_id.") has been deleted.<br />";
        } else {
            $msg = $msg."Query failed: DELETE FROM related_resources_to_content WHERE content_id = = '".$hdn_content_id."'.<br />";
        }
        $sql = "delete from meta_data where cat_id = '".$hdn_content_id."';";
        $result = mysql_query($sql);
        if ($result) {
         $msg .= "Meta data has been removed.<br />";
        } else {
         $msg .= "Query failed:<br />".$sql."<br />";
        }
    } else {
        $msg = "Query failed: DELETE FROM content WHERE content_id = '".$hdn_content_id."'.<br />";
    }
}
?>