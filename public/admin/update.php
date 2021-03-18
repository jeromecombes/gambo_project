<?php

require_once "../inc/config.php";
require_once "../inc/class.student.inc";
require_once "../inc/class.users.inc";
require_once "../inc/class.mails.inc";

  //	ACL
access_ctrl($_POST['acl']);

//	Custom form
if(array_key_exists("input",$_POST)){
  $customInsert=array();
  $keys=array_keys($_POST['input']);
  foreach($keys as $elem){
    $customInsert[]=array("question"=>$elem,"student"=>$_POST['std_id'],"responses"=>$_POST['input'][$elem]);
  }
  unset($_POST['input']);

  if(!empty($keys)){
    $customDelete=join(",",$keys);
    $db=new db();
    $db->query("DELETE FROM {$dbprefix}responses WHERE student='{$_POST['std_id']}' AND question IN ($customDelete);");
  }

  $db=new db();
  $db->insert2("responses",$customInsert);
}

$table=$_POST['table'];
$page=$_POST['page'];


//	Original form
if(array_key_exists("data",$_POST)){
  $dataInsert=array();
  $keys=array_keys($_POST['data']);
  foreach($keys as $elem){
    $crypt_key=in_array($elem,array("lastname","firstname","email"))?null:$_POST['std_id'];
    $response=encrypt_vwpp(htmlentities(trim($_POST['data'][$elem]),ENT_QUOTES | ENT_IGNORE,"UTF-8"),$crypt_key);
    $dataInsert[]=array(":student"=>$_POST['std_id'],":semester"=>$_POST['semestre'],":question"=>$elem,":response"=>$response);
  }

  $db=new db();
  $db->delete($table,"student='{$_POST['std_id']}' AND semester='{$_POST['semestre']}'");

  $sql="INSERT INTO {$dbprefix}$table (student,semester,question,response) VALUES
    (:student, :semester, :question, :response);";
  $db=new dbh();
  $db->prepare($sql);
  foreach($dataInsert as $elem)
    $db->execute($elem);

}

$error=$error?1:0;
$msg=$error?"update_error":"update_success";
$page.="?error=$error&msg=$msg";

header("Location: $page");

?>
