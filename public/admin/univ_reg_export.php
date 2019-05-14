<?php
// update : 2018-10-16

require_once "../inc/config.php";
require_once "../inc/class.univ_reg.inc";

access_ctrl(17);

$u=new univ_reg();
$u->fetchAll($_SESSION['vwpp']['login_univ']);
$tab=$u->elements;

usort($tab,"cmp_lastname");
$tab=array_map("entity_decode",$tab);
$tab=array_map("delete_rnt",$tab);

$year = substr($_SESSION['vwpp']['semestre'], -4);

$Fnm = "../data/univ_reg_{$_SESSION['vwpp']['semestre']}";

if($_GET['type']=="csv"){
  $separate="';'";
  $Fnm.=".csv";
}
else{
  $separate="\t";
  $Fnm.=".xls";
}

$lines=Array();

if($year >= 2019) {

  $title=array("Lastname","Firstname","Major 1","Minor 1","Major 2","Minor 2","Paris 3","Paris 4","Paris 7","Paris 12",
    "CIPh","Justification","Motivated by the calendar","Final Reg.","Diplome","Obtention","Pays","Ville","Etat","Etudes actuelles",
    "Handicap","Handicap, précisez");

} else {

  $title=array("Lastname","Firstname","Major 1","Minor 1","Major 2","Minor 2","Paris 3","Paris 4","Paris 7","Paris 12",
    "CIPh","Justification","Motivated by the calendar","Final Reg.","Diplome","Obtention","Pays","Ville","Etat","Etudes actuelles",
    "Faculté","Début des études","Domaine","Discipline voulue","Handicap","Handicap, précisez");
}

$lines[]=join($title,$separate);


if($year >= 2019) {
  foreach($tab as $elem){
    $cells=array($elem['lastname'],$elem['firstname']);
    
    $cells[]=$elem[0][10];
    $cells[]=$elem[0][12];
    $cells[]=$elem[0][11];
    for($i=13;$i<20;$i++){
      $cells[]=$elem[0][$i];
    }
    $cells[]=$elem[0][22];
    $cells[]=$elem[2]; 		//	Univ. Reg 3 (University)
    for($i=1;$i<6;$i++){
      $cells[]=$elem[0][$i];
    }
    $cells[]=$elem[0][9];
    $cells[]=$elem[0][7];
    $cells[]=$elem[0][8];

    $lines[]=join($cells,$separate);
  }

} else {
  foreach($tab as $elem){
    $cells=array($elem['lastname'],$elem['firstname']);
    
    for($i=1;$i<8;$i++){
      $cells[]=$elem[0][$i];
    }
    
    $cells[]=$elem[0][12];
    $cells[]=$elem[0][8];
    $cells[]=$elem[0][9];
    $cells[]=$elem[0][11];

    $cells[]=$elem[2]; 		//	Univ. Reg 3 (University)
    foreach($elem[1] as $elem2)  	//	Univ. Reg 2
      $cells[]=$elem2;
    $lines[]=join($cells,$separate);
  }
}

$inF = fopen($Fnm,"w");
foreach($lines as $elem){
  fputs($inF,$elem."\n");
}
fclose($inF);

header("Location: $Fnm");
?>
