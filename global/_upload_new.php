<?php 
  $msg = $msg."<p>Uploading the file($o_upload)<br />";
  echo("path and file: ".$o_upload."<br />");
  echo("file name: ".$o_upload_name."<br />");
  echo("file size: ".$o_upload_size."<br />");
  echo("file type: ".$o_upload_type."<br />");
  
  //first check the file size
  $max_file_size = 300000;
  if ($o_upload_size < $max_file_size) {
   $msg .= "Your file is small enough.<br />";
   
   /* next we check for the right file type
    Now this should be based on the file type you are uploading.
    So set a varaible for these purposes
   */
   if (eregi("\.".$file_extension_allowed."$", $o_upload_name)) {
    $msg .= "Correct file type, proceed.<br />";
    
    /*
     So far so good, now we need to move said file to the database where it will be stored
    */
    $data = addslashes(fread(fopen($o_upload, "r"), filesize($o_upload)));
    $token_file = md5(uniqid(rand(),1));
    $sql3 = "insert into files(id_files, bin_data, filename, filesize, filetype, resource_id) VALUES ('$token_file', '$data','$o_upload_name', '$o_upload_size', '$o_upload_type', '$token')";
    $result3 = mysql_query($sql3);
    mysql_free_result($result3); // it's always nice to clean up!
    $msg .= "Thank you. The new file was successfully added to our database.<br />";
    
   } else {
    $msg .= "Sorry, only files with a .".$file_extension_allowed." extention can uploaded.<br />Please use your back button and try again";
   }
  } else {
   $msg .= "Sorry your file is too big.<br />";
  }
  $msg .= "</p>";
?>

