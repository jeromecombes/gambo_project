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
