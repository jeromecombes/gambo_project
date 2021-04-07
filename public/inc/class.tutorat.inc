<?php

require_once "class.student.inc";

class tutorat{
  public $student=null;
  public $semester=null;
  public $elements=array();

  function __construct(){
    $this->semester=$_SESSION['vwpp']['semester'];
    $student=isset($_SESSION['vwpp']['student'])?$_SESSION['vwpp']['student']:null;
    $std_id=isset($_SESSION['vwpp']['std-id'])?$_SESSION['vwpp']['std-id']:null;
    $this->student=$std_id?$std_id:$student;
  }

  public function fetch(){
    $student=$this->student;
    $semester=$this->semester;

    $db=new db();
    $db->select("tutorat","*","student='$student' AND semester='$semester'");
    $data=$db->result[0];
    $data=array("tuteur"=>decrypt_vwpp($data['tuteur']),"day"=>decrypt_vwpp($data['day']),
	"start"=>decrypt_vwpp($data['start']),"end"=>decrypt_vwpp($data['end']), "lock"=>$data['lock'], "id"=>$data['id']);
    $this->elements=$data;
  }

  public function fetchALL($univ=null){	//	A continuer
    $semester=$this->semester;
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
    $db->select("tutorat","*","semester='$semester'");
    foreach($db->result as $elem){	//	A continuer
      $lastname=$students[$elem['student']]['lastname'];
      $firstname=$students[$elem['student']]['firstname'];
      $tab[$elem['student']]=array("tuteur"=>decrypt_vwpp($elem['tuteur']),"day"=>decrypt_vwpp($elem['day']),
	  "start"=>decrypt_vwpp($elem['start']),"end"=>decrypt_vwpp($elem['end']),"lastname"=>$lastname,"firstname"=>$firstname);
    }
    $this->elements=$tab;
  }


}

?>
