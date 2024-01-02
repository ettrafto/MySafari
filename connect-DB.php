<!--Connecting-->
<?php
$databaseName = 'ETTRAFTO_labs';
$dsn = "mysql:host=webdb.uvm.edu;dbname=" . $databaseName;
$username = 'ettrafto_admin';
$password = '5MR2SPhz5ALr';

$pdo = new PDO($dsn, $username, $password)
?>
<!--Connection Complete-->