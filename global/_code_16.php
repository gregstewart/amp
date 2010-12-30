<?php 
// These variables need to be destroyed if they exist
if (isset($session_fname)) {
 session_start();
 
 $fresult = session_unregister("session_fname");
 $fresult1 = session_unregister("session_flname");
 $fresult2 = session_unregister("session_femail");
 $fresult3 = session_unregister("session_fusername");
 $fresult4 = session_unregister("session_fpassword");
 $fresult4 = session_unregister("session_fgroup");
}

if (isset($HTTP_POST_VARS["r_name"])) { // check to see if content submitted
    /* first we need to determine whether or not optional access resources have been selected
      If they have been selected the group selection is irrelevant. To this end we set a variable
      to check for it when we insert. Below are listed the values for the actions to be taken upon 
      form evaluation ($process_action).
      
      1 = redirect
      2 = groups
      3 = categories
   
      Very important do not tamper with the logic below it takes careful account of varying 
      fork submission combinations and looks to eliminate potential group or category administration
      omission.
   */
   
   if (!isset($o_select_access) && $o_group == 0) {
      //echo("1");
      if ($action == "update_users3") {
          $process_action = 3;
      } else {
          $process_action = 1;
      }
   } else if ((!isset($o_select_access) && $o_group != 0) || ($o_select_access == 0 && $o_group != 0) ) {
      //echo("2");
      $process_action = 2;
   } else if ($o_select_access[0] != 0 && $o_group == 0) {
      //echo("3");
      $process_action = 3;
   } else if (!$o_select_access[0] == 0) {
      //echo("4");
      $process_action = 3;
   } else if ($o_select_access[0] == 0 && $o_group == 0) {
      //echo("5");
      if ($action == "update_users3") {
          $process_action = 3;
      } else {
          $process_action = 1;
      }
   } else if ($o_select_access[0] == 0 && $o_group != 0) {
      //echo("6");
      $process_action = 2;
   }
    
    $r_group = $o_group;
    $msg = "";
    $conn = db_connect();
    if($conn) {
         $token = md5(uniqid(rand(),1)); // unique ID
         $r_name = addslashes($r_name);
         $r_surname = addslashes($r_surname);
         $r_email = addslashes($r_email);
         $r_username = addslashes($r_username);
         $r_password = addslashes($r_password);
         $r_group = addslashes($r_group);
         
         //echo("variable submitted.<br />");
         
         if ($action != "delete_users3") {      
           
           if ($action == "update_users3") { // check to see if any pre-selected categories have been removed
              if (isset($HTTP_POST_VARS)) {
                // now delete the existing ones
                for ($i = 1; $i <= $hdn_counter; $i++) { // because dynamic length form
                    // not completely flexible as you need to know how many form elements have been submitted but...
                    $string = 'o_existing'.$i; // set a string to be evaluated (firtst form field name minus number plus $i
                    
                    if(isset($HTTP_POST_VARS[$string])) {
                        //echo($HTTP_POST_VARS[$string]."<br />");
                        
                        // now we have a condidate for deletion
                        if ($conn) {
                            $result = mysql_query("DELETE FROM user_resource_access WHERE category_id = '$HTTP_POST_VARS[$string]' AND user_id = '$hdn_user_id'");
                            //$result = 1;
                            //echo($HTTP_POST_VARS[$string]." and ".$hdn_user_id." are the criteria to delete.<br />");
                            if ($result) {
                                $msg = $msg."<br />Previously selected category (".$HTTP_POST_VARS[$string].") has been removed from the access list.<br />";
                                $r_group = 'c900803eec72442b4705903331fbf3e2';
                            } else {
                                $msg = $msg."database error for: DELETE FROM user_resource_access WHERE category_id = '".$HTTP_POST_VARS[$string]."' AND user_id = '$hdn_user_id'.<br />";
                            }
                        }
                    }
                }
              }
           }
           
           // now do act upon the evaluation
           if ($process_action == 1) {
              session_start();
     					session_register("session_fname", "session_flname", "session_femail", "session_fusername", "session_fpassword", "session_fgroup");
              $session_fname = $r_name;
              $session_flname = $r_surname;
              $session_femail = $r_email;
              $session_fusername = $r_username;
              $session_fpassword = $r_password;
              if (isset($r_group)) {
                  $session_fgroup = $r_group;
              }
              
              header('Location:'.$http.'home.php?action=add_users&cat_id='.$cat_id.'&err_msg=1');
           } else if ($process_action == 2) { // group specific categories only inserted
              // no need for checks at this stage as they were carried out when the action was determined
              if ($action == "update_users3") {
                  if ($r_group == 'c900803eec72442b4705903331fbf3e2') {
                      $no_group_action = 1;
                  } else {
                      $sql1a = "SELECT group_membership FROM users WHERE user_id = '$hdn_user_id'";
                      $result1a = mysql_query($sql1a);
                      
                      if ($result1a) {
                          $total1a = mysql_num_rows($result1a);
                          if ($total1a != 0) {
                              $no_group_action = 1;
                          } else {
                              $msg = $msg."Query returned 0 records: SELECT group_membership FROM users WHERE user_id = '$hdn_user_id'.<br />";
                          }
                      } else {
                          $msg = $msg."Query failed: SELECT group_membership FROM users WHERE user_id = '$hdn_user_id'.<br />";
                      }
                  }
              }
              //echo("Just add the group specific categories to the user.<br />");
              if (!isset($no_group_action)) { // this varibale will be set if an update is carried out and either 'custom' is selected or set, or no changes have been made
                  // get the categories for that group
                  $sql2 = "SELECT category_id FROM user_resource_access WHERE user_id = '$r_group'";
                  $result2 = mysql_query($sql2);
                  if ($result2) {
                      $total2 = mysql_num_rows($result2);
                      if ($total2 != 0) {
                          // if result loop over those results
                          while ($r2 = mysql_fetch_array($result2)) {
                              // and insert that category
                              $sql3 = "INSERT INTO user_resource_access (user_id, category_id) VALUES ('$token', '$r2[0]')";
                              $result3 = mysql_query($sql3);
                              if ($result3) {
                                  $msg = $msg."The following category: $r2[0] has been associated with user $token.<br />";
                              } else {
                                  $msg = $msg."The following category: $r2[0] could not be associated.$sql3<br />";
                              }
                          }
                      } else {
                          $msg = $msg."Query returned 0 records: SELECT category_id FROM user_resource_access WHERE user_id = '$r_group'.<br />";
                      }
                  } else {
                      $msg = $msg."Query failed: SELECT category_id FROM user_resource_access WHERE user_id = '$r_group'.<br />";
                  }
              }
           } else if ($process_action == 3) {
              /* 
                If an update is carried out then each selected record muct be checked against 
                the currently stored categories in the database in order to avoid duplication 
                see line 164
              */
              
              // echo("Just deal with the submitted categories.<br />");
              
              // in some cases a redirect might occur (i.e. a user has only changed the existing content
              if (!isset($o_select_access)) {
                  $skip_insertion = 1;
              }
              
              if (!isset($skip_insertion)) { // see above comment
                  // set a variable with the number of fields submitted
                  $num_fields = count($HTTP_POST_VARS["o_select_access"]);
                  
                  // automatic selction of the custom group
                  $r_group = 'c900803eec72442b4705903331fbf3e2';
                  // echo($num_fields);
                  
                  //now let's loop over the submitted form fields (this is when the check for duplicates should be carried out)
                  for ($i = 0; $i < $num_fields; $i++) {
                      if ($action == "update_users3") { // if update check for duplicate before inserting
                          $sql1a = "SELECT * FROM user_resource_access WHERE user_id = '$hdn_user_id' AND category_id = '$o_select_access[$i]'";
                          $result1a = mysql_query($sql1a);
                          if ($result1a) {
                              $total1a = mysql_num_rows($result1a);
                              //echo($total1a." results <br />");
                              if ($total1a !=0) {
                                  $skip_insertion = 1;
                              } else {
                                  $msg = $msg."Requested access to category has been checked for duplicate entry and no such category has previously been associated.<br />";
                              }
                          } else {
                              $msg = $msg."Query failed: SELECT * FROM user_resource_access WHERE user_id = '$hdn_user_id' AND category_id = '$o_select_access[$i]'.<br />";
                          }
                      }
                      if (!isset($skip_insertion)) { // this variable is only set if the category alreaqdy exists for that user
                          $sql2 = "INSERT INTO user_resource_access (user_id, category_id) VALUES ('$hdn_user_id', '$o_select_access[$i]')";
                          $result2 = mysql_query($sql2);
                          if ($result2) {
                              $msg = $msg."The following category: $o_select_access[$i] has been associated with user $hdn_user_id.<br />";
                          } else { 
                              $msg = $msg."The following category: $o_select_access[$i] has not been associated with user $hdn_user_id.<br />";
                          }
                      } else {
                          $msg = $msg."The following category: $o_select_access[$i] has been rejected for user $hdn_user_id.<br />$sql1a<br />";
                      }
                  }
              }
           } else {
              echo("Oooops an error has occured with the group membership process.<br />");
           }
         } else if ($action == "delete_users3") { // continue here deleting the user's access rights
            $sql = "DELETE FROM user_resource_access WHERE user_id = '$hdn_user_id'";
            $result = mysql_query($sql);
            if ($result) {
                $msg = $msg."Access to resources for user (".$hdn_user_id.") have been removed.<br />";
            } else {
                $msg = $msg."Query failed: ".$sql."<br />";
            }
         }
         
         // now add/update/delete the user depeding on the action passed, i.e. set $sql variable with appropriate variable
         $salt = substr($r_password, 0, 2);
         $userPswd = crypt($r_password, $salt);

         if ($action == "add_users2") {
            $sql = "INSERT INTO users
            (user_id, username, password, name, firstname, email, group_membership, department)
            VALUES
            ('$token', '$r_username', '$userPswd', '$r_surname', '$r_name', '$r_email', '$r_group', '$o_department')";
            $d_action = "added";
         } else if ($action == "update_users3") {
            $sql = "UPDATE users SET users.username = '$r_username', users.password = '$userPswd', users.name = '$r_surname', users.firstname = '$r_name', users.email = '$r_email', users.group_membership = '$r_group', users.department = '$o_department' WHERE users.user_id = '$hdn_user_id'";
            $d_action = "updated";
         } else if ($action == "delete_users3") {
            $sql = "DELETE FROM users WHERE users.user_id = '$hdn_user_id'";
            $d_action = "deleted";
         }
         
         //execute query
         $result = mysql_query($sql);
         // $result = 1;
         if ($result) { // if sql has worked process selected resources and related items
            $msg = $msg."<span class=\"alert\">User ".$d_action." successfully.</span><br />";
            if (isset($HTTP_POST_VARS)) {
               
            }
         } else {
            $msg = $msg."Query failed: ".$sql."<br />";
         }
    }
}
?>