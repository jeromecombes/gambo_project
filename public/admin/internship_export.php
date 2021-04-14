<?php
// Update : 2015-10-14
require_once "../inc/config.php";
require_once "../inc/class.stage.inc";

access_ctrl(23);

$semester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_STRING);
$university = filter_input(INPUT_POST, 'university', FILTER_SANITIZE_STRING);

$s=new stage();
$s->fetchAll($university, $semester);
$s=$s->elements;

foreach($_POST['students'] as $elem){
  if($s[$elem])
    $tab[$elem]=$s[$elem];
}

usort($tab,"cmp_lastname");
$tab=array_map("entity_decode",$tab);
$tab=array_map("delete_rnt",$tab);


$Fnm = "../data/internship_" . str_replace(' ', '_', $_SESSION['vwpp']['semestre']);

if($_GET['type']=="csv"){
  $separate="';'";
  $Fnm.=".csv";
}
else{
  $separate="\t";
  $Fnm.=".xls";
}

$lines=Array();

$title=array("Lastname","Firstname","Internship");
$lines[]=join($title,$separate);

foreach($tab as $elem){
  $cells=array($elem['lastname'],$elem['firstname'],$elem["stage"]);
  $lines[]=join($cells,$separate);
}

$inF = fopen($Fnm,"w");
foreach($lines as $elem){
  fputs($inF,$elem."\n");
}
fclose($inF);

header("Location: $Fnm");
?>
