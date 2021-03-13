<?php
// menu id
$current_id=array_key_exists("menu_id",$_SESSION['vwpp'])?$_SESSION['vwpp']['menu_id']:1;
$student=$_SESSION['vwpp']['std-id'];

$db=new db();
$db->select("students","*","id='{$_SESSION['vwpp']['std-id']}'");
$titleMenu=decrypt_vwpp($db->result[0]['lastname']);
$titleMenu.=", ".decrypt_vwpp($db->result[0]['firstname']);


echo <<<EOD
<div id='title'>VWPP Database - {$titleMenu}</div>
<div id='loginName'><span>{$_SESSION['vwpp']['login_name']}</span>
  <span class='ui-icon ui-icon-triangle-1-s' id='myMenuTriangle'></span><br/>
  <div id='myMenu'>
    <a href='myAccount.php'>My Account</a><br/>
    <a href='/logout'>Logout</a>
  </div>
</div>

<div class='ui-tabs ui-widget ui-widget-content ui-corner-all' id='student-menu'>
<nav>
<ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all' id='student-menu'>
EOD;
echo "<li class='ui-state-default ui-corner-top $class'><a href='/student'>General info</a></li>\n";
echo "<li class='ui-state-default ui-corner-top $class'><a href='/housing'>Housing</a></li>\n";
get_menu2("Univ. Reg.",5,17);
get_menu2("Courses",4,23);
get_menu2("Grades",7,array(18,19,20));
echo "<li class='ui-state-default ui-corner-top $class'><a href='/documents'>Documents</a></li>\n";
echo "<script type='text/JavaScript'>li_ids.push($id);</script>\n";
get_menu2("Schedule",8,1);

echo "<li  class='ui-state-default ui-corner-top back-to-list'><a href='/admin/students'>Back to list</a></li>\n";

$studentsList = !empty($_SESSION["vwpp"]["studentsList"]) ? $_SESSION["vwpp"]["studentsList"] : array();
$key=array_search($student,$studentsList);
if(array_key_exists($key-1,$studentsList)){
  $previousId=$studentsList[$key-1];
  echo "<li class='ui-state-default ui-corner-top li-previous'><a href='students-view2.php?id=$previousId'>Previous</a></li>\n";
}
if(array_key_exists($key+1,$studentsList)){
  $nextId=$studentsList[$key+1];
  echo "<li class='ui-state-default ui-corner-top li-next'><a href='students-view2.php?id=$nextId'>Next</a></li>\n";
}

echo "</ul>\n";


?>
