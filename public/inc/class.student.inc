<?php

require_once __DIR__."/class.mails.inc";

class student{
  public $auth=false;
  public $byUnivList=null;
  public $byUnivTab=array();
  public $error=false;
  public $messages=array();
  public $list=null;
  public $elements=array();
  public $welcomeMessage=array();
  public $id=null;
  public $email=null;
  public $password=null;
  public $token=null;
  public $semester;
  public $university=null;				// university filter

  public $cryptedFieldsNoID=array("lastname","firstname","email");
  public $cryptedFieldsMD5=array("token","password");
  public $cryptedFields=array("gender","dob","citizenship1","citizenship2","town","university",
      "university2","graduation","city","street","zip","state","country","contactlast","contactfirst","contactphone",
      "contactmobile","contactemail","cellphone","home_institution","placeOB","countryOB","frenchNumber","resultatTCF");

  function __construct(){
    if(array_key_exists("vwpp",$_SESSION) and array_key_exists("semester",$_SESSION['vwpp'])){
      $this->semester = $_SESSION['vwpp']['semester'];
    }
  }

  public function createPassword($sendMail=false){
    $this->fetchAll();
    $data=array();
    $users_data=array();
    if(is_array($this->list))
    foreach($this->list as $elem){
      $clearPassword=genTrivialPassword();
      $password = password_hash($clearPassword, PASSWORD_BCRYPT);
      $email = $this->elements[$elem]["email"];
      $token = md5($email);
      $this->elements[$elem]['clearPassword']=$clearPassword;
      $this->elements[$elem]['password']=$password;
      $data[]=array(":id"=>$elem,":password"=>$password,":token"=>$token);
      $users_data[]=array(":password"=>$password,":email"=>$email,":name"=>$email);
      if($sendMail){
	$this->createWelcomeMessage($elem);
	$mail=new vwppMail();
	$mail->addAddress($this->elements[$elem]["email"]);
	$mail->subject=$GLOBALS['config']['Messages-Welcome-Title'];
	$mail->body = $this->welcomeMessage[$elem];
	$mail->send();
	if($mail->error){
	  $this->error=true;
	  $this->messages[]=$mail->error;
	}
      }
    }
    $sql="UPDATE {$GLOBALS['config']['dbprefix']}students SET password=:password, token=:token WHERE id=:id;";
    $db=new dbh();
    $db->prepare($sql);
    foreach($data as $elem){
      $db->execute($elem);
    }

    $sql="UPDATE {$GLOBALS['config']['dbprefix']}users SET password=:password, name=:name WHERE email=:email;";
    $db=new dbh();
    $db->prepare($sql);
    foreach($users_data as $elem){
      $db->execute($elem);
    }
  }

  public function createWelcomeMessage($id){
    $email=$this->elements[$id]['email'];
    $firstname=$this->elements[$id]['firstname'];
    $lastname=$this->elements[$id]['lastname'];
    $password=$this->elements[$id]['clearPassword'];
    $message=$GLOBALS['config']['Messages-Welcome'];
    $message=str_replace(array("[FIRSTNAME]","[LASTNAME]","[EMAIL]","[PASSWORD]"),array($firstname,$lastname,$email,$password),$message);
    $this->welcomeMessage[$id]=$message;
  }

  public function fetchAll($university=null){
    $university=$university=="VWPP"?null:$university;
    $univReq=" AND university like '%$university%'";
    $db=new db();
    $db->select("students","*","semesters like '%\"{$this->semester}\"%' $univReq");
    if($db->result){
      $students=array();
//       $stdExcel=array();
      $keys=array_keys($db->result[0]);
      foreach($db->result as $elem){
	$students[$elem['id']]["semesters"]=unserialize($elem["semesters"]);
	if(!$students[$elem['id']]["semesters"])
	  $students[$elem['id']]["semesters"]=array($elem["semester"]);
	sort($students[$elem['id']]["semesters"]);
	$students[$elem['id']]["semestersJoin"]=join(", ",$students[$elem['id']]["semesters"]);
// 	$stdExcel[$elem['id']]["semestersJoin"]=html_entity_decode($students[$elem['id']]["semestersJoin"],ENT_QUOTES,"utf-8");
	$students[$elem['id']]["home_institution"]="toto".decrypt_vwpp($elem['home_institution'],$elem['id']);
	foreach($keys as $key){
	  if(in_array($key,array("id","token","password","semester")))
	    $students[$elem['id']][$key]=$elem[$key];
	  elseif(in_array($key,array("lastname","firstname","email")))
	    $students[$elem['id']][$key]=$elem[$key]?decrypt_vwpp($elem[$key]):null;
	  elseif(!is_numeric($key) and $key!="semesters")
	    $students[$elem['id']][$key]=$elem[$key]?decrypt_vwpp($elem[$key],$elem['id']):null;
// 	 if(!is_array($students[$elem['id']][$key]))
// 	  $stdExcel[$elem['id']][$key]=html_entity_decode($students[$elem['id']][$key],ENT_QUOTES,"utf-8");
	}
	if(empty($students[$elem['id']]["home_institution"]))
	  $students[$elem['id']]["home_institution"]=$elem['university'];
// 	$stdExcel[$elem['id']]["home_institution"]=html_entity_decode($students[$elem['id']]["home_institution"],ENT_QUOTES,"utf-8");

      }
    $this->elements=$students;
//     $this->elemExcel=$stdExcel;
    }
  }

  public function getByUniv($univ=null){
    $univ=$univ=="VWPP"?null:$univ;
    $db=new db();
    $db->select("students","*","university LIKE '%$univ%'");
    if($db->result){
      foreach($db->result as $elem){
	$this->byUnivTab[]=$elem['id'];
      }
      $this->byUnivList=join(",",$this->byUnivTab);
    }
  }

  public function delete($id){		// $id = int
    $tables=array("courses_attrib_rh","courses_choices","courses_ciph","courses_univ","housing","housing_accept","stages","univ_reg");
    foreach($tables as $table){
      $db=new db();
      $db->delete($table,"student=$id");
    }
    $db=new db();
    $db->delete("students","id=$id");

  }

}

?>
