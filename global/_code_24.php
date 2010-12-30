<?php 
 if ($action == 'update type_resources' || $action == "delete type_resources") {
  $conn = db_connect();
  if($conn) {
      $result = mysql_query("SELECT type.type_id, type.type FROM type");
      if ($result) {
          $total = mysql_num_rows($result);
          if ($total > 0) {
              $options = "";
              $total = mysql_numrows($result);
              if ($total == 0)
               $options = $options."<option value=\"\"> &gt;&gt; No content found</option>";
              while ($r = mysql_fetch_array($result)) {
                  $options = $options."
                  <option value=\"".stripslashes($r[0])."\">".stripslashes($r[1])."</option>";
              }
          } else {
              $msg = "Query returned 0 records";
          }
      } else {
          $msg = "Database connection failed";
      }
  }
 }
?>
