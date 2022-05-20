<?php
$servername = "localhost";
$username ="root";
$password = "";
$dbname = "mase";

try {
	$conn = new PDO ("mysql:host=$servername;dbname=$dbname;charset=utf8",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	echo "<button class='btn btn-success'></button>";	
} catch (Exception $e) {
	echo "<button class='btn btn-danger'></button> ".$e->getmessage();	
}
?>