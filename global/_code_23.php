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
    $result = mysql_query("DELETE FROM site_info WHERE site_id = '$hdn_cat_id'");
    if ($result) { // if sql above successful
        $msg = $msg."Site info deleted.<br /><br />";
    } else { // error handling
        $msg = "Database error: the following statement failed to execute: DELETE FROM site_info WHERE site_id = '$hdn_cat_id'";
    }
}
?>
