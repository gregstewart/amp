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
		//echo("depth is: ".$level."<br />");
		// ok now that we know that the menu is $level let's start building up the structure
		// first get the top layer
		$depth_counter = 1; // this is the first level
		// figure out the the level 1 related id
          while ($r_level >= 1) { // loop over this function until the top level is found (equals 1)
               $function_result = levelTop($last_id);
               $last_id = $function_result;
               $r_level--;
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
          $query = "SELECT category_id, name, level, related_to, image_off, image_on, img_size, priority FROM categorisation WHERE related_to = '$last_id' ORDER BY priority";
					$result = mysql_query($query);
					//echo("Find sub categories:".$query."<br />");
		$numrows = mysql_num_rows($result);
		$counter = 1;
    $old_d_s = 0;
		while ($r = mysql_fetch_array($result)) {
			$d_id = $r[0];
			$d_name = $r[1];
			$d_off = $r[4];
			$d_on = $r[5];
			$d_size = $r[6];
			// echo($d_name." = ".$r[7]."<br />");
			// now for each column header build the drop down list
			// call the function on line 15
			buildSubMenu($counter,$d_id,$d_size,$d_name, $old_d_s, $http, $last_id);
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
     
     function buildSubMenu($c,$sid,$d_s,$d_n,$o_d_s,$h, $site_id) {
          if (!isset($msg)) {
						$msg = "";
					}
					$query2 = "SELECT category_id, name, level, template, dir_path FROM categorisation WHERE related_to = '$sid'";
					$result2 = mysql_query($query2);
		  		$query3 = "SELECT url, drop_down, start_pos, left_pos, orientation, menu_spacing FROM site_info WHERE site_id = '$site_id'";
					$result3 = mysql_query($query3);
					if ($result3) {
						$total3 = mysql_num_rows($result3);
						//echo("Total: ".$total3." = Query:".$query3."<br />");
						if ($total3 == 1) {
							while ($r3 = mysql_fetch_array($result3)) {
								$d_url = $r3[0];
								$d_drop_down = $r3[1];
								$d_start_pos = $r3[2];
								$d_left_pos = $r3[3];
								$d_orientation = $r3[4];
								$d_spacing = $r3[5];
							}
						} else if ($total3 > 1) {
							echo("Query: ".$query3." has returned more than 1 record.<br />");
						} else {
							echo("Query: ".$query3." has returned 0 records.<br />");
						}
					} else {
						echo("Query failed to execute:".$query3.".<br />");
					}
					
					$counter2 = 1;
          if ($d_orientation == 1) {
						// calculate the left position
						if ($c==1) { //first menu item
								 $left_pos = $d_left_pos; //substitute with start position
								 //echo($left_pos." = left_pos".$o_d_s." = old size<br />");
						} else { // next one
								 $left_pos = $d_spacing + $o_d_s; // $d_spacing is the spacing and the other value is the width of the image
								 //echo($left_pos." = left_pos".$o_d_s." = old size<br />");
						}
						global $old_d_s;
						$old_d_s = $d_s + $left_pos;
					} else if ($d_orientation == 0){
						// calculate the right position
						if ($c==1) { //first menu item
								 $o_d_s = $d_left_pos;
								 $left_pos = $d_left_pos; //substitute with start position
								 //echo($left_pos." = left_pos ".$o_d_s." = old size<br />");
								 global $old_d_s;
								 $old_d_s = $left_pos;
						} else { // next one
								 $left_pos = $o_d_s - $d_s; // $d_spacing value is the width of the image
								 //echo($left_pos." = left_pos ".$o_d_s." = old size<br />");
								 global $old_d_s;
								 $old_d_s = $left_pos - $d_spacing;
						}
						//echo("New old_d_s:".$old_d_s."<br />");
					}
		  		global $hm_array;
                    
          //echo($old_d_s." = ".$d_s." + ".$left_pos." here <br />");
		  		$hm_array = $hm_array."HM_Array".$c." = [
[".$d_s.",      // menu width
".$left_pos.",       // left_position
".$d_start_pos.",       // top_position
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
					//echo($query2."<br />");
					if ($result2) {
						$total2 = mysql_num_rows($result2);
						//echo("Total records returned:".$total2."<br />");
						while ($r2 = mysql_fetch_array($result2)) {
							$d_id2 = $r2[0];
							$d_name2 = $r2[1];
							$d_template2 = $r2[3];
							$d_dir2 = $r2[4];
							if ($counter2 == 1) {
								$hm_array = $hm_array."[\"::/".$d_name2."&gt;\",\"".$d_url.$d_dir2.$d_template2."?action=".$d_name2."_".$d_n."&cat_id=".$d_id2."\",1,0,0]";
							} else {
								$hm_array = $hm_array.",
				[\"::/".$d_name2."&gt;\",\"".$d_url.$d_dir2.$d_template2."?action=".$d_name2."_".$d_n."&cat_id=".$d_id2."\",1,0,0]";
							}
							$counter2++;
						}
						$hm_array = $hm_array."
			]
			
			";
					} else {
						echo("NO query executed.<br />");
					}
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