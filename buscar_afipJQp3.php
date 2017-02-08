<?php
    session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
	$user = $_SESSION ["user"];
	//$dbHost = '127.0.0.1';
	//$dbUsername = 'root';
	//$dbPassword = 'admin';
	//$dbName = 'afiliaciones';
	
	//connect with the database
	//$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
	//get search term
	$searchTerm = $_GET['term'];
	//get matched data from skills table
	$query = /*$db->query*/
	mysql_query("SELECT * FROM actividades_afip WHERE ACTIVIDAD LIKE '%".$searchTerm."%' ORDER BY ACTIVIDAD ASC", $link);
	while ($row=mysql_fetch_assoc($query)/*$row = $query->fetch_assoc()*/) {
		$data[] =  $row['ACTIVIDAD']." - ".$row['DESCRIPCION'];
	}
	//return json data
	echo json_encode($data);
	}
?>
