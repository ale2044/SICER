<?
session_start();
require_once("includes/connection.php");

$pcia= $_POST['pcia'];
$codp=$_POST['cp'];
$local=$_POST['localidad'];

$tabla = str_replace(" ","",$pcia);

$tabla = $tabla."_cp";

$depar=mysql_query("insert into ".$tabla."(CP, Localidad) values('$codp',UPPER('$local'))");

$alerta='correcto';

if (!mysql_error()){
	header ("Location: agregar_localidad.php?alerta=$alerta");
  				   }
else
{
	echo " ERROR al grabar sus datos. Comuniquese con el administrador <br><br> - El error es: " .mysql_errno();
	switch(mysql_errno())
	{
		case 2003: echo "No se puede conectar al servidor MySQL";
		case 2006: echo "El servidor MySQL se ha apagado";
		case 2008: echo "MySQL se quedó sin memoria";
		case 2013: echo "Se perdió la conexión con el servidor MySQL durante la consulta";
	}
}
mysql_close($link);
?>