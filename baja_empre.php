<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION["user"];

$cuitE=$_POST["cuitE"];

$sqlBusca="select SUSS from empresas where SUSS='$cuitE'";

$resultBusca=mysql_query($sqlBusca);

if (mysql_num_rows($resultBusca)==1){
	//"CUIT ENCONTRADO";
	$codbaja= $_POST["bajaE"];
	$diaba= $_POST["diaBe"];
	$mesba= $_POST["mesBe"];
	$anioba= $_POST["anioBe"];
	$observbaja= $_POST["observBaja"];
	
	$marca="*";
	
	if (strlen($diaba) == 1) { $dIni = "0".$diaba; }
	if (strlen($mesba) == 1) { $mIni = "0".$mesba; }
	
	$feBajaEmpre = $anioba."-".$mesba."-".$diaba;//FBAJA='2011-04-11',
	/*Trabajamos con la consulta UPDATE*/
	$sql="UPDATE empresas SET CODBAJA='$codbaja',
	FBAJA='$feBajaEmpre',
	OBSERV_BAJA='$observbaja',
	BAJA='$marca' WHERE SUSS = '".$cuitE."'";
	$agrega = mysql_query($sql);

	$alerta=409;//La empresa fue dada de baja correctamente
	if (!mysql_error()){ header("Location: menu.php?alerta=$alerta"); } 
		else { echo " ERROR al grabar sus datos. Comuniquese con el administrador <br><br> - El error es:" .mysql_errno(); 
		switch(mysql_errno())
		{
			case 2003: echo "No se puede conectar al servidor MySQL";
			case 2006: echo "El servidor MySQL se ha apagado";
			case 2008: echo "MySQL se qued� sin memoria";
			case 2013: echo "Se perdi� la conexi�n con el servidor MySQL durante la consulta";
			case 2047: echo "incorrecto o desconocido protocolo";
			case 2048: echo "No v�lido identificador de conexi�n";
			case 2049: echo "Conexi�n mediante el protocolo de autenticaci�n de edad se negaron (opci�n de cliente 'secure_auth' habilitado)";
			case 2051: echo "Intento de leer la columna sin fila antes de buscar";
			case 2052: echo "Preparado declaraci�n no contiene metadatos";
			case 2053: echo "Intento de leer una fila, mientras que no existe un conjunto de resultados asociado al error comunicado";
			case 2054: echo "Esta funci�n no se ha implementado todav�a";
			case 2055: echo "Se perdi� la conexi�n al servidor MySQL, error del sistema";
			case 2056: echo "Declaraci�n cerrado indirectamente a causa de un precedente, Error de llamada";
			case 2057: echo "El n�mero de columnas del conjunto de resultados difiere del n�mero de almacenamientos intermedios consolidados. Debe restablecer el comunicado, volver a vincular las columnas del conjunto de resultados y ejecutar la instrucci�n nuevo";
			case 2058: echo "Ya est� conectado. Utilice uno distinto para cada conexi�n.";
			case 2059: echo "Autenticaci�n complemento 'no se puede cargar'";
			case 2060: echo "Hay un atributo con el mismo nombre";
			case 2061: echo "Autenticaci�n complemento";
			case 2062: echo "Se ha detectado una llamada de funci�n insegura.";
			case 1062: echo "Ya esta de ALTA una empresa con igual clave";
		}
		}
	
		//	echo "<b>GRABO CORRECTAMENTE LOS SIGUIENTES DATOS: </br>";
		//	echo ">> CUIT: ".$cuitE."<br>";
		//	echo ">> Codigo de baja: ".$codbaja."<br>";
		//	echo ">> dia: ".$diaba."<br>";
		//	echo ">> mes: ".$mesba."<br>";
		//	echo ">> anio: ".$anioba."<br>";
		//	echo ">> marca: ".$marca."<br>";
		//	echo ">> fecha de baja: ".$feBajaEmpre."<br>";
	
	mysql_close();
	}	
		else{
			header("Location: menu.php");
} }
?>