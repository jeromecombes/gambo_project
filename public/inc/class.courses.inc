<?php

require_once "class.student.inc";
require_once "class.univ4.inc";

class courses{
  public $students_attrib=array();
  public $students_choices=array();
  public $course=array();

  public function courseName($id){
    $db=new db();
    $db->select("courses","*","id=$id");
    if(!$db->result)
      return false;

    $cryptFields=array("professor","title","nom","code");
    $course["id"]=$id;
    $course["type"]=$db->result[0]['type'];
    foreach($cryptFields as $field){
      $course[$field]=decrypt_vwpp($db->result[0][$field]);
    }
  $this->course=$course;
  }

  public function getStudents($id,$university=null){
    $s=new student();		//	Students list
    $s->fetchAll($university);
    $students=$s->elements;

    $students_attrib=array();
    $where="(writing1=$id or writing2=$id or writing3=$id or seminar1=$id or seminar2=$id or seminar3=$id)";
    $db=new db();
    $db->select("courses_attrib_rh","student",$where);
    if($db->result){
      foreach($db->result as $elem){
	if(!in_array($elem["student"],$students_attrib) and $students[$elem["student"]]){
	  $students_attrib[]=$students[$elem["student"]];
	}
      }
    }
    usort($students_attrib,"cmp_lastname");
    $this->students_attrib=$students_attrib;

    $students_choices=array();
    $where="(a1=$id or a2=$id)";
    $db=new db();
    $db->select("courses_choices","student",$where);
    if($db->result){
      foreach($db->result as $elem){			// verif array_key_exists : if student deleted
	if(!in_array($elem["student"],$students_choices) and array_key_exists($elem["student"],$students)){
	  $students_choices[]=array_merge($students[$elem["student"]],array("choice"=>"1<sup>st</sup>"));
	}
      }
    }
    $where="(b1=$id or b2=$id)";
    $db=new db();
    $db->select("courses_choices","student",$where);
    if($db->result){
      foreach($db->result as $elem){
	if(!in_array($elem["student"],$students_choices) and array_key_exists($elem["student"],$students)){
	  $students_choices[]=array_merge($students[$elem["student"]],array("choice"=>"2<sup>nd</sup>"));
	}
      }
    }
    $where="(c1=$id or c2=$id)";
    $db=new db();
    $db->select("courses_choices","student",$where);
    if($db->result){
      foreach($db->result as $elem){
	if(!in_array($elem["student"],$students_choices) and array_key_exists($elem["student"],$students)){
	  $students_choices[]=array_merge($students[$elem["student"]],array("choice"=>"3<sup>rd</sup>"));
	}
      }
    }
    $where="(d1=$id or d2=$id)";
    $db=new db();
    $db->select("courses_choices","student",$where);
    if($db->result){
      foreach($db->result as $elem){
	if(!in_array($elem["student"],$students_choices) and array_key_exists($elem["student"],$students)){
	  $students_choices[]=array_merge($students[$elem["student"]],array("choice"=>"4<sup>th</sup>"));
	}
      }
    }
    $where="(e2=$id)";
    $db=new db();
    $db->select("courses_choices","student",$where);
    if($db->result){
      foreach($db->result as $elem){
	if(!in_array($elem["student"],$students_choices) and array_key_exists($elem["student"],$students)){
	  $students_choices[]=array_merge($students[$elem["student"]],array("choice"=>"5<sup>th</sup>"));
	}
      }
    }

    usort($students_choices,"cmp_lastname");
    $this->students_choices=$students_choices;
  }

}
?>
