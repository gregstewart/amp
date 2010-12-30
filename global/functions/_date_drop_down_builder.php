<?php
/* date drop down builder variables required 
 $s = start point
 $e = end point
 $c = checked (i.e. during update/delete this field will need to be selected)
*/
function buildDropDown ($s, $e, $c) {
 global $options_dropdown;
 $options_dropdown = "";
 for ($i = $s; $i < $e; $i++) {
  $options_dropdown .= "<option value=\"".$i."\"";
  if (($c != 0) && ($i == $c)) {
   $options_dropdown .= " selected=\"selected\"";
  }
  $options_dropdown .= ">".$i."</option>";
 }
 return $options_dropdown;
}
?>