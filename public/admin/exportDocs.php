<?php
/*
// Uncomment to export
include "../inc/config.php";
include "../inc/class.doc.inc";

ini_set('max_execution_time', 300);

$d=new doc();
$d->fetchAllStudents();

foreach($d->docs as $elem){
	$e = new doc();
	$e->exportDoc($elem['id']);
}

echo "<h3>Export documents for {$_SESSION['vwpp']['semester']}</h3>\n";

echo "<p>\n";
echo count($d->docs);
echo " documents exported on the server in the folder ".__DIR__."./../data/archives/";
echo "</p>\n";

echo "<p>Download files to your computer using an FTP client, then you can delete them from the database.</p>\n";

echo "<p><a href='deleteExportedFiles.php'>Delete exported files ?</a></p>\n";

echo "<p><a href='index.php'>Back</a></p>\n";
?>