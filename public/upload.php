<?php
require_once "inc/config.php";
require_once "inc/class.doc.inc";

$d=new doc();
$d->update($_FILES['files'],$_POST['docs']);

$_SESSION['vwpp']['msg_fullstring'] = $d->msg;
$_SESSION['vwpp']['msg_success_fullstring'] = $d->msg_success;

header("Location: documents.php?error={$d->error}&msg=session_fullstring");

?>