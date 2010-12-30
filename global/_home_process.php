<?php        
        // insert, update and delete functionality for categories
        // Show form for add/ selected update and deletion
        if ($action == "add_categories" || $action == "update_categories2" || $action == "delete_categories2") {
            include ("global/_code_1.php");
        } else if($action == "add_categories2") { // let's add a record
            include ("global/_code_2.php");
        } else if ($action == "update_categories" || $action == "delete_categories") { // query for displaying all stored categories
            include ("global/_code_3.php");
        } else if($action == "update_categories3") { // update the submitted category information
            include ("global/_code_4.php");
        } else if($action == "delete_categories3") { // same for delete
            include ("global/_code_5.php");
        } else if($action == "add_content" || $action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") {// adding content to the site
            include ("global/_code_6.php");
        } else if($action == "add_content2") { // content submitted
            include ("global/_code_7.php");
        } else if ($action == "add_content3" || $action == "add_resources2" || $action == "update_resources3" || $action == "delete_resources3") { // manage the adding of new resources for a piece of content
            include ("global/_code_8.php");
        } else if ($action == "update_content" || $action == "delete_content" || $action == "publish_content") { // display content items for selection
            include ("global/_code_9.php");
        } else if ($action == "update_content3" || $action == "publish_content3") { // update process for content
            include ("global/_code_10.php");
        }else if ($action == "delete_content3") { // deletion process for content
            include ("global/_code_11.php");
        } else if ($action == "add_resources") { // a resource
            include ("global/_code_12.php");
        } else if ($action == "update_resources" || $action == "delete_resources") { // select resources for update/delete
            include ("global/_code_13.php");
        } else if ($action == "update_resources2" || $action == "delete_resources2") { // execute update/delete resources
            include("global/_code_14.php");
        } else if ($action == "add_users" || $action == "update_users2" || $action == "delete_users2") { // manage users
            include("global/_code_15.php");
        } else if ($action == "add_users2" || $action == "update_users3" || $action == "delete_users3") { // add/update/delete users
            include ("global/_code_16.php");
        } else if ($action == "update_users" || $action == "delete_users") { // display selection of users for management
            include ("global/_code_17.php");
        } else if ($action == "add_groups" || $action == "update_groups2" || $action == "delete_groups2") { // manage groups
            include ("global/_code_18.php");
        } else if ($action == "add_groups2" || $action == "update_groups3" || $action == "delete_groups3") { // update/delete group process
            include ("global/_code_19.php");
        } else if ($action == "update_groups" || $action == "delete_groups") { // show (process) groups for update/delete
            include ("global/_code_20.php");
        } else if ($action == "site_info2") { // adding site info
            include ("global/_code_21.php");
        } else if ($action == "updatesite_info2") { // updating site info
            include ("global/_code_22.php");
        } else if ($action == "deletesite_info2") { // deleting site info
            include ("global/_code_23.php");
        } else if ($action == "update type_resources" || $action == "delete type_resources") { // add a content type
            include ("global/_code_24.php");
        } else if ($action == "add type_resources2" || $action == "update type_resources3" || $action == "delete type_resources3") { // add a content type
            include ("global/_code_25.php");
        } else if ($action == "update type_resources2" || $action == "delete type_resources2") {
            include ("global/_code_26.php");
        } else if ($action == "rollback_content") { // select content to view history
            include ("global/_code_32.php");
        } else if ($action == "rollback_content2") { // display selected content and it's history
            include ("global/_code_27.php");
        } else if ($action == "rollback_content3") { // now make the relevant updates
            include ("global/_code_28.php");
        } else if ($action == "homepage_content") { // select a homepage to edit
            include("global/_code_29.php");
        } else if ($action == "homepage_content2") { // edit the display sequence
            include("global/_code_30.php");
        } else if ($action == "homepage_content3") { // store the changes
            include("global/_code_31.php");
        } else if ($action == "update_content_cancel") { // store the changes
            include("global/_code_33.php");
        }
?>