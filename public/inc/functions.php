<?php

//	Access control
function access_ctrl($ids){
  $ids=explode(",",$ids);
  $access=false;
  foreach($ids as $elem){
    if(in_array($elem,$_SESSION['vwpp']['access'])){
      $access=true;
    }
  }

  if(!$access){
    echo "<b style='color:red;'>Access denied</b><br/><br/><a href='javascript:history.back()'>Back</a>";
    exit;
   }
}

?>
