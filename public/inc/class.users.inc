<?php

include_once "config.php";

class user{
  public $auth=false;
  public $elements=array();
  public $password=null;
  public $token=null;

  function fetch($id){
    $db=new db();
    $db->select("users","*","id='$id'");
    $this->elements=$db->result[0];
  }

  function fetchAll(){
    $db=new db();
    $db->select("users");
    $this->elements=$db->result;
  }

  function fetchUsersAlerts(){
    $db=new db();
    $db->select("users","*","alerts=1");
    if($db->result){
      foreach($db->result as $elem){
	$this->elements[]=$elem['email'];
      }
    }
  }

    function login()
    {
        $auth = false;

        $db=new db();
        $db->select("users","*","token='{$this->token}'");

        $id = $db->result[0]['id'];
        $password_db = $db->result[0]['password'];

        // If password is hashed with md5, convert it with password_hash/bcrypt to enhance security and to make it compatible with Laravel
        if (strlen($password_db) == 32) {
            if ($password_db == $this->password) {
                $new_password = password_hash($this->cleared_password,PASSWORD_BCRYPT);
                $db2 = new db();
                $db2->update('users', "`password` = '$new_password', `name`='{$db->result[0]['email']}'", "`id` = '$id'");
                $auth = true;
            }
        } else {
            if (password_verify($this->cleared_password, $password_db)) {
                $auth = true;
            }
        }

        if($auth){
            $_SESSION['vwpp']['login']=$this->login;
            $_SESSION['vwpp']['login_id'] = $id;
            $_SESSION['vwpp']['access']=unserialize($db->result[0]['access']);
            $_SESSION['vwpp']['category']="admin";
            $_SESSION['vwpp']['login_univ']=$db->result[0]['university'];
            $_SESSION['vwpp']['login_name']=$db->result[0]['firstname']." ".$db->result[0]['lastname'];
            $_SESSION['vwpp']['language']=$db->result[0]['language'];
            $_SESSION['vwpp']['email']=$db->result[0]['email'];
            $this->auth=true;
        }
    }

  function setToken($email){
    $this->token=md5($email);
  }


  function update($data){
    $id=$data['id'];
    unset($data['id']);

    $data2=array();
    $keys=array_keys($data);
    foreach($keys as $key){
      $set[]="$key=:$key";
      $data2[":$key"]=$data[$key];
    }
    $set=join(",",$set);
    $db=new dbh();
    $db->prepare("UPDATE `users` SET $set WHERE `id`='$id';");
    $db->execute($data2);
  }


/*
  function user(){

  }

  function add($data){


  }
*/










}

?>
