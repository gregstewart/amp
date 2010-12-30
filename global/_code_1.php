<?php 
$conn = db_connect(); // try to connect to database
$option = "";
if ($conn) {
    // figure out the depth of the menu first
    $result = mysql_query("SELECT category_id,level FROM categorisation ORDER BY level ASC");
    while ($r = mysql_fetch_array($result)) {
        $level = $r["level"];
        $cat = $r["category_id"];
    }
    $depth = $level + 1; // $depth this varibale is required _drop_relate.php line 23 for the drop down dynamic build
    if ($action == "update_categories2" || $action == "delete_categories2") { // this selects the previously selected record information
        $sql2 = "SELECT categorisation.category_id, categorisation.name, categorisation.level, categorisation.related_to, categorisation.image_off, categorisation.image_on, categorisation.template, categorisation.dir_path, categorisation.img_size, categorisation.cat_image, categorisation.priority FROM categorisation WHERE categorisation.category_id = '$r_category'";
        $result2 = mysql_query($sql2);
        if ($result2){
         // echo($sql2);
         while ($r2 = mysql_fetch_array($result2)) {
             $d_id = $r2[0];
             $d_name = $r2[1];
             $d_level = $r2[2];
             $d_related_to = $r2[3];
             $d_image_off = $r2[4];
             $d_image_on = $r2[5];
             $d_template = $r2[6];
             $d_img_size = $r2[8];
             $d_dir_path = $r2[7];
             $d_cat_image = $r2[9];
 						      $d_priority = $r2[10];
         }
         $sql2 = "select meta_data from meta_data where cat_id = '".$r_category."';";
         $result2 = mysql_query($sql2);
         if($result2) {
          while ($r2 = mysql_fetch_array($result2)) {
           $d_cat_meta = $r2[0];
          }
         } else {
          $msg .= "Query failed:<br />".$sql2."<br />";
         }
        } else {
         $msg .= "Query failed:<br />".$sql2."<br />";
        }
    }
}
echo($msg);
?>