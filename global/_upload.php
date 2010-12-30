<?php 
  //$msg = $msg."<p>Uploading the file(".$string5.")<br />";
  $msg = $msg."<p>Uploading the file.<br />";
   
  $file_name = '$o_upload'.$i.'_name';
  $file_size = '$o_upload'.$i.'_size';
  $file_type = '$o_upload'.$i.'_type';
  eval ("\$file_name = \"$file_name\";");
  eval ("\$file_size = \"$file_size\";");
  eval ("\$file_type = \"$file_type\";");
  //echo("path and file: ".$string5."<br />");
  //echo("file name: ".$file_name."<br />");
  //echo("file size: ".$file_size."<br />");
  //echo("file type: ".$file_type."<br />");
  
  //first get the max file size and check it
  $sql0 = "select upload_size from site_info where site_id = '".$site_id."'";
  $result0 = mysql_query($sql0);
  
  if (!$result0)
   $msg .= "Query failed:<br />".$sql0.".<br />";
  
  $total0 = mysql_numrows($result0);
  
  if ($total != 1)
   $msg .= "Query returned either 0 records or more than 1:<br />".$sql0."<br />";
  
  while($r0 = mysql_fetch_array($result0)) {
   $max_file_size = $r0[0];
  }
  
  //$max_file_size = 300000;
  if ($file_size < $max_file_size) {
   $msg .= "Your file is small enough.<br />";
   
   /* next we check for the right file type
    Now this should be based on the file type you are uploading.
    So set a varaible for these purposes
   */
   if (eregi("\.".$file_extension_allowed."$", $file_name)) {
    $msg .= "Correct file type, proceed.<br />";
    
    /*
     So far so good, now we need to move said file to the database where it will be stored
    */
    $data = addslashes(fread(fopen($string5, "r"), filesize($string5)));
    $token_file = md5(uniqid(rand(),1));
    $sql3 = "insert into files(id_files, bin_data, filename, filesize, filetype, resource_id) VALUES ('$token_file', '$data','$file_name', '$file_size', '$file_type', '$token')";
    $result3 = mysql_query($sql3);
    //mysql_free_result($result3); // it's always nice to clean up!
    $msg .= "Thank you. The new file was successfully added to our database.<br />";
    
   } else {
    $msg .= "Sorry, only files with a .".$file_extension_allowed." extention can uploaded.<br />Please use your back button and try again";
   }
  } else {
   $msg .= "Sorry your file is too big. The current limit is: ".$max_file_size." bytes and the file you are attempting to upload is: ".$file_size." bytes in size.<br />";
  }
  $msg .= "</p>";
?>

