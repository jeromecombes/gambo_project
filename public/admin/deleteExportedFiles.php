<?php
// Update : 2017-02-02

// Uncomment to delete documents
/*
include "../inc/config.php";
include "../inc/class.doc.inc";

ini_set('max_execution_time', 300);

$d=new doc();
$d->fetchAllStudents();

$nb=0;
foreach($d->docs as $elem){
  if( ! in_array($elem['rel'], array('Photo', 'TCF certificate', 'Transcript'))){
    $e = new doc();
    $e->student = $elem['student'];
    $e->delete($elem['id']);
    if($e->msg == 'delete_success'){
      $nb++;
    }
  }
}

echo "<h3>Delete documents for {$_SESSION['vwpp']['semester']}</h3>\n";

echo "<p>\n";
echo $nb;
echo " documents deleted in the database";
echo "</p>\n";

echo "<p><a href='index.php'>Back</a></p>\n";
*/

?>