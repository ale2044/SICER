<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION ["user"];

$cuit_emp = $_POST["cuit_empre"];   
$cuit_buffer = $_POST["cuit_buffer"];

/* Busco desde un CuitBuffer por si hay que modificar el Cuit */
$sqlBusca="select SUSS from empresas where SUSS='$cuit_buffer'";

$resultBusca=mysql_query($sqlBusca);

if (mysql_num_rows($resultBusca)==1){

/* Metodo para dar de alta la empresa  */	
if (($alta = $_POST['alta'])=='si')
	{ $alta = '-'; }
elseif (($alta = $_POST['alta'])=='no') 
	{ $alta = '*'; } 


$clave = $_POST["clave"];
$nomb = $_POST ["nombr"];
$domi = $_POST ["domici"];
$provincia = $_POST["prov"];
$tel1 = $_POST ["tele1"];
$tel2 = $_POST ["tele2"];

/* Guarda dato anterior si no se modifico de CODIGO DE BAJA */
if(($_POST["bajaE"])=='null'){ $codb=$_POST['bajaEbuffer']; }else $codb=$_POST['bajaE'];

$local = $_POST ["locali"];
$codp = $_POST ["cp"];

$zon = $_POST ["zna"];
$szon = $_POST ["sz"];

/*Guarda dato anterior si no se modifico actividad ppal*/
if(($_POST["desc_afip"])=='null'){ $tact=$_POST['bufferactppal']; }else $tact=$_POST['desc_afip'];

/*Guarda dato anterior si no se modifico actividad secundaria*/
if(($_POST["desc_sub_afip"])=='null'){ $sact=$_POST['bufferactsec']; }else $sact=$_POST['desc_sub_afip'];

/*Guarda dato anterior si no se modifico actividad terciaria*/
if(($_POST["subII_act_afip"])=='null'){ $sIIact=$_POST['bufferactter']; }else $sIIact=$_POST['subII_act_afip'];

/*Guarda dato anterior si no se modifico actividad cuarternaria*/
if(($_POST["subIII_act_afip"])=='null'){ $sIIIact=$_POST['bufferactcuar']; }else $sIIIact=$_POST['subIII_act_afip'];

/*Guarda dato anterior si no se modifico actividad quinquenaria*/
if(($_POST["subIV_act_afip"])=='null'){ $sIVact=$_POST['bufferactquin']; }else $sIVact=$_POST['subIV_act_afip'];
$cantper = $_POST ["cantprs"];
$canemp = $_POST ["canmpos"];
$canempsii = $_POST ["cemps"];
$obs = trim($_POST ["obser"]);
$obsfc = trim($_POST ["obserfc"]);
$obsbaja = trim($_POST ["observb"]);
$fant = $_POST ["fantasii"];
$mail = $_POST ["email"];

/*Guarda dato anterior si no se modifico Datos del contador*/
if(($_POST["agregarEstudioContable"])=='2'){ $estcont=$_POST['bufferestudio']; }else $estcont=$_POST['agregarEstudioContable'];

/*Valores con el día de hoy para usar al comparar en las fechas buffer*/
$d=Date('d');
$m=Date('m');
$Y=Date('Y');

/*Guarda los datos de Ultimo periodo Obra social para guardarlos al no ser modificados*/
$dpos = $_POST["diapos"]; //Fecha de ingreso al sistema
$mpos = $_POST["mespos"];
$apos = $_POST["aniopos"];

if (($d != $dpos)or($m != $mpos)or($Y != $apos)){

	if (strlen($dpos) == 1) { $dpos = "0".$dpos; }
	if (strlen($mpos) == 1) { $mpos = "0".$mpos;}

	$ulperos = $apos."-".$mpos."-".$dpos;
} else {$ulperos = $_POST['fechaUPOSBuffer'];}

/*Guarda los datos de la FECHA DE INGRESO para guardarlos al no ser modificados*/
$dIng = $_POST["diaIngs"]; //Fecha de ingreso al sistema
$mIng = $_POST["mesIngs"];
$aIng = $_POST["anioIngs"];

if (($d != $dIng)or($m != $mIng)or($Y != $aIng)){

if (strlen($dIng) == 1) { $dIng = "0".$dIng; }//FECHA DE INGRESO
if (strlen($mIng) == 1) { $mIng = "0".$mIng;}

$fing = $aIng."-".$mIng."-".$dIng;
} else {$fing = $_POST['fechaIngBuffer'];}

/*Guarda los datos de Ultimo Pago Mutual para guardarlos al no ser modificados*/
$dpm = $_POST["diapm"]; 
$mpm = $_POST["mespm"];
$apm = $_POST["aniopm"];

if (($d != $dpm)or($m != $mpm)or($Y != $apm)){

	if (strlen($dpm) == 1) { $dpm = "0".$dpm; }
	if (strlen($mpm) == 1) { $mpm = "0".$mpm;}

	$ulpermut = $apm."-".$mpm."-".$dpm;
} else {$ulpermut = $_POST['fechaUPMBuffer'];}

/*Guarda los datos de Ultimo Periodo Sindical para guardarlos al no ser modificados*/
$dpes = $_POST["diapes"]; //Fecha de ingreso al sistema
$mpes = $_POST["mespes"];
$apes = $_POST["aniopes"];

if (($d != $dpes)or($m != $mpes)or($Y != $apes)){

	if (strlen($dpes) == 1) { $dpes = "0".$dpes; }//FECHA DE INGRESO
	if (strlen($mpes) == 1) { $mpes = "0".$mpes;}

	$ulpersi = $apes."-".$mpes."-".$dpes;
} else {$ulpersi = $_POST['fechaUPESBuffer'];}

/*Guarda los datos de la FECHA DE BAJA para guardar si no los modifica*/
$dInib = $_POST["diaBe"]; //Fecha de baja
$mInib = $_POST["mesBe"];
$aInib = $_POST["anioBe"];

if (($d != $dInib)or($m != $mInib)or($Y != $aInib)){

if (strlen($dInib) == 1) { $dInib = "0".$dInib; }//FECHA DE BAJA
if (strlen($mInib) == 1) { $mInib = "0".$mInib;}

$fb = $aInib."-".$mInib."-".$dInib;
} else {$fb = $_POST['fechaBajaBuffer'];}

/*Guarda los datos de la FECHA DE MODIFICACIÓN*/

$fmodif=date("c");

/*Guarda los datos de la FECHA DE INICIO DE ACTIVIDADES*/
$dInic = $_POST["diaInic"]; //Fecha de Inicio de actividades
$mInic = $_POST["mesInic"];
$aInic = $_POST["anioInic"];

if (($d != $dInic)or($m != $mInic)or($Y != $aInic)){

if (strlen($dInic) == 1) { $dInc = "0".$dInc; }//FECHA DE INICIO DE ACTIVIDADES
if (strlen($mInic) == 1) { $mInc = "0".$mInc;}

$fiact = $aInic."-".$mInic."-".$dInic;
} else {$fiact = $_POST['fIniActBuffer'];}

$sql = "UPDATE empresas SET
			BAJA='$alta',
			SUSS='$cuit_emp',
			PROVINCIA='$provincia',
			CLAVE='$clave',
			NOMBRE='$nomb',
			DOMICILIO='$domi',
			Telefono1='$tel1',
			Telefono2='$tel2',
			CODBAJA='$codb',
			LOCALIDAD='$local',
			CODPOST='$codp',
			FINGRESO='$fing',
			FBAJA='$fb',
			ZONA='$zon',
			SZONA='$szon',
			FECHMODIF='$fmodif',
			TIPACT='$tact',
			SUBACT='$sact',
			SUBACTII='$sIIact', 
			SUBACTIII='$sIIIact',
			SUBACTIV='$sIVact', 
			FINIACT='$fiact',
			CANTPERS='$cantper',
			USUARIO='$user',
 			CANEMPOS='$canemp',
			CANEMPSI='$canempsii',
			OBSERV='$obs',
			OBSERVFC='$obsfc',
			OBSERV_BAJA='$obsbaja',
			FANTASI='$fant',
			E_MAIL='$mail',
			ESTCONTA='$estcont',
			ULTPEROS='$ulperos',
			ULTPERSI='$ulpersi',
			ULTPERMUT='$ulpermut'
		
		WHERE SUSS = '" . $cuit_buffer . "'";

$agrega = mysql_query ( $sql );

/* update 'nombre_tabla' set nombre_campo= replace(nombre_campo, 'string_a_encontrar', 'string_a_reemplazar'); */
/*if(($solo_emp = $_POST["solo_empre"])!="si"){*/	
 $sqlBuscaCuit="update titulares set CUITEMPRESA=replace(CUITEMPRESA, ".$cuit_buffer.", ".$cuit_emp.")";
 $resultBuscaCuit=mysql_query($sqlBuscaCuit);
/*}*/

$alerta = 408; // datos grabados correctamente
if (! mysql_error ()) {
	
	header ( "Location: menu.php?alerta=$alerta" );
// 	echo ">> nombre: ".$nomb."<br>";
// 	echo $domi;
// 	echo $tel1;
// 	echo $tel2;
// 	echo $codb;
// 	echo $local;
// 	echo $codp;
// 	echo $fing;
// 	echo $fb;
// 	echo $zon;
// 	echo $empre;
// 	echo $szon;
// 	echo $cuitemp;
// 	echo $fmodif;
// 	echo $tact;
// 	echo $sact;
// 	echo $fiact;
// 	echo $x;
// 	echo $ultpag;
// 	echo $cantper;
// 	echo $user1;
// 	echo $claveun;
// 	echo $canemp;
// 	echo $canempsii;
// 	echo $obs;
// 	echo $obsbaja;
// 	echo $fctrol;
// 	echo $fant;
// 	echo $mail;
// 	echo $frecp;
// 	echo $estcont;
// 	echo $lapomini;
// 	echo $usuar;
// 	echo $ulpagos;
// 	echo $ulpersi;
// 	echo $ulpagsi;
} else {
	echo " ERROR al grabar sus datos. Comuniquese con el administrador <br><br> - El error es:" . mysql_errno ();
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

mysql_close ();}
}
?>