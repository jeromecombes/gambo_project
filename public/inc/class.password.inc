<?php

class password{
  public $currentPassword=null;
  public $id=null;
  public $email=null;
  public $error=false;
  public $messages=false;

  public function getPassword(){
    $db=new db();
    if($this->id)
      $db->select("students","password","id='{$this->id}'");
    else
      $db->select("users","password","token=md5('{$this->email}')");
    if(!$db->result)
      $this->error=true;
    else
      $this->currentPassword=$db->result[0]['password'];
  }
  
  public function changePassword($current,$new,$confirm){
    $this->getPassword();
    $error=1;
    if (!password_verify($current, $this->currentPassword)) {
      $msg="wrong_current_password";
    }
    elseif($new!=$confirm)
      $msg="passwords_dont_match";
    elseif(strlen($new)<6)
      $msg="password_too_short";
    else{
      $this->setPassword($new);
      if($this->error)
	$msg="change_password_error";
      else{
	$error=0;
	$msg="change_password_success";
      }
    }
    $this->error=$error;
    $this->messages=$msg;
  }

  public function setPassword($password){
    $password = password_hash($password, PASSWORD_BCRYPT);
    $db=new db();
    if ($this->id) {
      $db->update("students","password='$password'","id='{$this->id}'");

      $db2 = new db();
      $db2->select('students','email',"id='{$this->id}'");
      $email = decrypt_vwpp($db2->result[0]['email']);

      $db2 = new db();
      $db2->update("users","password='$password', name='$email'","email='$email'");

    } else {
      $db->update("users","password='$password'","token=md5('{$this->email}')");
    }
  }

}
?>