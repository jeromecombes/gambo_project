<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../../vendor/autoload.php';

$app = require_once __DIR__.'/../../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
));

error_reporting(0);

$semestre = filter_input(INPUT_GET, 'semestre', FILTER_SANITIZE_STRING);
$semester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_STRING);

if (!$semester) {
    $semester = (!empty($_SESSION['vwpp']['semestre']) or $semestre) ? true : false;
}

echo <<<EOD
<div id='title'>VWPP Database - Admin</div>
<div id='loginName'><span>{$_SESSION['vwpp']['login_name']}</span>
  <span class='ui-icon ui-icon-triangle-1-s' id='myMenuTriangle'></span><br/>
  <div id='myMenu'>
    <a href='/account'>My Account</a><br/>
    <a href='/logout' onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>
    <form id="logout-form" action="/logout" method="POST" style="display: none;">
EOD;
    echo csrf_field() . "\n";
echo <<<EOD
    </form>
  </div>
</div>

<div class='ui-tabs ui-widget ui-widget-content ui-corner-all'>
<nav>
<ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all'>
<li id='li0' class='ui-state-default ui-corner-top'><a href='/admin2'>Home</a></li>
EOD;
if($semester){
  if(in_array(24,$_SESSION['vwpp']['access']))
    echo "<li id='li11' class='ui-state-default ui-corner-top'><a href='dates.php'>Dates</a></li>\n";

  echo "<li id='li5' class='ui-state-default ui-corner-top'><a href='/students'>Students</a></li>\n";

  if(in_array(2,$_SESSION['vwpp']['access']))
    echo "<li id='li7' class='ui-state-default ui-corner-top'><a href='/admin/housing'>Housing</a></li>\n";

  echo "<li id='li10' class='ui-state-default ui-corner-top'><a href='univ_reg.php'>Univ. reg.</a></li>\n";

  if(in_array(23,$_SESSION['vwpp']['access']))
    echo "<li id='li1' class='ui-state-default ui-corner-top'><a href='courses4.php'>Courses</a></li>\n";

  if(in_array(18,$_SESSION['vwpp']['access']) or in_array(19,$_SESSION['vwpp']['access']) or in_array(20,$_SESSION['vwpp']['access']))
    echo "<li id='li9' class='ui-state-default ui-corner-top'><a href='grades3-1.php'>Grades</a></li>\n";

  echo "<li id='li4' class='ui-state-default ui-corner-top'><a href='eval_index.php'>Evaluations</a></li>\n";

  if(in_array(3,$_SESSION['vwpp']['access']))
    echo "<li id='li8' class='ui-state-default ui-corner-top'><a href='/documents'>Documents</a></li>\n";
}

if(in_array(9,$_SESSION['vwpp']['access']))
  echo "<li id='li2' class='ui-state-default ui-corner-top'><a href='users.php'>Users</a></li>\n";

echo "<li id='li6' class='ui-state-default ui-corner-top'><a href='/account'>My Account</a></li>\n";

?>
</ul>
</nav>
<section class='content'>
