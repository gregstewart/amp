<?php 
    $conn = db_connect();
    if ($conn) {
        $get_types = mysql_query("SELECT type_id, type, extension FROM type");
        if ($get_types) {
            $type_options = "";
            while ($g_t = mysql_fetch_array($get_types)) {
                $type_options = $type_options."<option value=\"".$g_t[0]."\">".$g_t[1]." ";
                if($g_t[2]!="") {
                 $type_options = $type_options."(.".$g_t[2].")";
                }
                $type_options = $type_options."</option>";
            }
        }
    }
?>