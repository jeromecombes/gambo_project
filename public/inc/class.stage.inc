<?php

class stage{

  public $elements=array();

  public function fetchAll($univ=null, $semester=null) {
    $s=new student();
    $s->fetchAll($univ);
    $students=$s->elements;
    $studentsTab=array();
    if(is_array($students))
    foreach($students as $elem){
      $studentsTab[]=$elem['id'];
    }

    $tab=array();
    $db=new db();
    $db->select("stages","*","semester='$semester'");
    if($db->result){
      foreach($db->result as $elem){
	if(in_array($elem['student'],$studentsTab)){
	  $stage=decrypt_vwpp($elem['stage'],$elem['student']);
	  $notes=$elem['notes']?decrypt_vwpp($elem['notes'],$elem['student']):null;
	  $notes2=str_replace("\n","<br/>",$notes);
	  $lastname=$students[$elem['student']]['lastname'];
	  $firstname=$students[$elem['student']]['firstname'];
	  $tab[$elem['student']]=array("stage"=>$stage,"id"=>$elem['id'],"lock"=>$elem['lock'],
	  "notes"=>$notes,"notes2"=>$notes2,"lastname"=>$lastname,"firstname"=>$firstname);
	}
      }
    }
    $this->elements=$tab;
  }

}
?>
