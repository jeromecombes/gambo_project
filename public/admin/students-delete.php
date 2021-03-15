<?php
require_once "../inc/config.php";
require_once "../inc/class.student.inc";
access_ctrl(5);

$s=new student();
$s->delete2($_POST['students']);

header("Location: /students?error=0&msg=delete_success");
?>