<?php 
    $conn = db_connect();
    if ($conn) {
        $result = mysql_query("SELECT user_id FROM user_resource_access WHERE user_id = '$session_id' AND category_id = '$cat_id'");
        if ($result) {
            $total = mysql_num_rows($result);
            if ($total == 0) {
                $denied = 0;
                $msg = "<span class=\"alert\">You do not have the appropriate permissions to access this resource.<p>Please contact your sys admin to arrange access to this resource.</p></span>";
            } else {
                $denied = 1;
            }
        }
        //echo($denied);
    }
?>