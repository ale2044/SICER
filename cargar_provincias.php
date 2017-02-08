<? 
session_start();
require_once("includes/connection.php");

$pcia= $_GET['pcia'];

$tabla = str_replace(" ","",$pcia);

$tabla = $tabla."_cp";

$depar=mysql_query("SELECT * FROM ".$tabla." ORDER BY Localidad ASC");
//$depar=mysql_query("SELECT * FROM ".$tabla);

while( $row= mysql_fetch_assoc($depar)){
		

	echo '<option value="'.$row['Localidad'].$row['CP'].'">'.$row['Localidad']." - ".$row['CP'].'</option>';		
}
?>