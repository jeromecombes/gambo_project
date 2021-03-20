<?php

require_once __DIR__."/lang.en.inc";

$language = $_SESSION['vwpp']['language'] ?? 'en';

require_once __DIR__."/lang.{$language}.inc";
?>
