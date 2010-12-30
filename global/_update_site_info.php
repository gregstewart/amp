<?php	
	// Store additional site info
	$msg = "";
    $action = "updatesite_info";
    $conn = db_connect();
    if ($conn) {
        $sql = "SELECT site_name, url, drop_down, start_pos, left_pos, orientation, menu_spacing, upload_size FROM site_info WHERE site_id = '$hdn_cat_id'";
        $result = mysql_query($sql);
        if ($result) {
            $total = mysql_num_rows($result);
            if ($total == 1) {
                while ($r = mysql_fetch_array($result)) {
                    $r_name = stripslashes($r[0]);
                    $r_url = stripslashes($r[1]);
                    $r_dropdown = stripslashes($r[2]);
                    $r_start_pos = stripslashes($r[3]);
                    $r_left_pos = stripslashes($r[4]);
                    $r_orientation = stripslashes($r[5]);
                    $r_menu_spacing = stripslashes($r[6]);
                    $r_upload_limit = stripslashes($r[7]);
                }
            } else if ($total > 1) {
                $msg = $msg."The query returned more than one result.<br />";
            } else {
                $msg = $msg."The query returned 0 records.<br />";
            }
        } else {
            $msg = $msg."Query failed: SELECT site_id, site_name, url, drop_down, start_pos, left_pos, orientation, menu_spacing FROM site_info WHERE site_id = '$hdn_cat_id'.<br />";
        }
    } else {
        $msg = $msg."Database connection failed.<br />";
    }
?>