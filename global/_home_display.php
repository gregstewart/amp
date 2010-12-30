<?php
        if ($action == "add_categories" || $action == "update_categories2" || $action == "delete_categories2") { // displays the form add a new category, updating/deleting the previously selected category.
            if ($action == "add_categories") {
                $section_title = "add";
            } else if ($action == "update_categories2") {
                $section_title = "update";
            } else if ($action == "delete_categories2") {
                $section_title = "delete";
            }
            include("global/forms/_categorisation_details.php");
	    } else if ($action == "update_categories" || $action == "delete_categories") { // displays the template for selecting the update and delete of a category
            if ($action == "update_categories") {
                $section_title = "update";
            } else if ($action == "delete_categories") {
                $section_title = "delete";
            }
            include("global/forms/_categorisation_select.php");
         } else if ($action == "add_content" || $action == "update_content2" || $action == "delete_content2" || $action == "publish_content2") { // display the content entry form for the following actions add, update and delete step 2 and publish content step 2 
            if ($action == "add_content") {
                $section_title = "add";
            } else if ($action == "update_content2") {
                $section_title = "update";
            } else if ($action == "delete_content2") {
                $section_title = "delete";
            } else if ($action == "publish_content2") {
                $section_title = "publish";
            }
            include("global/forms/_content_details.php");
         } else if ($action == "site_info") {
            $section_title = "Add site info";
            include("global/forms/_site_info.php");
         } else if ($action == "updatesite_info") {
            $section_title = "Update site info";
            include("global/forms/_site_info.php");
         } else if ($action == "deletesite_info") {
            $section_title = "Delete site info";
            include("global/forms/_site_info.php");
         } else if ($action == "add_content2" || $action == "update_content3" || $action == "publish_content3" || $action == "add_resources" || $action == "update_resources2" || $action == "delete_resources2") { // if second step add and new resources ticked, or content updated/deleted with resources ticked or simply adding a new resource
            if ((isset($HTTP_POST_VARS["r_new_resource"]) AND $HTTP_POST_VARS["r_new_resource"] == 1 AND $HTTP_POST_VARS["o_how_many"] <> 0) || $action == "add_resources" || $action == "update_resources2" || $action == "delete_resources2") { 
                if ($action == "add_content2" || $action == "update_content3" || $action == "publish_content3" || $action == "add_resources") {
                    $section_title = "add";
                } else if ($action == "update_resources2") {
                    $section_title = "update";
                } else if ($action == "delete_resources2") {
                    $section_title = "delete";
                }
                include("global/forms/_resource_details.php");
            }
         } else if ($action == "update_content" || $action == "delete_content" || $action == "publish_content") { // update, delete and publish content
            if ($action == "update_content") {
                $section_title = "update";
            } else if ($action == "delete_content") {
                $section_title = "delete";
            } else if ($action == "publish_content") {
                $section_title = "publish";
            }
            include("global/forms/_content_select.php");
         } else if ($action == "update_resources" || $action == "delete_resources") { // update and delete resources
            if ($action == "update_resources") {
                $section_title = "update";
            } else if ($action == "delete_resources") {
                $section_title = "delete";
            }
            include("global/forms/_resource_select.php");
         } else if ($action == "add_users") { // add new user
            $section_title = "add";
            include("global/forms/_user_details.php");
         } else if ($action == "update_users" || $action == "delete_users") { // update and delete users
            if ($action == "update_users") {
                $section_title = "update";
            } else if ($action == "delete_users") {
                $section_title = "delete";
            }
            include("global/forms/_user_select.php");
         } else if ($action == "update_users2" || $action == "delete_users2") { //update details of users
            if ($action == "update_users2") {
                $section_title = "update";
            } else if ($action == "delete_users2") {
                $section_title = "delete";
            }
            include("global/forms/_user_details.php");
         } else if ($action == "add_groups" || $action == "update_groups2" || $action == "delete_groups2") { //update details of groups
            if ($action == "add_groups") {
                $section_title = "add";
            }else if ($action == "update_groups2") {
                $section_title = "update";
            } else if ($action == "delete_groups2") {
                $section_title = "delete";
            }
            include("global/forms/_group_details.php");
         } else if ($action == "update_groups" || $action == "delete_groups") {
            if ($action == "update_groups") {
                $section_title = "update";
            } else if ($action == "delete_groups") {
                $section_title = "delete";
            }
            include("global/forms/_group_select.php");
         } else if ($action == "add type_resources" || $action == "update type_resources2" || $action == "delete type_resources2") { //add/update/delete display details of types
            if ($action == "add  type_resources") {
                $section_title = "add";
            }else if ($action == "update type_resources") {
                $section_title = "update";
            } else if ($action == "delete type_resources") {
                $section_title = "delete";
            }
            include("global/forms/_type_details.php");
         } else if ($action == "update type_resources" || $action == "delete type_resources") {
            include("global/forms/_type_select.php");
         } else if ($action == "rollback_content") {
            $section_title = "rollback";
            include("global/forms/_rollback_select.php");
         } else if ($action == "rollback_content2") {
            $section_title = "rollback";
            include("global/forms/_rollback_details.php");
         } else if ($action == "homepage_content") {
            $section_title = "select a homepage to manage";
            include("global/forms/_homepage_select.php");
         } else if ($action == "homepage_content2") {
            $section_title = "order the display of your selected homepage";
            include("global/forms/_homepage_details.php");
         }
?>