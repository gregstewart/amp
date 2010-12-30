<?php 
$msg = "";
$conn = db_connect();
if($conn) {
    $result = mysql_query("SELECT display_name, value, resource_type, description FROM resources WHERE resource_id = '$r_resource'");
    if ($result) {
        while ($r = mysql_fetch_array($result)) {
            $d_name = stripslashes($r[0]);
            $d_value = stripslashes($r[1]);
            $d_resource_type = stripslashes($r[2]);
            $d_description = stripslashes($r[3]);
            $result2 = mysql_query("SELECT type_id, type, extension FROM type");
            if ($result2) {
                $type_options = "";
                while ($r2 = mysql_fetch_array($result2)) {
                    $type_options = $type_options."
                    <option value=\"".$r2[0]."\"";
                    if ($r2[0] == $d_resource_type) {
                        $type_options = $type_options." selected=\"selected\"";
                    }
                    $type_options = $type_options.">".$r2[1]." ";
                    if($r2[2]!="") {
                     $type_options = $type_options."(.".$r2[2].")";
                    }
                    $type_options = $type_options."</option>";
                }
            } else {
                $msg = $msg."<br />Database error occured could not retrieve the different file type";
            }
        }
    } else {
        $msg = $msg."<br />Database error occured could not retrieve the different resources";
    }
} else {
    $msg = $msg."A connection to the database could not be established";
}
?>