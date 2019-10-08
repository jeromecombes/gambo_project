<?php		//	Hide VWPP Courses Final Reg. for selected students
session_start();
require_once "../inc/config.php";

access_ctrl(16);

$semester=str_replace("_"," ",$_SESSION['vwpp']['semester']);

foreach($_POST['students'] as $student){
  $db=new db();
  $db->delete("courses_rh2","student='$student' AND semester='$semester'");
}

header("Location: /admin/students?error=0&msg=update_success");
?>