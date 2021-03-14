<?php

require_once( __DIR__ . '/inc/config.php');
require_once( __DIR__ . '/inc/class.housing.inc');

var_dump('ok');

$h = new housing;
$h->student = $_SESSION['vwpp']['student'];
$h->accept_charte();