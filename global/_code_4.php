<?php 
$msg = "";
if ($o_image_size == "") {
    $o_image_size = 0;
}
if (!isset($o_related_to_id)) {
    $o_related_to_id = 0;
}
if (!isset($o_priority)) {
    $o_priority = 0;
}
// step one check that the item being updated is not excluded
if ($session_id != '745b6d70df77493147f895945eb35553') {
	include ("global/_exclusion.php");
} else {
	$is_excluded == 0;
}
if ($is_excluded == 0) {
		
 $conn = db_connect();
 if ($conn) {
   $query = "UPDATE categorisation
             SET name = '$r_name', 
                 level = $r_level, 
                 related_to = '$o_related_to_id', 
                 image_off = '$o_image_off', 
                 image_on = '$o_image_on', 
                 template = '$o_template', 
                 img_size = $o_image_size,
                 dir_path = '$o_directory_path',
                 cat_image = '$o_cat_image',
 								 priority = '$r_priority'
             WHERE category_id = '$hdn_cat_id'";
     $result = mysql_query($query);
     if ($result) {
         $msg = "Category updated in database.<br />";
         $last_id = $hdn_cat_id;
         if($r_level != 0) {
             include("global/_menu_builder.php"); // re-create the HM_Arrays.js file for that category
             $msg = $msg."Menu script run and menu created.<br />";
         } else {
             include("global/_update_site_info.php"); // store some site specific information
         }
         // if meta data submitted
         if ($_POST['o_meta_data'] != '') {
          // now we need to check quickly whether there was any metadata captured previously
          // this will help determine whether to run an update or an insert
          $sql = "select meta_data from meta_data where cat_id = '".$_POST['hdn_cat_id']."';";
          $result = mysql_query($sql);
          if($result) {
           $_POST['o_meta_data'] = str_replace(",", "", $_POST['o_meta_data']);
           //echo($_POST['o_meta_data']);
           $total = mysql_numrows($result);
           if ($total == 0) {
            // insert statement
            $sql = "INSERT INTO meta_data (cat_id, meta_data) VALUES ('".$_POST['hdn_cat_id']."', '".$_POST['o_meta_data']."');";
           } else {
            // update
            $sql = "UPDATE meta_data  SET meta_data = '".$_POST['o_meta_data']."' WHERE cat_id = '".$_POST['hdn_cat_id']."';";
           }
           
           $result = mysql_query($sql);
           if($result) {
            $msg .= "Meta data stored successfully.<br />";
           } else {
            $msg .= "Query failed:<br />".$sql."<br />";
           }
          } else {
           $msg .= "Query failed:<br />".$sql."<br />";
          }
         }
     } else { // error handling
         $msg = "Database error: the following statement failed to execute: UPDATE categorisation
         SET name = '$r_name', 
             level = $r_level, 
             related_to = '$o_related_to_id', 
             image_off = '$o_image_off', 
             image_on = '$o_image_on', 
             template = '$o_template', 
             img_size = $o_image_size,
             dir_path = '$o_directory_path',
             cat_image = '$o_cat_image',
					   priority = '$r_priority'
         WHERE category_id = '$hdn_cat_id'";
     }
 }
} else {
 $msg .= "Sorry you are not permitted to updated the selected category ($hdn_cat_id). Please contact your sys admin for more information";
}
?>