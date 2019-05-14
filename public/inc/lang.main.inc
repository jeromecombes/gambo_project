<?php

require_once __DIR__."/lang.en.inc";

if(array_key_exists("vwpp",$_SESSION) and array_key_exists("language",$_SESSION['vwpp'])){
  $language=$_SESSION['vwpp']['language'];
}else{
  $language="en";
}

require_once __DIR__."/lang.{$language}.inc";
?>
