<?php
require_once "../inc/config.php";
require_once "../inc/class.housing.inc";

$h=new housing();
$h->close($_POST['students']);

header("Location: /admin/students?error=0&msg=update_success");
?>
