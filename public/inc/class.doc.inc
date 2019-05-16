<?php

require_once "class.student.inc";

class doc{
  public $doc=null;
  public $docs=null;	// fetchAll
  public $error=0;
  public $msg="update_success";
  public $msg_success = array();
  public $name=null;
  public $name2=null;
  public $realname=null;
  public $rel=null;
  public $size=null;
  public $student=null;
  public $type=null;
  public $type2=null;
  private $documents_folder = __DIR__."/../../documents";

  function __construct(){
    $student=array_key_exists("student",$_SESSION['vwpp'])?$_SESSION['vwpp']['student']:null;
    $std_id=array_key_exists("std-id",$_SESSION['vwpp'])?$_SESSION['vwpp']['std-id']:null;
    $this->student=$std_id?$std_id:$student;
  }

  public function delete($id){
    $student=$this->student;

    $this->getLink($id);

    $db=new db();
    $db->delete("documents","id=$id AND student=$student");	// student added for security

    unlink($this->link);

    $this->msg="delete_success";
  }
  
  public function exportDoc($id){
    $this->fetch($id);
    if(!$this->doc){
    	return false;
    }
    
    $semester=str_replace(' ','-',$_SESSION['vwpp']['semester']);
    
  	$Fnm = __DIR__."/../data/archives/$semester-{$this->student}-{$this->name2}";
  	if(file_exists($Fnm)){
  		return false;
  	}
  	
	$inF = fopen($Fnm,"w");
	fputs($inF,$this->doc);
	fclose($inF);
  }

  public function fetch($id){
    $category=isset($_SESSION['vwpp']['category'])?$_SESSION['vwpp']['category']:null;

    // Si pas de session, return
    if(!$category){
      return;
    }
    // Si admin
    elseif($category=="admin"){
      // Verif droits d'accès aux documents
      if(!in_array(3,$_SESSION['vwpp']['access'])){
	return;
      }
      // Requête pour admin
      $query="id=$id";
    }
    // Si étudiant, requête pour étudiant
    else{
      $query="id=$id AND student={$this->student} AND adminOnly<>'1'";	// student added for security
    }
    
    $db=new db();
    $db->select("documents","*",$query);
    if(!$db->result){
      $this->error=1;
      $this->msg="access_denied";
      return false;
    }
    $student=$db->result[0]['student'];
    $this->student=$student;
    $this->type=decrypt($db->result[0]['type'],$student);
    $this->type2=decrypt($db->result[0]['type2'],$student);
    $this->size=decrypt($db->result[0]['size'],$student);
    $this->name=decrypt($db->result[0]['name'],$student);
    $this->name2=$this->name.".".$this->type2;
    $this->realname=decrypt($db->result[0]['realname'],$student);
    $this->rel=$db->result[0]['rel'];

    // Open and decrypt document
    $this->getLink($id);

    $doc = file_get_contents($this->link);
    $this->doc=decrypt($doc,$student);
  }

  public function fetchAll(){
    $student=$this->student;
    $db=new db();
    $db->select("documents","type,type2,size,name,realname,rel,student,id,timestamp,adminOnly","student='$student'");
    if($db->result){
      foreach($db->result as $elem){
	$type=decrypt($elem['type'],$student);
	$type2=decrypt($elem['type2'],$student);
	$size=decrypt($elem['size'],$student);
	$name=decrypt($elem['name'],$student);
	$name2=$name.".".$type2;
	$realname=decrypt($elem['realname'],$student);
	$rel=$elem['rel'];
	$doc=null;
	$id=$elem['id'];
	$timestamp=$elem['timestamp'];
	$adminOnly=$elem['adminOnly'];
	$this->docs[]=array("type"=>$type,"type2"=>$type2,"size"=>$size,"name"=>$name,"name2"=>$name2,"doc"=>$doc,"id"=>$id,"timestamp"=>$timestamp,"rel"=>$rel,"adminOnly"=>$adminOnly);
      }
    }
  }

  public function fetchAllStudents($university=null){
    require_once "class.student.inc";
    $s=new student();
    $s->fetchAll($university);
    $students=$s->elements;
    $studentsId=array(0);
    foreach($s->elements as $elem){
      $studentsId[]=$elem['id'];
    }

    $studentsId=join(",",$studentsId);
    $db=new db();
    $db->select("documents","type,type2,size,name,realname,rel,student,id,timestamp,adminOnly","student IN ($studentsId)");
    if($db->result){
      foreach($db->result as $elem){
	$type=decrypt($elem['type'],$elem['student']);
	$type2=decrypt($elem['type2'],$elem['student']);
	$size=decrypt($elem['size'],$elem['student']);
	$name=decrypt($elem['name'],$elem['student']);
	$name2=$name.".".$type2;
	$realname=decrypt($elem['realname'],$elem['student']);
	$rel=$elem['rel'];
	$doc=null;
	$id=$elem['id'];
	$timestamp=$elem['timestamp'];
	$adminOnly=$elem['adminOnly'];
	$lastname=$students[$elem['student']]['lastname'];
	$firstname=$students[$elem['student']]['firstname'];
//	Ajouter Lastname, Firstname
	$this->docs[]=array("type"=>$type,"type2"=>$type2,"size"=>$size,"name"=>$name,"name2"=>$name2,
	  "doc"=>$doc,"id"=>$id,"timestamp"=>$timestamp,"rel"=>$rel,"adminOnly"=>$adminOnly,
	  "student"=>$elem['student'],"lastname"=>$lastname,"firstname"=>$firstname);
      }
    }
  }

  private function getFolder($id){
    // Get link to document
    $db = new db();
    $db->select('documents', '`timestamp` as time2', "id=$id");
    $folder = date('Y/m', $db->result[0]['time2']);

    $this->folder = $this->documents_folder."/$folder";
  }

  private function getLink($id){
    // Get link to document
    $this->getFolder($id);
    $this->link = $this->folder."/$id";
  }

  public function update($files,$docs){
  
    $this->msg = array();
    $this->msg_success = array();
  
    $student=$this->student;
    $timestamp=mktime();
    $s=new student();
    $s->id=$student;
    $s->fetch();
    $studentName=$s->elements['lastname']."_".$s->elements['firstname'];

    foreach($GLOBALS['config']['documentType'] as $elem){
      $nbType[$elem]=0;
    }

    for($i=0;$i<count($docs);$i++){
      $rel2=$docs[$i][1];
      $rel2=empty($rel2)?"Other":$rel2;
      $rel3=$rel2;
      $rel2=str_replace(" ","_",$rel2);
      $rel2=str_replace("é","e",$rel2);
      if($nbType[$rel3]){
	$name=$rel2."_".$studentName."(".($nbType[$rel3]++).")";
      }
      else{
	$name=$rel2."_".$studentName;
	$nbType[$docs[$i][1]]=2;
      }

      $name = encrypt($name,$student);
      $tmp = !empty($files['name'][$i]) ? explode(".",$files['name'][$i]) : null;
      $type2 = encrypt(strtolower($tmp[count($tmp)-1]),$student);
      $rel = htmlentities($rel3,ENT_QUOTES|ENT_IGNORE,"utf-8");
      $realname = !empty($files['name'][$i]) ? encrypt($files['name'][$i],$student) : null;
      $type = !empty($files['type'][$i]) ? encrypt($files['type'][$i],$student) : null;
      $size = !empty($files['size'][$i]) ? encrypt($files['size'][$i],$student) : null;

      $adminOnly = empty($docs[$i][2]) ? 0 : 1 ;

      //	update database if file exists
      if($docs[$i][0]){

        if(!empty($files['name'][$i])){	// new upload : set size and type
        
            // First check, if no size, the file has not been uploaded
            if(empty($files['size'][$i])){
                $this->error = 1;
                $this->msg[] = "Can't upload the file \"{$files['name'][$i]}\" !";
                continue;
            }

            // Save the file
            if (! $this->save_file($files, $i, $docs[$i][0], $student, 'update', $timestamp)) {
                continue;
            }

            // Delete old file if upload succeded and old file is in another directory
            $new_path = $this->documents_folder.'/'.date('Y/m').'/'.$docs[$i][0];
            $this->getLink($docs[$i][0]);
            $old_path = $this->link;
            if ($new_path != $old_path) {
                unlink($old_path);
            }

	  $sql="update {$GLOBALS['dbprefix']}documents set student=:student,name=:name,rel=:rel,realname=:realname,type=:type,type2=:type2,size=:size,timestamp=:timestamp,adminOnly=:adminOnly WHERE id=:id;";
	  $update=array(":student"=>$student,":name"=>$name,":rel"=>$rel,":realname"=>$realname,":type"=>$type,":type2"=>$type2,":size"=>$size,":timestamp"=>$timestamp,":adminOnly"=>$adminOnly,":id"=>$docs[$i][0]);

        }
	else{			// else only update text infos
	  $sql="update {$GLOBALS['dbprefix']}documents set student=:student,name=:name,rel=:rel,adminOnly=:adminOnly WHERE id=:id;";
	  $update=array(":student"=>$student,":name"=>$name,":rel"=>$rel,":adminOnly"=>$adminOnly,":id"=>$docs[$i][0]);
	}
	$db=new dbh();
	$db->prepare($sql);
	$db->execute($update);
      }

      //		insert infos into database if new file
      elseif(!empty($files['name'][$i])){

        // First check, if no size, the file has not been uploaded
        if(empty($files['size'][$i])){
            $this->error = 1;
            $this->msg[] = "Can't upload the file \"{$files['name'][$i]}\" !";
            continue;
        }

        $insert=array(":student"=>$student,":name"=>$name,":rel"=>$rel,":realname"=>$realname,":type"=>$type,":type2"=>$type2,":size"=>$size,":timestamp"=>$timestamp,":adminOnly"=>$adminOnly);
        $sql="INSERT INTO {$GLOBALS['dbprefix']}documents (student,name,rel,realname,type,type2,size,timestamp,adminOnly) VALUES  (:student,:name,:rel,:realname,:type,:type2,:size,:timestamp,:adminOnly);";
        $db=new dbh();
        $db->prepare($sql);
        $db->execute($insert);

        $db = new db();
        $db->select('documents', 'id', "student=$student and timestamp=$timestamp");
        $id = $db->result[0]['id'];

        if (! $this->save_file($files, $i, $id, $student, 'insert', $timestamp)) {
            continue;
        }
      }
    }
    
    // Encrypt files
    $this->encrypt_files($student, $timestamp);
  }






    /**
     * @param files $files : uploaded files
     * @param int $i : the file index
     * @param int $id : document ID
     * @param int $student : student ID
     * @param string $type : insert or update
     */
    private function save_file($files, $i, $id, $student, $type, $timestamp)
    {
        // Save the file in a tmp directory
        $tmp_folder = $this->documents_folder.'/tmp/';
        $tmp_dest = $tmp_folder.$id;
        $final_folder = $this->documents_folder.'/S'.$student;
        $final_dest = $final_folder.'/'.$id;
        $filename = $files['name'][$i];

        if (! move_uploaded_file($files['tmp_name'][$i], $tmp_dest)) {

            $this->error = 1;
            $this->msg[] = "Can't move the file \"$filename\" in the temporary directory !";

            if ($type == 'insert') {
                $db = new db();
                $db->query("DELETE FROM `{$GLOBALS['dbprefix']}documents` WHERE `id ` = '$id';");
            }

            return false;

        } else {

            // Create directory
            if(!is_dir($final_folder)){ mkdir($final_folder, 0755, true); }

            // Save the file
            if (! rename($tmp_dest, $final_dest)) {
                $this->error = 1;
                $this->msg[] = "Can't move the file \"$filename\" in its directory ! (1)";
                return false;
            }

            $this->msg_success[] = "File \"$filename\" successfully uploaded !";
            if (is_file($tmp_dest)) {
                unlink($tmp_dest);
            }

            return true;
        }
        
    }


    /**
     * @param int $student : student ID
     */
    private function encrypt_files($student)
    {
        $tmp_folder = $this->documents_folder.'/tmp/';
        $student_folder = $this->documents_folder.'/S'.$student;
        
        // List the 
        $files = scandir($student_folder);
        
        if (is_array($files)) {
            foreach($files as $elem){

                // Orignal file
                $file = $student_folder.'/'.$elem;

                if (!is_file($file)) {
                    continue;
                }

                // Get the file timestamp
                $timestamp = filemtime($file);

                // Variables
                $tmp_encrypted = $tmp_folder.$elem.'_encrypted';
                $tmp_test = $tmp_folder.$elem.'_test';
                $final_folder = $this->documents_folder.'/'.date('Y/m', $timestamp).'/';
                $final_dest = $final_folder.$elem;

                // Original checksum
                $checksum1 = md5_file($file);

                // If checksum error, keep the file in the student folder without encryption
                if (empty($checksum1)) {
                    $this->error = 1;
                    $this->msg[] = "Can't check the file \"$elem\". It won't be encrypted !";

                    continue;
                }

                // Encrypt the file
                $document = encrypt(file_get_contents($file), $student);

                // Create the encrypted file
                file_put_contents($tmp_encrypted, $document);

                // Test
                $test = decrypt(file_get_contents($tmp_encrypted), $student);
                file_put_contents($tmp_test, $test);
                $checksum2 = md5_file($tmp_test);
                unlink($tmp_test);

                if ($checksum1 != $checksum2) {
                    $this->error = 1;
                    $this->msg[] = "Can't encrypt the file \"$elem\" ! It will be stored decrypted.";

                    return false;

                } else {

                    // Create directory
                    if(!is_dir($final_folder)){ mkdir($final_folder, 0755, true); }

                    if (! rename($tmp_encrypted, $final_dest)) {
                        $this->error = 1;
                        $this->msg[] = "Can't move the file \"$elem\" in its directory !";
                        return false;
                    }
                    
                    $this->msg_success[] = "File \"$elem\" successfully encrypted !";
                    unlink($file);
                }
            }
        }

        // Remove the student directory if empty
        // this doesn't work : the directory is removed after the encryption of the first file and even if the directory isn't empty. If we upload 2 files or more, only the first one will be encrypted and others are deleted.
//         if (count(glob($student_folder.'/*')) == 0) {
//             rmdir($student_folder);
//         }

    }

}

?>
