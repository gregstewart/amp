<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>
<?php	
	// now build the page menu
	$conn = db_connect(); // try to connect to database
	if ($conn) {
		//echo("Connetion established <br />");
		// figure out the depth of the menu first
		$result1 = mysql_query("SELECT level FROM categorisation ORDER BY level");
		//$numrows1 = mysql_num_rows($result1);
		while ($r1 = mysql_fetch_array($result1)) {
			$level = $r1["level"];
			//exit;
		}
		// echo("depth is: ".$level."<br />");
		// ok now that we know that the menu is $level let's start building up the structure
		// first get the top layer
		$depth_counter = 1; // this is the first level
		// figure out the the level 1 related id
          while ($r_level > 1) { // loop over this function until the top level is found (equals 1)
               // echo($r_level." >= 1<br />");
               $function_result = levelTop($last_id);
               $last_id = $function_result;
               $r_level--;
               // echo($last_id." - ".$r_level."<br />");
          }
          // ok now that we have the top most id for this update let's
          // get the path so that we can write the appropriate HM_Arrays.js file
          $result4 = mysql_query("SELECT dir_path FROM categorisation WHERE category_id = '$last_id'");
          $r4_total = mysql_num_rows($result4);
          if ($r4_total != 0) {
               while ($r4 = mysql_fetch_array($result4)) {
                    $d_path = $r4[0];
               }
          } else {
               echo("Error...<br />SELECT dir_path FROM categorisation WHERE category_id = '".$last_id."'");
               exit;
          }
          $result = mysql_query("SELECT category_id, name, level, related_to, image_off, image_on, img_size FROM categorisation WHERE related_to = '$last_id'");
		$numrows = mysql_num_rows($result);
		$counter = 1;
          $old_d_s = 0;
		while ($r = mysql_fetch_array($result)) {
			$d_id = $r[0];
			$d_name = $r[1];
			$d_off = $r[4];
			$d_on = $r[5];
			$d_size = $r[6];
			// now for each column header build the drop down list
			// call the function on line 15
			buildSubMenu($counter,$d_id,$d_size,$d_name, $old_d_s, $http);
			//now that we have the array let's output it to a file
			$counter++;
		}
			$array_header_info = "/***************************************************************************
                            Version 4 Menu ARRAYS
***************************************************************************/
"
;
			$hm_array = $array_header_info.$hm_array;
			outputFile($hm_array,$d_path);

	}
     
     function buildSubMenu($c,$sid,$d_s,$d_n,$o_d_s,$h) {
          $result2 = mysql_query("SELECT category_id, name, level, template, dir_path FROM categorisation WHERE related_to = '$sid'");
		$counter2 = 1;
          if ($c==1) {
               $left_pos = 15;
               //echo($left_pos." = left_pos".$o_d_s." = old size<br />");
          } else {
               $left_pos = 10 + $o_d_s;
               //echo($left_pos." = left_pos".$o_d_s." = old size<br />");
          }
		global $hm_array;
          global $old_d_s;
          $old_d_s = $d_s + $left_pos;
          //echo($old_d_s." = ".$d_s." + ".$left_pos." here <br />");
		$hm_array = $hm_array."HM_Array".$c." = [
[".$d_s.",      // menu width
".$left_pos.",       // left_position
86,       // top_position
\"gray\",   // font_color
\"white\",   // mouseover_font_color
\"dddddd\",   // background_color
\"black\",   // mouseover_background_color
\"eaeaea\",   // border_color
\"eaeaea\",    // separator_color
0,         // top_is_permanent
0,         // top_is_horizontal
0,         // tree_is_horizontal
1,         // position_under
1,         // top_more_images_visible
1,         // tree_more_images_visible
\"null\",    // evaluate_upon_tree_show
\"null\",    // evaluate_upon_tree_hide
,          // right_to_left
],     // display_on_click
";
		while ($r2 = mysql_fetch_array($result2)) {
			$d_id2 = $r2[0];
			$d_name2 = $r2[1];
               $d_template2 = $r2[3];
               $d_dir2 = $r2[4];
			if ($counter2 == 1) {
				$hm_array = $hm_array."[\"::/".$d_name2."&gt;\",\"".$h.$d_dir2.$d_template2."?action=".$d_name2."_".$d_n."&amp;cat_id=".$d_id2."\",1,0,0]";
			} else {
				$hm_array = $hm_array.",
[\"::/".$d_name2."&gt;\",\"".$h.$d_dir2.$d_template2."?action=".$d_name2."_".$d_n."&amp;cat_id=".$d_id2."\",1,0,0]";
			}
			$counter2++;
		}
		$hm_array = $hm_array."
]

";
		return $hm_array;
	}
	
	// function that controls the file generation
	function outputFile($c,$p) {
		$file = fopen("../".$p."global/js/HM_Arrays.js", "w");
		fwrite($file, $c);
		fclose($file);
		return true;
	}
     
     function levelTop($l_id) {
          $result3 = mysql_query("SELECT level, related_to FROM categorisation WHERE category_id = '$l_id'");
           //echo("SELECT level, related_to FROM categorisation WHERE category_id = ".$l_id."<br />");
           if ($result3) {
               global $d_rel_id;
               while ($r3 = mysql_fetch_array($result3)) {
                    $d_level = $r3[0];
                    $d_rel_id = $r3[1];
               }
               return $d_rel_id;
          }
     }
?>


</body>
</html>
