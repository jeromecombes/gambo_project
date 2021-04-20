<?php

require_once "class.student.inc";

class housing{
  public $studentLastname=null;
  public $studentFirstname=null;
  public $logement=array();
  public $logements=array();

  function __construct(){
    $this->semester = $_SESSION['vwpp']['semester'];
  }

  public function getLogement($id){
    $logement=array("lastname"=>null, "firstname"=>null, "address"=>null, "zipcode"=>null, "city"=>null,
      "email"=>null, "phonenumber"=>null, "cellphone"=>null, "lastname2"=>null, "firstname2"=>null,
      "email2"=>null, "cellphone2"=>null);

    if(!$id){
      $this->logement=$logement;
      return;
    }
    $db=new db();		// Select housing's info
    $db->select("logements","*","id=$id");
    if(!$db->result){
      $this->logement=$logement;
      return;
    }

    $logement=array();
    $this->getStudent($db->result[0]['id']);
    $logement=array("id"=>$db->result[0]['id'],"studentName"=>$this->studentLastname." ".$this->studentFirstname);

    $keys=array_keys($db->result[0]);
    foreach($keys as $key){
      if($key!="id"){
	$logement[$key]=decrypt_vwpp($db->result[0][$key]);
      }
    }
    $this->logement=$logement;
  }

  public function getLogements($university=null){
				// Select housing available for the semester
    $semester=substr($this->semester,-4);
    $semester.=substr($this->semester,0,6)=="Spring"?1:2;
    $db=new db();
    $db->select("logements_dispo","*","start<='$semester' AND (end >='$semester' OR end=0)");
    if(!$db->result)
      return;
    $ids=array();
    foreach($db->result as $elem){
      $ids[]=$elem['logement_id'];
    }
    $ids=join(",",$ids);	// List of housing available

    $db=new db();		// Select housing's info
    $db->select("logements","*","id IN ($ids)");
    if(!$db->result)
      return;

    $logements=array();
    $keys=array_keys($db->result[0]);
    foreach($db->result as $elem){
      $this->getStudent($elem['id']);
      $logements[$elem['id']]=array("id"=>$elem['id'],"studentName"=>$this->studentLastname." ".$this->studentFirstname);
      $logements[$elem['id']]["studentLastname"]=$this->studentLastname;
      $logements[$elem['id']]["studentFirstname"]=$this->studentFirstname;
      foreach($keys as $key){
	if($key!="id" and !is_numeric($key)){
	  $logements[$elem['id']][$key]=decrypt_vwpp($elem[$key]);
	}
      }
    }
    $this->logements=$logements;
  }

  function getStudent($logement){
    $table1="{$GLOBALS['dbprefix']}students";
    $table2="{$GLOBALS['dbprefix']}housing_affect";
    $db=new db();
    $db->query("select $table1.lastname as lastname, $table1.firstname as firstname FROM $table2
      INNER JOIN $table1 ON $table2.student=$table1.id
      WHERE $table2.logement=$logement AND $table2.semester='{$this->semester}';");
    if($db->result){
      $this->studentLastname=decrypt_vwpp($db->result[0]['lastname']);
      $this->studentFirstname=decrypt_vwpp($db->result[0]['firstname']);
    }
  }

  public function getStudentLogement($student){
    if(!$student)
      return;
    $db=new db();		// Select housing's info
    $db->select("housing_affect","*","student=$student AND semester like '{$this->semester}'");
    if(!$db->result)
      return;

    $this->getLogement($db->result[0]['id']);
  }

}

?>
