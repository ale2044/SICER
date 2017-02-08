<?
session_start();
require_once("includes/connection.php");

$user = $_SESSION ["user"];

$cuitA = $_POST ["cuitempre"]; // viene del formulario alta empresa.
$cuitB = $_POST ["cuitempreAgre"]; // lo cargo manualmente.

if ($cuitA == '') {
	$cuitEmpre = $cuitB;
} else
{$cuitEmpre = $cuitA;}

$cuil = trim ( $_POST ["cuilemple"] );
//$sexo = $_POST ["sex"];
$nacionalidad = strtoupper ( $_POST ["nacio"] );
$apellido =utf8_encode( strtoupper ( $_POST ["apelemple"] ));
$nombre =utf8_encode( strtoupper ( $_POST ["nomemple"] ));
$tipo_docu = $_POST ["dni"];
$nro_docu = $_POST ["docu"];
$e_civil = $_POST ["civil"];

$nacimiento = $_POST['fecha_nacimiento'];
//$nacimiento = $_POST ["anioNac"] . "-" . $_POST ["mesNac"] . "-" . $_POST ["diaNac"];
$pcia = utf8_encode( $_POST ["pcia"]);


$localbuffer = strtoupper($_POST ["localidad"]);//localidad ej TARTAGAL4560
$codP = substr($localbuffer, -4); //Codigo Postal
$local = utf8_encode(substr($localbuffer, 0, -4));
$dpto = utf8_encode($_POST ["dpto_er"]);

/*echo "local buffer".$localbuffer;
echo "codigo postal".$codP;
echo "local".$local;*/

$domi = utf8_encode( strtoupper ( $_POST ["domicilio"] ));
$tel1 = $_POST ["tel1"];
$tel2 = $_POST ["tel2"];
$mail = $_POST ["mail"];
$observa = utf8_encode(strtoupper( trim ( $_POST ["obnserva01"] ) ) );
$actividad = $_POST ["tipoact"];
$ini_actividad = $_POST['fecha_afip'];
/*$ini_actividad = $_POST ["anioIni"] . "-" . $_POST ["mesIni"] . "-" . $_POST ["diaIni"];*/
$obs_haberes = utf8_encode( strtoupper ( trim ($_POST ["observa_haberes"]) ) );
$tipo = $_POST ["t_afi"];

$os = $_POST ["orig_os"];
if ($_POST["orig_os"]=='CAMIONERO'){
	$alta_OS = 'SI';
} else {$alta_OS = 'NO';}


if ($_POST ["aniod"] == false) {
	$desempleo_desde = "0000-00-00";
	$desempleo_hasta = "0000-00-00";
} else {
	$desempleo_desde = $_POST ["aniod"] . "-" . $_POST ["mesd"] . "-" . $_POST ["diad"];
	$desempleo_hasta = $_POST ["anioh"] . "-" . $_POST ["mesh"] . "-" . $_POST ["diah"];
}
$opcion_sindi = $_POST ["sindi"];

if ($opcion_sindi == "SI") {
	$alta_sindi = $_POST ["aniosin"] . "-" . $_POST ["messin"] . "-" . $_POST ["diasin"];
} else {
	$alta_sindi = "0000-00-00";
}

$opcion_mutual = $_POST ["mut"];

if ($opcion_mutual == "SI") {
	$alta_mutual = $_POST ["aniomut"] . "-" . $_POST ["mesmut"] . "-" . $_POST ["diamut"];
} else {
	$alta_mutual = "0000-00-00";
}

// $fami = $_POST["cargaflia"];

// if ( $fami == "SI" );

$hoy = Date ( "y-m-d" );
$fechadecarga = date("c");//Fecha de ingreso real al sistema sindi, fecha de carga

$sql = "insert into titudesdefilial (usuario, cuitempresa, cuil, nacionalidad, apellido, nombres, tipo_docu, nro_docu, nacimiento, estado_civil, pcia, dpto, localidad, codpost, domi, tel1, tel2, mail,
					observacion, tipo_actividad, inicio_actividad, observa_haberes, tipo_afil, origen_os, desem_desde, desem_hasta, sindicato, alta_sindi, mutual, alta_mutual, alta_en_filial, fecha_de_carga, tosoc)
		 		values ('$user','$cuitEmpre', '$cuil', '$nacionalidad', '$apellido', '$nombre', '$tipo_docu', '$nro_docu', '$nacimiento','$e_civil', '$pcia', '$dpto', '$local', '$codP', '$domi', '$tel1', '$tel2', '$mail',
					 '$observa', '$actividad', '$ini_actividad', '$obs_haberes', '$tipo', '$os', '$desempleo_desde', '$desempleo_hasta', '$opcion_sindi', '$alta_sindi', '$opcion_mutual','$alta_mutual', '$hoy', '$fechadecarga', '$alta_OS')";

$agrega = mysql_query ( $sql, $link );
$alerta = 410;

if (! mysql_error ()) 

{
	if (isset ( $_POST ["cargaflia"] )) {
		header ( "Location: familiarALTA.php?titular=$cuil" );
	} else {
		header ( "Location: menu.php?alerta=$alerta" );
	}
} else {
	echo " ERROR al grabar sus datos. Envie un mail al Administrador con el nro. de Error." . "<br><br>" . "El error es:" . mysql_errno () . " - " . mysql_error () . "<br>";
	switch (mysql_errno ()) {
		case 2003 :
			echo "No se puede conectar al servidor MySQL";
		case 2006 :
			echo "El servidor MySQL se ha apagado";
		case 2008 :
			echo "MySQL se quedó sin memoria";
		case 2013 :
			echo "Se perdió la conexión con el servidor MySQL durante la consulta";
		case 2047 :
			echo "incorrecto o desconocido protocolo";
		case 2048 :
			echo "No válido identificador de conexión";
		case 2049 :
			echo "Conexión mediante el protocolo de autenticación de edad se negaron (opción de cliente 'secure_auth' habilitado)";
		case 2051 :
			echo "Intento de leer la columna sin fila antes de buscar";
		case 2052 :
			echo "Preparado declaración no contiene metadatos";
		case 2053 :
			echo "Intento de leer una fila, mientras que no existe un conjunto de resultados asociado al error comunicado";
		case 2054 :
			echo "Esta función no se ha implementado todavía";
		case 2055 :
			echo "Se perdió la conexión al servidor MySQL, error del sistema";
		case 2056 :
			echo "Declaración cerrado indirectamente a causa de un precedente, Error de llamada";
		case 2057 :
			echo "El número de columnas del conjunto de resultados difiere del número de almacenamientos intermedios consolidados. Debe restablecer el comunicado, volver a vincular las columnas del conjunto de resultados y ejecutar la instrucción nuevo";
		case 2058 :
			echo "Ya está conectado. Utilice uno distinto para cada conexión.";
		case 2059 :
			echo "Autenticación complemento 'no se puede cargar'";
		case 2060 :
			echo "Hay un atributo con el mismo nombre";
		case 2061 :
			echo "Autenticación complemento";
		case 2062 :
			echo "Se ha detectado una llamada de función insegura.";
		case 1062 :
			echo "Ya esta de ALTA una empresa con igual clave";
	}
}

mysql_close ( $link );

?>