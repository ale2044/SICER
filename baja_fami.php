<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}

$user = $_SESSION ["user"];

$dniE = $_POST ["dniE"];

$fletf = $_POST['hfletf']; 
$fdele = $_POST['hfdele']; 
$fempr = $_POST['hfempr']; 
$zona = $_POST['hzona']; 
$nafi = $_POST['hnafi']; 
$claveempresa = $_POST['hclaveempresa']; 
$cuiltitu = $_POST['hcuiltitu'];
$cuitempresa = $_POST['hcuitempresa'];
$unificamutual = $_POST['hunificamutual'];
$forde = $_POST['hforde'];
$apelfami = $_POST['hapelfami'];
$ftdoc = $_POST['hftdoc']; 
$sexo = $_POST['hsexo']; 
$fechaingos = $_POST['hfechaingos']; 
$fechabajasi = $_POST['hfechabajasi'];
$fpare = $_POST['hfpare']; 
$fvenc = $_POST['hfvenc']; 
$nivelest = $_POST['hnivelest']; 
$aniolectivo = $_POST['haniolectivo']; 
$venfamcargo = $_POST['hvenfamcargo']; 
$vencertdesemp = $_POST['hvencertdesemp']; 
$fcbaj = $_POST['hfcbaj']; 
$bajasi = $_POST['htsindi']; 
$fzafi = $_POST['hfzafi']; 
$ffnac = $_POST['hffnac']; 
$fndoc = $_POST['hfndoc']; 
$fmcre = $_POST['hfmcre']; 
$fmcon = $_POST['hfmcon']; 
$fmpra = $_POST['hfmpra']; 
$cargado = $_POST['hcargado'];
$retafi = $_POST['hretafi']; 
$retdel = $_POST['hretdel']; 
$secdel = $_POST['hsecdel']; 
$ftdis = $_POST['hftdis']; 
$ftpat = $_POST['hftpat']; 
$ffvenpat = $_POST['hffvenpat']; 
$f_pmivto = $_POST['hf_pmivto']; 
$ffentcre = $_POST['hffentcre']; 
$fapno = $_POST['hfapno']; 
$usuario = $_POST['husuario']; 
$hapadjobso = $_POST['hhapadjobso'];
$motivohab = $_POST['hmotivohab']; 
$inhrefvenobsoc = $_POST['hinhrefvenobsoc'];
$ultpagmutual = $_POST['hultpagmutual'];
$ips = $_POST['hips'];
$motivomodifica = $_POST['hmotivomodifica']; 
$mutual = $_POST['hfmutual'];
$estciv = $_POST['hestciv'];
$nacional = $_POST['hnacional'];
$cuilfami = $_POST['hcuilfami'];
$nomfami = $_POST['hnomfami'];

$fechabajaos = $_POST["hfechabajaos"];
$fechabajamu = $_POST["hfechabajamu"];
$tosoc = $_POST["htosoc"];
$tmut = $_POST["htmut"];
$fechaingsi = $_POST["hfechaingsi"];
$fechaingmu = $_POST["hfechaingmu"];
$f_estadoini = $_POST["hf_estadoini"];
$f_estadovto = $_POST["hf_estadovto"];
$descest = $_POST["hdescest"];
$f_discini = $_POST["hf_discini"];
$disc = $_POST["hdisc"];
$discvto = $_POST["hf_discvto"];
$descdisc = $_POST["hdescdisc"];
$docpend = $_POST["hdocpend"];
$otrodomi = $_POST["hotrodomi"];
$pcifami = $_POST["hpcifami"];
$dtofami = $_POST["hdtofami"];
$localfami = $_POST["hlocalfami"];
$domifami = $_POST["hdomifami"];
$pmi = $_POST["hpmi"];

$sqlBusca = "select FNDOC from famiba where FNDOC = '$dniE'";
$resultBusca = mysql_query ( $sqlBusca );

if ( mysql_num_rows ( $resultBusca ) != 1 ) { $alerta = 'noexiste_bajafami'; header ( "Location: menu.php?alerta=$alerta" ); } else {

	$fecha_si = '0000-00-00';
	$fecha_os = '0000-00-00';
	$fecha_mu = '0000-00-00';

	$marcasi = '';
	$marcaos = '';
	$marcamu = '';

	$band = '0';
	}

if ($_POST['todo'] == 'todo'){
	$fecha_si = $_POST['fechatodo'];
	$fecha_os = $_POST['fechatodo'];
	$fecha_mu = $_POST['fechatodo'];

	$marcasi = '*';
	$marcaos = '*';
	$marcamu = '*';

	$band = '1';
	}

	else{
	
		if ($_POST['sindi'] == 'sindi'){
			$fecha_si = $_POST['fechasin'];
			$marcasi = '*';
			$band = '1';
			}

		if ($_POST['os'] == 'os'){
			$fecha_si = $_POST['fechaos'];
			$marcaos = '*';
			$band = '1';
			}

		if ($_POST['mutual'] == 'mutual'){
			$fecha_si = $_POST['fechamutual'];
			$marcamu = '*';
			$band = '1';
			}
		}

if ($band == '0'){ $alerta = 'noselecciono'; header ( "Location: menu.php?alerta=$alerta" ); } 
else {
	
	$sql = "UPDATE famiba SET 
	FechaBajaSI = '$fecha_si',
	FechaBajaOS = '$fecha_os',
	FechaBajaMU = '$fecha_mu',
	TSINDI = '$marcasi',
	TOSOC = '$marcaos', 
	TMUT = '$marcamu',
	SICER = 'SI'
	WHERE FNDOC = '" . $dniE . "'";
	$agrega = mysql_query ( $sql );
}

	/*----- HISTORIAL DE FAMIBA -----*/
	$sqlHistorial = "insert into historial_famiba(FLETF, FDELE, FEMPR, FZONA, FNAFI, ClaveEmpresa, CUILTITU, CUITEmpresa, UnificaMutual, FORDE, APELFAMI, FTDOC, FSEXO, FechaIngOS, FechaBajaSI, FPARE, FVENC, NIVELEST, AnioLectivo, VenFamCargo, VenCertDesemp, FCBAJ, TSINDI, FZAFI, FFNAC, FNDOC, FMCRE, FMCON, FMPRA, CARGADO, RETAFI, RETDEL, SECDEL, FTDIS, FTPAT, FFVENPAT, F_PMIVTO, FFENTCRE, FAPNO, USUARIO, HaPaDjObSo, MotivoHab, InhRefVenObSoc, UltPagMutual, IPS, MotivoModifica, FMUTUAL, EstCiv, NACIONALIDAD, CUILFAMI, NOMFAMI, FechaBajaOS, FechaBajaMU, TOSOC, TMUT, FechaIngSI, FechaIngMU, F_ESTADOINI, F_ESTADOVTO, DESCEST, F_DISCINI, DISC, F_DISCVTO, DESCDISC, DOCPEND, OTRODOMI, PCIFAMI, DPTOFAMI, LOCALFAMI, DOMIFAMI, PMI) values ('$fletf', '$fdele', '$fempr', '$zona', '$nafi', '$claveempresa', '$cuiltitu', '$cuitempresa', '$unificamutual', '$forde', '$apelfami', '$ftdoc', '$sexo', '$fechaingos', '$fechabajasi', '$fpare', '$fvenc', '$nivelest', '$aniolectivo', '$venfamcargo', '$vencertdesemp', '$fcbaj', '$bajasi', '$fzafi', '$ffnac', '$fndoc', '$fmcre', '$fmcon', '$fmpra', '$cargado', '$retafi', '$retdel', '$secdel', '$ftdis', '$ftpat', '$ffvenpat', '$f_pmivto', '$ffentcre', '$fapno', '$usuario', '$hapadjobso', '$motivohab', '$inhrefvenobsoc', '$ultpagmutual', '$ips', '$motivomodifica', '$mutual', '$estciv', '$nacional', '$cuilfami', '$nomfami', '$fechabajaos', '$fechabajamu', '$tosoc', '$tmut', '$fechaingsi', '$fechaingmu', '$f_estadoini', '$f_estadovto', '$descest', '$f_discini', '$disc', '$discvto', '$descdisc', '$docpend', '$otrodomi', '$pcifami', '$dtofami', '$localfami', '$domifami', '$pmi')";

	$agregaHis = mysql_query ( $sqlHistorial );
	/* ---------------------------- */

	
	$alerta = 417; // El famliar fue dado de baja correctamente
	if (!mysql_error ()) {
		header ( "Location: menu.php?alerta=$alerta" );
	} else {
		echo " ERROR al grabar sus datos. Comuniquese con el administrador <br><br> - El error es:" . mysql_errno ();
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
		}
	}
	mysql_close ( );
?>