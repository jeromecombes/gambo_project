<?php

require_once "config.php";
require_once "class.student.inc";

class univ4{
  public $semester=null;
  public $student=null;
  public $elements=array();
  public $error=0;
  public $msg="update_success";
  public $sort=null;


  function __construct(){
    $student=array_key_exists("student",$_SESSION['vwpp'])?$_SESSION['vwpp']['student']:null;
    $std_id=array_key_exists("std-id",$_SESSION['vwpp'])?$_SESSION['vwpp']['std-id']:null;
    $this->student=$std_id?$std_id:$student;
    $this->semester=$_SESSION['vwpp']['semester'];
  }

  public function fetch($id){
    $data=array();

    $s=new student();
    $s->fetchAll();
    $students=$s->elements;

    $db=new db();
    $db->query("SELECT * FROM `courses_univ4` WHERE `id`='$id';");
    if(!empty($db->result)){
      $keys=array_keys($db->result[0]);
      foreach($keys as $key){
	$data[$key]=decrypt_vwpp($db->result[0][$key]);
      }
      $data['id']=$id;
      $data['semester']=$db->result[0]['semester'];
      $data['student']=$db->result[0]['student'];
      $data['lien']=$db->result[0]['lien'];
      $data['lock']=$db->result[0]['lock'];
      $data['note']=$db->result[0]['note'];
      $data['note2']=$data['note']==1?"Oui":"Non";
      $data['modalites1Text']=str_replace("\n","<br/>",$data['modalites1']);
      $data['modalites2Text']=str_replace("\n","<br/>",$data['modalites2']);
      $db=new db();
      $db->select("courses_univ4","*","lien='$id'");
      $data['liaison']=$db->result[0]?true:false;
      $data['studentLastname']=$students[$data['student']]['lastname'];
      $data['studentFirstname']=$students[$data['student']]['firstname'];
      $data['studentName']=$students[$data['student']]['lastname']." ".$students[$data['student']]['firstname'];
    }
    $this->elements=$data;
  }

}

?>
