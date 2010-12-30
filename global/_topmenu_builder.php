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
		$result = mysql_query("SELECT category_id, name, level, related_to, image_off, image_on, img_size FROM categorisation WHERE related_to = 'f926b87567d4affc6618d83f73c2cc87'");
		$numrows = mysql_num_rows($result);
		$header = "";
		$counter = 1;
		while ($r = mysql_fetch_array($result)) {
			$d_id = $r[0];
			$d_name = $r[1];
			$d_off = $r[4];
			$d_on = $r[5];
			$d_size = $r[6];
			$header = $header."<td width=\"1%\"><img src=\"images/s.gif\" width=\"10\" height=\"1\" alt=\"spacer\" border=\"0\" /></td>
		<td width=\"1%\"><a href=\"\" onMouseOut=\"MM_swapImgRestore(); popDown('HM_Menu".$counter."');\" onMouseOver=\"MM_swapImage('tcias_nav_".$counter."','','images/".$d_on."'); popUp('HM_Menu".$counter."',event);\"><img name=\"tcias_nav_".$counter."\" src=\"images/".$d_off."\" width=\"".$d_size."\" height=\"14\" alt=\"".$d_name."\" border=\"0\" /></a></td>";
			++$counter;
		} 
          if (!$result) {
               $header = $header."<td width=\"1%\"><img src=\"images/s.gif\" width=\"10\" height=\"1\" alt=\"spacer\" border=\"0\" /></td><td>An error has occured</td>";
          }
     }
?>