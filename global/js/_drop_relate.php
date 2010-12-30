<script language="JavaScript1.2" type="text/javascript">
	<!--
	
	/*
	Double Combo Script Credit
	By JavaScript Kit (www.javascriptkit.com)
	Over 200+ free JavaScripts here!
	*/
	
	var groups=document.frm_add_category.r_level.options.length
	var group=new Array(groups)
	for (i=0; i<groups; i++)
	group[i]=new Array()
<?php
	print("
	group[0][0]=new Option(\"Sorry no category\",\"0\")");
	print("
	group[1][0]=new Option(\"Sorry no category\",\"0\")");
	$j = 2;
     print("
	group[".$j."][0]=new Option(\"Sorry no category\",\"0\")");
     $j++;
     for ($i=0; $i<$depth; $i++) {// $depth this vriable is set in _code_1.php line 11
		$result1 = mysql_query("SELECT category_id, name, related_to FROM categorisation WHERE level = $i");
		$counter_drop = 0;
		$options = "";
		while ($r1 = mysql_fetch_array($result1)) {
			$position = $r1[0];
			$drop_name = $r1[1];
               $related = $r1[2];
               // get the next related category for display purposes
               $upper_name = "";
               $result2 = mysql_query("SELECT name FROM categorisation WHERE category_id = '$related'");
               while ($r2 = mysql_fetch_array($result2)) {
                    $upper_name = $r2[0];
               }
			if ($counter_drop == 0) {
				$options = $options."<option value=\"\">Sorry no category</option>";
			}
	
	print("
	group[".$j."][".$counter_drop."]=new Option(\"".$drop_name." ".$upper_name."\",\"".$position."\")");
			$counter_drop++;
		}
          $j++;
	}
?>
	
	function redirect(x){
	var temp=document.frm_add_category.o_related_to_id
	
	for (m=temp.options.length-1;m>0;m--)
	temp.options[m]=null
	for (i=0;i<group[x].length;i++){
	temp.options[i]=new Option(group[x][i].text,group[x][i].value)
	}
	temp.options[0].selected=true
	}
	
	function go(){
	location=temp.options[temp.selectedIndex].value
	}
	//-->
	</script>