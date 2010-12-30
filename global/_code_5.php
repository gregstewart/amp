<?php 
// step one check that the item being deleted is not excluded
include ("global/_exclusion.php");
if ($is_excluded == 0) {

 $conn = db_connect();
 $msg = "";
 if ($conn) {
     $sql1a = "SELECT level, related_to FROM categorisation WHERE category_id = '$hdn_cat_id'";
     $result1a = mysql_query($sql1a);
     if ($result1a) {
         while ($r1a = mysql_fetch_array($result1a)) {
             $last_id = $r1a[1];
             $r_level = $r1a[0];
         }
     }
     
     $sql = "DELETE FROM categorisation WHERE category_id = '".$hdn_cat_id."'";
     //echo($sql."<br />");
     $result = mysql_query($sql);
     // $result = 1;
     if ($result) {
         //echo("last id: ".$last_id." and level: ".$r_level."<br />");
         $msg = $msg."Category deleted from database.<br />";
         if ($r_level != 0) {
             include("global/_menu_builder_del.php"); // re-create the HM_Arrays.js file for that category
             $msg = $msg."Menu script run and menu updated.<br />";
         } else {
             // delete menu if present
             $file = "../".$o_directory_path."global/js/HM_Arrays.js";
             if ($file) {
                 //$delete_file = file_exists($file);
                 echo($delete_file);
                 if ($delete_file == 1) {
                     $delete = unlink($file);
                     $msg = $msg."Menu array file deleted.<br />";
                 } else {
                     $msg = $msg."File could not be deleted. Please check your permissions.<br />";
                 }
             } else {
                 $msg = $msg."No file to be deleted.<br />";
             }
             
             include("global/_delete_site_info.php"); // store some site specific information
         }
         $sql = "delete from meta_data where cat_id = '".$hdn_cat_id."';";
         $result = mysql_query($sql);
         if ($result) {
          $msg .= "Meta data has been removed.<br />";
         } else {
          $msg .= "Query failed:<br />".$sql."<br />";
         }
     } else { // error handling
         $msg = $msg."Database error: the following statement failed to execute: DELETE FROM categorisation WHERE category_id = '$hdn_cat_id'";
     }
 } 
} else {
 $msg .= "Sorry you are not permitted to updated the selected category ($hdn_cat_id). Please contact your sys admin for more information";
}
?>