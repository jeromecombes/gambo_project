<?php
$post['semester']=filter_input(INPUT_POST,"semester",FILTER_SANITIZE_STRING);
$get['semester']=filter_input(INPUT_GET,"semester",FILTER_SANITIZE_STRING);
$request['semester']=$post['semester']?$post['semester']:$get['semester'];
$semester_session=isset($_SESSION['vwpp']['semestre'])?$_SESSION['vwpp']['semestre']:null;

if (isset($_SESSION['vwpp']['semesters']) and count($_SESSION['vwpp']['semesters']) == 1) {
  $semester = $_SESSION['vwpp']['semesters'][0];
}else{
  $semester = $request['semester'] ? $request['semester'] : $semester_session;
}

$db=new db();
$db->select("eval_enabled","*","semester='$semester' AND semester<>''");
$displayEval=$db->result?null:"style='display:none;'";

echo <<<EOD
<div id='title'>VWPP Database</div>
<div id='loginName'><span>{$_SESSION['vwpp']['login_name']}</span>
  <span class='ui-icon ui-icon-triangle-1-s' id='myMenuTriangle'></span><br/>
  <div id='myMenu'>
    <a href='myAccount.php'>My Account</a><br/>
    <a href='logout'>Logout</a>
  </div>
</div>

<div class='ui-tabs ui-widget ui-widget-content ui-corner-all'>
<nav>
<ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all'>
<li id='li0' class='ui-state-default ui-corner-top'><a href='index.php'>Home</a></li>
EOD;

if(array_key_exists("semester",$_SESSION['vwpp']) or $post['semester'] or (isset($_SESSION['vwpp']['semesters']) and count($_SESSION['vwpp']['semesters']) == 1)){
  echo <<<EOD
  <li id='li7' class='ui-state-default ui-corner-top'><a href='/student'>General Info.</a></li>
  <li id='li2' class='ui-state-default ui-corner-top'><a href='/housing'>Housing</a></li>
  <li id='li1' class='ui-state-default ui-corner-top'><a href='/univ_reg'>Univ. Reg.</a></li>
  <li id='li3' class='ui-state-default ui-corner-top'><a href='/courses'>Courses</a></li>
  <li id='li4' class='ui-state-default ui-corner-top' $displayEval ><a href='eval_index.php'>Evaluations</a></li>
  <li id='li8' class='ui-state-default ui-corner-top'><a href='documents'>Documents</a></li>
  <li id='li9' class='ui-state-default ui-corner-top'><a href='/schedule'>Schedule</a></li>
  <li id='li10' class='ui-state-default ui-corner-top'><a href='trip_index.php'>Trip</a></li>
  <li id='li6' class='ui-state-default ui-corner-top'><a href='myAccount.php'>My Account</a></li>
</ul>
EOD;
}
?>
</nav>
<section class='content'>
