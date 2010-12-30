<?php 
if ($o_start_position == "") { //if drop down was left empty set it to 0
    $o_start_position = 0;
}
if ($o_left_position == "") { //if left position was left empty set it to 0
    $o_left_position = 0;
}
if ($o_orientation == "") { //if orientation was left empty set it to 0
    $o_orientation = 0;
}
if ($o_menu_spacing == "") { //if menu spacing was left empty set it to 0
    $o_menu_spacing = 0;
}
if (!isset($o_drop_down)) { // if drop down left empty set it to 0
    $o_drop_down = 0;
}

$conn = db_connect(); // connnect
if ($conn) {
    $result = mysql_query("INSERT INTO site_info
            (site_id, site_name, url, drop_down, start_pos, left_pos, orientation, menu_spacing, upload_size)
            VALUES
            ('$hdn_cat_id', '$hdn_site_name', '$r_site', $o_drop_down, $o_start_position, $o_left_position, $o_orientation, $o_menu_spacing, $r_upload_limit)");
    if ($result) { // if sql above successful
        $msg = $msg."Site info stored.<br /><br />";
    } else { // error handling
        $msg = "Database error: the following statement failed to execute: INSERT INTO site_info
            (site_id, site_name, url, drop_down, start_pos, left_pos, orientation, menu_spacing, upload_size)
            VALUES
            ('$hdn_cat_id', '$hdn_site_name', '$r_site', $o_drop_down, $o_start_position, $o_left_position, $o_orientation, $o_menu_spacing, $r_upload_limit)";
    }
}
?>
