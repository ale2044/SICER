<?php
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION["user"];

echo "POST";
var_dump($_POST);

echo "GET";
var_dump($_GET);



	//$pcias=mysql_query("select * from titulares where TAPEL regexp "^a|A."");

//$pcias=mysql_query("select * from titulares where TAPEL regexp "^a|A."" );
	
//	$row=mysql_fetch_assoc($pcias);

//print 'hola: '.$row['TAPEL'].$row['TNOMB'];
//print 'hola: '.$row['TAPEL'].$row['TNOMB'];




}
?>