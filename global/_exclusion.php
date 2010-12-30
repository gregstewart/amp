<?php
/*
 function that gets called when updating and deleting
 a category
*/

function checkExclusion($id) {
 global $is_excluded;
 $is_excluded = 0;
 //echo($id."<br />");
 $arExclusion = array("f926b87567d4affc6618d83f73c2cc87","9102779955bd01502d7dd8f52a250709","f247017260e44cd788d401835d88a909","6c2cb5aa273684d7cc48d01be49a3dd0","f61ba7a45266c937876a31b43847702f","9ce36d845efb62fe3344d187951b1d2f","30b980ba677972335419ec6c5a1e063f","c2640e5a57929591f73fca38f5ac8d00","9274ac68c5eddb086027081356dbe741","e8648d0e043eff3d08aedd19e9920533","90894d10d361dc8131256f12470b5315","15a0b60b820c68c24750180bc221c60f","069de17c6e55f0ec88242774bbe9b84a","74f3e657981fbc4aa9a0359fe5d4bb7a","b51bc57ac3cd7052b53a7ce9d308bf6f","a712b4dfb1b99ca518e38c44a121efa0","d76ca075d56762bec415431d302d5b2b","d21dcd5fff08232f52177a6ce31a879d","4629bc0507beb070a3799df13c0ef5ec","def07c2fba0176afaca8c915357f96d2","c2b894f25a108f1ac53817f92af02422","803b39cf2cb4918a15115940d52c41d1","7f0f5437515bd182b08004b470eaffb0","dcc8b090c21fa2bb7ce7c25485f6aaf9","ea121c93474420dce2fa4a11e3dc462f","3f5d9c5159bb51ca19297aa2b6f93aae", "9a973d83d2d6b5d5cfc1acbd2b385645");
 $depth = count($arExclusion."<br />");
 //echo($depth);
 for ($i = 0; $i < 26; $i++) {
  //echo($i.". ".$arExclusion[$i]."<br />");
  if ($id == $arExclusion[$i]) {
   $is_excluded = 1;
   break;
  }
 }
 //echo($is_excluded);
 return $is_excluded;
}

//$_POST['hdn_cat_id'] = "3f5d9c5159bb51ca19297aa2b6f93aae";
checkExclusion($_POST['hdn_cat_id']);
//echo($is_excluded);
?>