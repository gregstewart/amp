<?php 
$msg = "";
if ($o_image_size == "") { //if image size was left empty set it to 0
    $o_image_size = 0;
}
if (!isset($o_related_to_id)) { // if related left empty set it to 0
    $o_related_to_id = 0;
}
if (!isset($r_priority)) { // if related left empty set it to 0
    $r_priority = 0;
}
$conn = db_connect(); // connnect
if ($conn) {
    $token = md5(uniqid(rand(),1)); // create a random unique id
    $result = mysql_query("INSERT INTO categorisation
            (category_id, name, level, related_to, image_off, image_on, template, img_size, dir_path, cat_image, priority)
            VALUES
            ('$token', '$r_name', $r_level, '$o_related_to_id', '$o_image_off', '$o_image_on', '$o_template', $o_image_size, '$o_directory_path', '$o_cat_image', $r_priority)");
    if ($result) { // if sql above successful
        $last_id = $token;
        $msg = "Category stored in database.<br />";
        if($r_level != 0) {
           include("global/_menu_builder.php"); // now go off and build the HM_Arrays.js file for the category added
           $msg = $msg."Menu script run and menu created.<br />";
        } else {
            $hdn_cat_id = $token; // needed for form consistency
            include("global/_site_info.php"); // store some site specific information
        }
        // if not empty add meta data
        if ($_POST['o_meta_data'] != '') {
         $_POST['o_meta_data'] = str_replace(",", "", $_POST['o_meta_data']);
         // next store the meta data info
         $sql = "INSERT INTO meta_data (cat_id, meta_data) VALUES ('".$token."', '".$_POST['o_meta_data']."');";
         $result = mysql_query($sql);
         if($result) {
          $msg .= "Meta data successfully captured.<br />";
         } else {
          $msg .= "Query failed:<br />".$sql."<br />";
         }
        }
    } else { // error handling
        $msg .= "Database error: the following statement failed to execute: INSERT INTO categorisation
                (category_id, name, level, related_to, image_off, image_on, template, img_size, dir_path, cat_image)
                VALUES
                ('$token', '$r_name', $r_level, '$o_related_to_id', '$o_image_off', '$o_image_on', '$o_template', $o_image_size, '$o_directory_path', '$o_cat_image')";
    }
}
?>
