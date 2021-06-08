<?php

//	Access control
function access_ctrl($ids){
  $ids=explode(",",$ids);
  $access=false;
  foreach($ids as $elem){
    if(in_array($elem,$_SESSION['vwpp']['access'])){
      $access=true;
    }
  }

  if(!$access){
    echo "<b style='color:red;'>Access denied</b><br/><br/><a href='javascript:history.back()'>Back</a>";
    exit;
   }
}

function cmp_lastname($a,$b){
  $a['lastname']=strtolower($a['lastname']);
  $a['firstname']=strtolower($a['firstname']);
  $b['lastname']=strtolower($b['lastname']);
  $b['firstname']=strtolower($b['firstname']);

  if($a['lastname']==$b['lastname']){
    if($a['firstname']==$b['firstname'])
      return 0;
    else
      return ($a['firstname'] < $b['firstname']) ? -1 : 1;
  }
  return ($a['lastname'] < $b['lastname']) ? -1 : 1;
}

function cmp_firstname($a,$b){
  if($a['firstname']==$b['firstname']){
    if($a['lastname']==$b['lastname'])
      return 0;
    else
      return ($a['lastname'] < $b['lastname']) ? -1 : 1;
  }
  return ($a['firstname'] < $b['firstname']) ? -1 : 1;
}

function cmp_institution2($a,$b){
  if(strtolower($a['institution']) == strtolower($b['institution'])){
    if(strtolower($a['institutionAutre']) == strtolower($b['institutionAutre'])){
      if(strtolower($a['discipline']) == strtolower($b['discipline'])){
        if(strtolower($a['niveau']) == strtolower($b['niveau'])){
	  if(strtolower($a['lien']) == strtolower($b['lien'])){
	    if(strtolower($a['code']) == strtolower($b['code'])){
	      return (strtolower($a['nom']) > strtolower($b['nom']));
	    }
	    return (strtolower($a['code']) > strtolower($b['code']));
	  }
	  return (strtolower($a['lien']) > strtolower($b['lien']));
	}
	return (strtolower($a['niveau']) > strtolower($b['niveau']));
      }
      return (strtolower($a['discipline']) > strtolower($b['discipline']));
    }
    return (strtolower($a['institutionAutre']) > strtolower($b['institutionAutre']));
  }
  return (strtolower($a['institution']) > strtolower($b['institution']));
}

function cmp_vwppChoices($a,$b){
  if($a['type']==$b['type']){
    if($a['code']==$b['code']){
      if($a['title']==$b['title']){
	if($a['nom']==$b['nom']){
	  if($a['professor']==$b['professor']){
	    if($a['choice']==$b['choice']){
	      if($a['studentLastname']==$b['studentLastname']){
		return ($a['studentFirstname']>$b['studentFirstname']);
	      }
	      return ($a['studentLastname']>$b['studentLastname']);
	    }
	    return ($a['choice']>$b['choice']);
	  }
	  return ($a['professor']>$b['professor']);
	}
	return ($a['nom']>$b['nom']);
      }
      return ($a['title']>$b['title']);
    }
    return ($a['code']>$b['code']);
  }
  return ($a['type']>$b['type']);
}

function cmp_schedule($a,$b){
  if($a['day']==$b['day']){
    if($a['debut']==$b['debut']){
      return ($a['fin']>$b['fin']);
    }
    else{
      return ($a['debut']>$b['debut']);
    }
  }
  else{
    return ($a['day']>$b['day']);
  }
}

function cmp_type($a,$b){
  if(strcasecmp($a['type'],$b['type'])==0){
    return(strcasecmp($a['nom'],$b['nom']));
  }
  return(strcasecmp($a['type'],$b['type']));
}

function cmp_title($a,$b){
  if($a['title']==$b['title']){
    if($a['professor']==$b['professor'])
      return 0;
    else
      return ($a['professor'] < $b['professor']) ? -1 : 1;
  }
  return ($a['title'] < $b['title']) ? -1 : 1;
}

function delete_rnt($n){
  if(is_array($n)){
    return array_map("delete_rnt",$n);
  }
  return str_replace(array("\r","\n","\t")," ",$n);
}

function entity_decode($n){
  if(is_array($n)){
    return array_map("entity_decode",$n);
  }
  else
    return html_entity_decode($n,ENT_QUOTES|ENT_IGNORE,"utf-8");
}

function decrypt_vwpp($crypted_token, $key=null)
{
    if($crypted_token === null){
        return null;
    }

    $decrypted_token = false;

    if(preg_match("/^(.*)::(.*)$/", $crypted_token, $regs)) {
        // decrypt encrypted string
        list(, $crypted_token, $enc_iv) = $regs;
        $enc_method = 'AES-128-CTR';
        $enc_key = openssl_digest($key.$GLOBALS['config']['crypt_key'], 'SHA256', TRUE);
        $decrypted_token = openssl_decrypt($crypted_token, $enc_method, $enc_key, 0, hex2bin($enc_iv));
        unset($crypted_token, $enc_method, $enc_key, $enc_iv, $regs);
    }
    return $decrypted_token;
}

function encrypt_vwpp($string, $key=null)
{
    if($string === null){
        return null;
    }

    $enc_method = 'AES-128-CTR';
    $enc_key = openssl_digest($key.$GLOBALS['config']['crypt_key'], 'SHA256', TRUE);
    $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($enc_method));
    $crypted_string = openssl_encrypt($string, $enc_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
    unset($string, $enc_method, $enc_key, $enc_iv);

    return $crypted_string;
}

function genTrivialPassword(){
    $characters[0] = 'abcdefghijklmnopqrstuvwxyz';
    $characters[1] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters[2] = '0123456789';

    $randstring = '';
    foreach($characters as $chars) {
        for ($i = 0; $i < 3; $i++) {
            $randstring .= $chars[rand(0, strlen($chars))];
        }
    }

    return $randstring;
}


    //	Make Inputs (radio, checkbox ...)	$input = array(data_id,type,array(values))
function input($input,$data,$td=false){
  $inputs=array();
  $td1=$td?"<td>":null;
  $td2=$td?"</td>":null;
  for($i=0;$i<count($input);$i++){
    for($j=0;$j<count($input[$i][2]);$j++){
      $input[$i][3][$j]=$data[$input[$i][0]]==$input[$i][2][$j]?"checked='checked'":null;
      $inputs[]="$td1<input type='{$input[$i][1]}' name='data[{$input[$i][0]}]' {$input[$i][3][$j]} value='{$input[$i][2][$j]}'/>{$input[$i][2][$j]}$td2\n";
    }
  }
  return $inputs;
}

function replace_name($tab){
  $tab['nom_en']=isset($tab['nom_en'])?$tab['nom_en']:$tab['nom'];
  return $tab;
}

function utf8_decode2($n){
  if(is_array($n)){
    return array_map("utf8_decode2",$n);
  }
  else{
    $result=mb_detect_encoding($n)=="UTF-8"?utf8_decode($n):$n;
    return $result;
  }
}

?>
