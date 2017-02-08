<?
session_start();
require_once("includes/connection.php");

$user = $_SESSION["user"];

$cuitEmpre = $_POST["cuit_empre"];
$cuitEBuffer = $_POST["cuit_buffer"];

$prov = utf8_encode(strtoupper($_POST["pcia"]));
$nombEmpre = utf8_encode(strtoupper($_POST["nombre"]));
$localidad = utf8_encode(strtoupper($_POST["local"]));
$codP = strtoupper($_POST["cp"]);
$domiE = utf8_encode(strtoupper($_POST["domi"]));
$TelEmp = $_POST["tel1"];
$TelEmp2 = $_POST["tel2"];
$mail =  $_POST["email"];

//var_dump($_POST);

/*Guarda dato anterior si no se modifico actividad ppal*/
//antes estaba así if(($_POST["act_afipP"])=='null'){ $tipoact=$_POST['bufferactppal']; }else $tipoact=$_POST['act_afipP'];
if(($_POST["act_afipP"])==""){ $tipoact=$_POST['bufferactppal']; }else $tipoact = substr($_POST["act_afipP"], 0, 6);

/*Guarda dato anterior si no se modifico actividad secundaria*/
if(($_POST["act_afipS"])==""){ $sact=$_POST['bufferactsec']; }else $sact=substr($_POST['act_afipS'], 0, 6);

/*Guarda dato anterior si no se modifico actividad terciaria*/
if(($_POST["act_afipT"])==""){ $sIIact=$_POST['bufferactter']; }else $sIIact=substr($_POST['act_afipT'], 0, 6);

/*Guarda dato anterior si no se modifico actividad cuarternaria*/
if(($_POST["act_afipC"])==""){ $sIIIact=$_POST['bufferactcuar']; }else $sIIIact=substr($_POST['act_afipC'], 0, 6);

/*Guarda dato anterior si no se modifico actividad quinquenaria*/
if(($_POST["act_afipQ"])==""){ $sIVact=$_POST['bufferactquin']; }else $sIVact=substr($_POST['act_afipQ'], 0, 6);

/*Valores con el día de hoy para usar al comparar en las fechas buffer*/
$d=Date('d');
$m=Date('m');
$Y=Date('Y');

/*Guarda los datos de la FECHA DE INICIO DE ACTIVIDADES*/
$dInic = $_POST["diaInic"]; //Fecha de Inicio de actividades
$mInic = $_POST["mesInic"];
$aInic = $_POST["anioInic"];

if (($d != $dInic)or($m != $mInic)or($Y != $aInic)){

	if (strlen($dInic) == 1) { $dInic = "0".$dInic; }//FECHA DE INICIO DE ACTIVIDADES
	if (strlen($mInic) == 1) { $mInic = "0".$mInic;}

	$fiact = $aInic."-".$mInic."-".$dInic;
} else {$fiact = $_POST['fIniActBuffer'];}

$obser =  utf8_encode(strtoupper($_POST["obser"]));
$obserfc = utf8_encode(strtoupper($_POST["obserfc"]));

/*Guarda los datos de la FECHA DE INGRESO para guardarlos al no ser modificados*/
$dIng = $_POST["diaIngs"]; //Fecha de ingreso al sistema
$mIng = $_POST["mesIngs"];
$aIng = $_POST["anioIngs"];

if (($d != $dIng)or($m != $mIng)or($Y != $aIng)){

	if (strlen($dIng) == 1) { $dIng = "0".$dIng; }//FECHA DE INGRESO
	if (strlen($mIng) == 1) { $mIng = "0".$mIng;}

	$fing = $aIng."-".$mIng."-".$dIng;
} else {$fing = $_POST['fechaIngBuffer'];}

/*Guarda dato anterior si no se modifico Datos del contador*/
if(($_POST["agregarEstudioContable"])=='2'){ $estcontb=$_POST['bufferestudio']; }else $estcontb=$_POST['agregarEstudioContable'];

// $clave = $_POST["clave"];
$cantpers = $_POST["cantprs"];
$canperos = $_POST["canmpos"];
$canpersi = $_POST["cemps"];
$fantasia = utf8_encode($_POST["fantasii"]);

/*Fecha ultimo periodo OS*/
     //$ultpos = $_POST['fecha_pos'];
//$dpos = $_POST["diapos"];
//$mpos = $_POST["mespos"];
//$apos = $_POST["aniopos"];

//if (strlen($dpos) == 1) { $dpos = "0".$dpos; }
//if (strlen($mpos) == 1) { $mpos = "0".$mpos;}

//$ultpos = $apos."-".$mpos."-".$dpos;

/*Fecha ultimo periodo sindical*/
         //$ultpersi = $_POST["fecha_pes"];

//$dpes = $_POST["diapes"];
//$mpes = $_POST["mespes"];
//$apes = $_POST["aniopes"];

//if (strlen($dpes) == 1) { $dpes = "0".$dpes; }
//if (strlen($mpes) == 1) { $mpes = "0".$mpes;}

//$ultpersi = $apes."-".$mpes."-".$dpes;

/*Fecha ultimo periodo MUTUAL*/
    //$ultpm = $_POST['fecha_pm'];
//$dpm = $_POST["diapm"];
//$mpm = $_POST["mespm"];
//$apm = $_POST["aniopm"];

//if (strlen($dpm) == 1) { $dpm = "0".$dpm; }
//if (strlen($mpm) == 1) { $mpm = "0".$mpm;}

//$ultpm = $apm."-".$mpm."-".$dpm;

/*Fecha de ingreso real al sistema sindi desde filial*/
$fdecarga = $_POST["fcarga"];

/*Datos generados automaticamente. En este apartado se genera el número de empresa y la clave, 
iendo la clave 00-00numerodeempresa-zona(10 por entre rios)*/
$pcias = mysql_query("SELECT EMPRESA from empresas ORDER BY EMPRESA DESC LIMIT 1");

$row=mysql_fetch_assoc($pcias);
/*luego de buscar el último número (ultimo numero de empresa) sumo uno para tener el numero de la empresa real*/
$nroEmpre = $row['EMPRESA']+1;

$cuenta = strlen ( $nroEmpre );

switch ($cuenta) {
	case 1:
		$clave = '00-00000'.$nroEmpre.'-10';
		break;
	case 2:
		$clave = '00-0000'.$nroEmpre.'-10';
		break;
	case 3:
		$clave = '00-000'.$nroEmpre.'-10';
		break;
	case 4:
		$clave = '00-00'.$nroEmpre.'-10';
		break;
	case 5:
		$clave = '00-0'.$nroEmpre.'-10';
		break;
}

/*echo "cuenta:".$cuenta;
echo "clave".$clave; 
echo "nroEmpre: ".$nroEmpre;*/

$zona = $_POST['zna'];

$subZ = substr($codP, 0, 2);

$feIng = date("c");//Fecha de ingreso real al sistema sindi, fecha de carga.

/*Generar la nueva empresa*/
$sql = "insert into empresas (EMPRESA, CLAVE, FECHACARGA_FIL, NOMBRE, DOMICILIO, Telefono1, Telefono2, LOCALIDAD, 
		PROVINCIA, CODPOST, FINGRESO, ZONA, SZONA, SUSS, FECHMODIF, TIPACT, SUBACT, SUBACTII, SUBACTIII, SUBACTIV, FINIACT, 
		CANTPERS, CANEMPOS, CANEMPSI, OBSERV, OBSERVFC, FANTASI, E_MAIL, ESTCONTA, USUARIO)
		 values ('$nroEmpre', '$clave', '$fdecarga', '$nombEmpre', '$domiE', '$TelEmp', '$TelEmp2', '$localidad', '$prov', '$codP', '$fing', '$zona', 
				 '$subZ', '$cuitEmpre', '$feIng', '$tipoact', '$sact', '$sIIact', '$sIIIact', '$sIVact', '$fiact', '$cantpers', '$canperos', 
				 '$canpersi', '$obser', '$obserfc', '$fantasia', '$mail', '$estcontb', '$user')";

				 // como estaba antes ---  en el insert(, ULTPEROS, ULTPERSI, ULTPERMUT y en el values('$canpersi', '$obser', '$obserfc', '$fantasia', '$mail', '$estcontb', '$user', '$ultpos', '$ultpersi', '$ultpm')";
	
$agrega = mysql_query ($sql, $link);

$sqlFilial = "delete from empredesdefilial  where cuit=$cuitEBuffer";
$elimina = mysql_query ($sqlFilial, $link);

if (!mysql_error()){
		$alerta=208; 
		header ("Location: gestionar_empresa.php?alerta=$alerta");
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
           						case 2038: echo "No se puede abrir la memoria compartida";
           						case 2039: echo "No se puede abrir la memoria compartida; ningún caso, la respuesta recibida del servidor";
           						case 2040: echo "No se puede abrir la memoria compartida; servidor no ha podido asignar la asignación del archivo";
           						case 2041: echo "No se puede abrir la memoria compartida; servidor no ha podido conseguir puntero al archivo de asignación";
           						case 2042: echo "No se puede abrir la memoria compartida; el cliente no ha podido asignar la asignación del archivo";
           						case 2043: echo "No se puede abrir la memoria compartida; cliente no pudo obtener puntero al archivo de asignación";
           						case 2044: echo "No se puede abrir la memoria compartida; cliente no puede crear eventos";
           						case 2045: echo "No se puede abrir la memoria compartida; hay respuesta del servidor";
           						case 2046: echo "No se puede abrir la memoria compartida; no puede enviar la solicitud de evento de servidor";
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