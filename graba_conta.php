<?
session_start();
require_once("includes/connection.php");

$user = $_SESSION["user"];

$longnEs = strlen($nEstudio);

$falta = 5 - $longnEs;

If ( $falta != 0) {
		$aux ="";
		for ( $i = 1 ; $i <= $falta ; $i ++) {
		$aux= $aux."0";
						}
		    }

$cuit = $_POST["cuitestudio"];

$nombEstudio = strtoupper($_POST["nomestudio"]);

$prov = strtoupper($_POST["pcia"]);

$localidad = strtoupper($_POST["departamento"]); //localidad ej TARTAGAL4560

$departamento = substr($localidad, 0, -4);

switch ($prov){
	case "BUENOS AIRES": $CODPROV=1; break;
	case "CORDOBA": $CODPROV=2; break;
	case "MENDOZA": $CODPROV=3; break;
	case "SANTA FE": $CODPROV=4; break;
	case "SAN JUAN": $CODPROV=5; break;
	case "CHUBUT": $CODPROV=6; break;
	case "SANTA CRUZ": $CODPROV=7; break;
	case "TUCUMAN": $CODPROV=8; break;
	case "SALTA": $CODPROV=9; break;
	case "ENTRE RIOS": $CODPROV=10; break;
	case "RIO NEGRO": $CODPROV=11; break;
	case "NEUQUEN": $CODPROV=12; break;
	case "CHACO": $CODPROV=13; break;
	case "CATAMARCA": $CODPROV=14; break;
	case "TIERRA DEL FUEGO": $CODPROV=15; break;
	case "JUJUY": $CODPROV=16; break;
	case "CORRIENTES": $CODPROV=17; break;
	case "LA PAMPA": $CODPROV=18; break;
	case "MISIONES": $CODPROV=19; break;
	case "LA RIOJA": $CODPROV=20; break;
	case "FORMOSA": $CODPROV=21; break;
	case "SANTIAGO DEL ESTERO": $CODPROV=22; break;
	case "SAN LUIS": $CODPROV=23; break;
	case "SURBAC": $CODPROV=24; break;
	case "RECOLECCION ROSARIO": $CODPROV=25; break;
	default; break;
}

$codP = substr($localidad, -4); //Codigo Postal

$subZ = substr($codP, 0, 2);

$domiEs = strtoupper($_POST["domicilio"]);

//$EstudioCont = $_POST["est_cont"];

$TelEs = $_POST["tel1"];
$mail =  $_POST["mail"];
$obser =  strtoupper($_POST["obser"]);

$clave = $subZ .$nEstudio.$zona;

$sql = "insert into estconta (D_ESTUDIO, D_DOMICI, N_CUIT, N_TELEFONO, e_mail, C_PROVIN, D_LOCAL, CodPost, OBSER)
		 values ('$nombEstudio', '$domiEs', '$cuit', '$TelEs', '$mail', '$CODPROV', '$departamento', '$codP', '$obser' )";
	

$agrega = mysql_query ($sql, $link);

$lugar = $_POST["sitio"];
$cuit_emp = $_POST["buff_cuit_empre"];

if (!mysql_error())

		{	if ($lugar=='editar'){header ("Location: empresaEDITAR.php?cuit_empre=$cuit_emp");}
			if ($lugar=='gestion'){header ("Location: empresaGESTION.php?empresa=$cuit_emp");}
			if ($lugar=='alta'){header ("Location: empresaALTA.php?cuit_empre=$cuit_emp");}
		}
		else
		{
			echo " ERROR al grabar sus datos. Comuniquese con el administrador <br><br> - El error es:" .mysql_errno();
			switch(mysql_errno())
			{
				case 2003: echo "No se puede conectar al servidor MySQL";
				case 2006: echo "El servidor MySQL se ha apagado";
				case 2008: echo "MySQL se quedó sin memoria";
				case 2013: echo "Se perdió la conexión con el servidor MySQL durante la consulta";
				case 2047: echo "incorrecto o desconocido protocolo";
				case 2048: echo "No válido identificador de conexión";
				case 2049: echo "Conexión mediante el protocolo de autenticación de edad se negaron (opción de cliente 'secure_auth' habilitado)";
				case 2051: echo "Intento de leer la columna sin fila antes de buscar";
				case 2052: echo "Preparado declaración no contiene metadatos";
				case 2053: echo "Intento de leer una fila, mientras que no existe un conjunto de resultados asociado al error comunicado";
				case 2054: echo "Esta función no se ha implementado todavía";
				case 2055: echo "Se perdió la conexión al servidor MySQL, error del sistema";
				case 2056: echo "Declaración cerrado indirectamente a causa de un precedente, Error de llamada";
				case 2057: echo "El número de columnas del conjunto de resultados difiere del número de almacenamientos intermedios consolidados. Debe restablecer el comunicado, volver a vincular las columnas del conjunto de resultados y ejecutar la instrucción nuevo";
				case 2058: echo "Ya está conectado. Utilice uno distinto para cada conexión.";
				case 2059: echo "Autenticación complemento 'no se puede cargar'";
				case 2060: echo "Hay un atributo con el mismo nombre";
				case 2061: echo "Autenticación complemento";
				case 2062: echo "Se ha detectado una llamada de función insegura.";
				case 1062: echo "Ya esta de ALTA una empresa con igual clave";
			}
		}
	
mysql_close($link);

?>