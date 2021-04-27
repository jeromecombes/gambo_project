<?php
require_once "header.php";
require_once "../inc/class.student.inc";
require_once "../inc/class.univ4.inc";
require_once "menu.php";
access_ctrl(15);

$_SESSION['vwpp']['eval_form']=isset($_GET['form'])?$_GET['form']:$_SESSION['vwpp']['eval_form'];
$form=$_SESSION['vwpp']['eval_form'];
$semester=$_SESSION['vwpp']['semestre'];

$result=array();


$s=new student();
$s->getByUniv($_SESSION["vwpp"]["login_univ"]);
$students=$s->byUnivList;

//	Reid Hall
if($form=="local"){
  $db=new db();
  $db->query("SELECT {$dbprefix}courses.professor AS professor, {$dbprefix}courses.title AS title,
    {$dbprefix}evaluations.id AS id FROM {$dbprefix}evaluations INNER JOIN {$dbprefix}courses
    ON {$dbprefix}courses.id={$dbprefix}evaluations.courseId
    WHERE {$dbprefix}evaluations.closed='1' AND {$dbprefix}evaluations.form='local'
    AND {$dbprefix}evaluations.semester='$semester' AND {$dbprefix}evaluations.student in ($students)
    GROUP BY {$dbprefix}evaluations.timestamp,{$dbprefix}evaluations.student;");
  if($db->result){
    foreach($db->result as $elem){
      $result[]=array("id"=>$elem['id'],"title"=>decrypt_vwpp($elem['title']),"professor"=>decrypt_vwpp($elem['professor']));
    }
  }
  usort($result,"cmp_title");
}

elseif($form=="internship"){
  $db=new db();
  $db->select("evaluations","*","closed='1' AND semester='$semester' AND form='internship' AND student in ($students)","GROUP BY timestamp,student");
  $result=$db->result;
}

elseif($form=="tutoring" or $form=="linguistic" or $form=="method"){
  $db=new db();
  $db->select("evaluations","*","closed='1' AND semester='$semester' AND form='$form' AND student in ($students)","GROUP BY timestamp,student");
  $result=$db->result;
}

//	University
elseif($form=="univ"){
  $db=new db();
  $db->query("SELECT * FROM {$dbprefix}evaluations
  WHERE {$dbprefix}evaluations.closed='1' AND {$dbprefix}evaluations.form='univ'
  AND {$dbprefix}evaluations.semester='$semester' AND {$dbprefix}evaluations.student in ($students)
  GROUP BY {$dbprefix}evaluations.timestamp,{$dbprefix}evaluations.student;");

  $u=new univ4();
  $u->fetchAllStudents();
  $univ=$u->elements;

  if($db->result){
    foreach($db->result as $elem){
      foreach($univ as $elem2){
	if($elem2['id']==$elem['courseId']){
	  $result[]=array("id"=>$elem['id'],"cm_name"=>$elem2['nom'],"cm_prof"=>$elem2['prof']);
	  break;
	}
      }
    }
  }
  usort($result,"cmp_title");
}

elseif($form=="program"){
  $db=new db();
  $db->select("evaluations","*","closed='1' AND semester='$semester' AND form='program' AND student in ($students)","GROUP BY timestamp,student");
  $result=$db->result;
}



echo "<h3>Evaluations for $semester</h3>\n";
echo "<a href='/evaluations/home' style='margin-left:30px;'>All evaluations</a>\n";

if($form=="program"){
  echo "<h3 style='margin-bottom:0px;'>Program Evaluations</h3><ul style='margin-left:20px;'>";
  foreach($result as $elem){
    echo "<li><a href='/evaluation/program/{$elem['id']}'>Program Evaluation ({$elem['id']})</a></li>\n";
  }
  echo "</ul>\n";
}
elseif($form=="local"){
  echo "<h3 style='margin-bottom:0px;'>VWPP Courses Evaluations</h3><ul>";
  foreach($result as $elem){
    echo "<li style='margin-left:20px;'><a href='/evaluation/local/{$elem['id']}'>{$elem['title']}, {$elem['professor']} ({$elem['id']})</a></li>\n";
  }
  echo "</ul>\n";
}
elseif($form=="univ"){
  echo "<h3 style='margin-bottom:0px;'>University Courses Evaluations</h3><ul style='margin-left:20px;'>";
  foreach($result as $elem){
    echo "<li style='margin-left:20px;'><a href='/evaluation/univ/{$elem['id']}'>{$elem['cm_name']}, {$elem['cm_prof']} ({$elem['id']})</a></li>\n";
  }
  echo "</ul>\n";
}
elseif($form=="tutoring"){
  echo "<h3 style='margin-bottom:0px;'>Tutorats Evaluations</h3><ul style='margin-left:20px;'>";
  foreach($result as $elem){
    echo "<li style='margin-left:20px;'><a href='/evaluation/tutoring/{$elem['id']}'>Tutorats Evaluation ({$elem['id']})</a></li>\n";
  }
  echo "</ul>\n";
}
elseif($form=="linguistic"){
  echo "<h3 style='margin-bottom:0px;'>Ateliers Linguistiques</h3><ul style='margin-left:20px;'>";
  foreach($result as $elem){
    echo "<li style='margin-left:20px;'><a href='/evaluation/linguistic/{$elem['id']}'>Ateliers Linguistiques ({$elem['id']})</a></li>\n";
  }
  echo "</ul>\n";
}
elseif($form=="method"){
  echo "<h3 style='margin-bottom:0px;'>Ateliers M&eacute;thodologiques</h3><ul style='margin-left:20px;'>";
  foreach($result as $elem){
    echo "<li style='margin-left:20px;'><a href='/evaluation/method/{$elem['id']}'>Ateliers M&eacute;thodologiques ({$elem['id']})</a></li>\n";
  }
  echo "</ul>\n";
}
elseif($form=="internship"){
  echo "<h3 style='margin-bottom:0px;'>Internship Evaluations</h3><ul>";
  foreach($result as $elem){
    echo "<li style='margin-left:20px;'><a href='/evaluation/internship/{$elem['id']}'>Internship Evaluation ({$elem['id']})</a></li>\n";
  }
  echo "</ul>\n";
}

require_once "footer.php";
?>
