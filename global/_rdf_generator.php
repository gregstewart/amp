<?php
 /*
  This template is called when the home page is managed and the user ticks the generate 
  the rss/rdf feed creation. The templte builds up a feed based on the homepage selection,
  pumps them into $output_rdf and writes the file into a folder off the user's domain root,
  eg: http://gregs.teacupinastorm.com/html/rdf/
 */
// dummy value to simulate call
$_POST['hdn_site_id'] = '029c68947d7e7f4aef66b04f7544c3b5';
include("../global/db_stuff.php");
$conn = db_connect();
$output_rdf = "";

if($conn) {
 $sql = "select site_name, url from site_info where site_id = '".$_POST['hdn_site_id']."';";
 $result = mysql_query($sql);
 if ($result) {
  $total = mysql_numrows($result);
  if ($result) {
   while ($r = mysql_fetch_array($result)) {
    $title = $r[0];
    $url = $r[1];
    $description = "Site description appears here.";
   }
$output_rdf .= "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<rdf:RDF xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\" xmlns=\"http://purl.org/rss/1.0/\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">
 <channel rdf:about=\"".$url."\">
  <title>".$title."</title>
  <link>".$url."</link>
  <description>".$description."</description>
  <items>
   <rdf:Seq>";
  } else {
   $msg .= "Query returned an unexpected result:<br />".$sql.".<br />";
  }
 } else {
  $msg .= "Query failed:<br />".$sql."<br />";
 }
 
 // get and loop over items
 $sql = "select homepage.content_id, homepage.pos, content.content_title, content.content_teaser, content.date_written, content.content_category_id, categorisation.dir_path, categorisation.template from homepage, content, categorisation where homepage.site_id = '".$_POST['hdn_site_id']."' and homepage.content_id = content.content_id and content.content_category_id = categorisation.category_id";
 $result = mysql_query($sql);
 if($result) {
  $total = mysql_numrows($result);
  if($total!=0) {
   $rdf_list = "";
   $rdf_content = "";
   while ($r = mysql_fetch_array($result)) {
    //<li rdf:resource=\"http://www.yourdomain.com/index.php?id=x\" />"
    $rdf_list .= "
     <li rdf:resource=\"".$url.$r[6]."article.php?id=".$r[0]."\" />";
    $rdf_content .= "
 <item rdf:about=\"".$url.$r[6]."article.php?id=".$r[0]."\">
  <title>".stripslashes($r[2])."</title>
  <link>".$url.$r[6]."article.php?id=".$r[0]."</link>
  <description><![CDATA[".stripslashes($r[3])."]]></description>
 </item>";
   }
$output_rdf .= $rdf_list;
$output_rdf .= "
   </rdf:Seq>
  </items>
 </channel>";
$output_rdf .= $rdf_content;
  } else {
   $msg .= "Query returned 0 results";
   $rdf_list .= "No resources found";
  }
 } else {
  $msg .= "Query failed:<br />".$sql."<br />";
 }
} else {
 $msg .= "Database connection failed.<br />";
}

$output_rdf .= "
</rdf:RDF>";
echo($output_rdf);
//echo($msg);
?>