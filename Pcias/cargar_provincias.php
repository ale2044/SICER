<? 
include('conexion.inc.php');


$pcia= $_GET['pcia'];

$tabla = str_replace(" ","",$pcia);

$tabla = $tabla."_cp";

$depar=mysql_query("SELECT * FROM ".$tabla);

?><?
while( $row= mysql_fetch_assoc($depar)){
		echo '<option value="'.$row['Localidad'].'">'.$row['CP']." - ".$row['Localidad'].'</option>';
}
?>

