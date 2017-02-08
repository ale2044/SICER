<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION["user"];


$cuil=$_POST["cuilemple"];
$buff_cuil = $_POST['buff_cuilemple'];

$sqlBusca="select CUIL from titulares where CUIL='$buff_cuil'";
$resultBusca=mysql_query($sqlBusca);

if(mysql_num_rows($resultBusca)==1){
	
	/*Guarda dato anterior si no se modifica*/
	if(($_POST["t_afi"])=='null'){ $tipoAfi=utf8_encode( $_POST['buff_tipoafil']); }else utf8_encode($tipoAfi=$_POST['t_afi']);
	if(($_POST["tipoact"])=='null'){ $tipoAct=utf8_encode( $_POST['buff_act']); }else utf8_encode( $tipoAct=$_POST['tipoact']);
	if(($_POST["orig_os"])=='null'){ $origen_os=utf8_encode( $_POST['buff_origenos']); }else utf8_encode( $origen_os=$_POST['orig_os']);
	if(($_POST["listabajaEmple"])=='null'){	$motivobaja=utf8_encode( $_POST['bajaEbuffer']); }else $motivobaja=utf8_encode( $_POST['listabajaEmple']);
	
	$zona = $_POST['zona'];
	$tipoDocu = $_POST["dni"];
	$docum = $_POST["docu"];
	$VHaPaDjObSo = $_POST["HaPaDjObSo"];

	$buffer_fil = $_POST["buff_lugarfil"];
	$filial = $_POST["lugar"]; 
	if ( $filial == 'null'){ $l_filial = $buffer_fil; } else { $l_filial = $filial; }

	if (($_POST['cuitempre'])=='2'){
		$cuitEmpre = $_POST["buff_CUIT"];		
	}else $cuitEmpre = $_POST['cuitempre'];

	$sueldo = $_POST['sueldob'];
	$nomEmple = utf8_encode( $_POST["nomemple"] );
	$sex = $_POST["sexo"];
	$apelEmple = utf8_encode( $_POST["apelemple"] );
	$nacionalidad = utf8_encode( $_POST["nacion"] );
	$estCiv = utf8_encode( $_POST["est_civ"] );
	$domi = utf8_encode( $_POST["domicilio"] );
	$local = utf8_encode( $_POST["localidad"] );
	$dpt = $_POST["dpto"];
	$prov = $_POST["provincia"];	
	$codp = $_POST["cp"];
	$t1 = $_POST["tel1"];
	$t2 = $_POST["tel2"];
	$email = $_POST["mail"];
	$obserHab = trim($_POST["obser_hab"]);
	$nroafil = $_POST['nro_afi'];
	$nsindi = $_POST["tnsindi"];
	$discap=$_POST["tdis"];
	$pato = $_POST["tipopat"];
	$recibo = $_POST["xrecibo"];

	$f_pato = $_POST['fecha_vpato'];
	$buffer_pato =  $_POST['buff_pat'];
	if ($f_pato == ''){	$fvpato = $buffer_pato; } else  {$fvpato = $f_pato;}

	
	$familcargo=$_POST["famicargo"];
	$cantFlia=$_POST["cflia"];
	$nrmutual=$_POST["nmutual"];
	$fosoc = $_POST['fecha_obrasoc'];
 
 	$faltaSep = $_POST['fsepelio'];
	$buffer_asep =  $_POST['buff_sep'];
	if ($faltaSep == ''){ $altaSep = $buffer_asep; } else  {$altaSep = $faltaSep;}

 	$fbajaSep = $_POST['fbsepelio'];
	$buffer_bsep =  $_POST['buff_sepb'];
	if ($fbajaSep == ''){ $bajaSep = $buffer_bsep; } else  {$bajaSep = $fbajaSep;}

	
	if (isset($_POST["altasindicato"])){
					$tsindi='SI';
				} 
				else 	{ $tsindi = $_POST["buff_altasindicato"]; }

	if (isset($_POST["altaobrasocial"])){
					$tosoc='SI';
				} else { $tosoc = $_POST["buff_altaobrasocial"]; }

	if (isset($_POST["altamutual"])){
					$tmutual='SI';
				} else { $tmutual = $_POST["buff_altamutual"]; }

				//echo 'Sindicato: '.$tsindi.' Obra Social:'.$tosoc.' Mutual'.$tmutual;
	
	$obser=trim($_POST["obnserva01"]);
	$feModif = date("c");//Fecha real
	$obv = trim($_POST['obser']);
	
	/*Valores con el día de hoy para usar al comparar en las fechas buffer*/
	$d=Date('d');
	$m=Date('m');
	$Y=Date('Y');
	
	/*Guarda los datos de la fecha de nacimiento*/
	$fechahoy = date('Y').'-'.date('m').'-'.date('d');
	
	$nacimiento = $_POST['fecha_nac'];
	$buffer_nac =  $_POST['buff_nacimiento'];
	if ($nacimiento == ''){	$fnac = $buffer_nac; }	else  {$fnac = $nacimiento;}
	
	$dini = $_POST['fecha_iniact'];
	if ($dini == ''){ $diaIni = $_POST['buff_inic']; }	else  {$diaIni = $dini;}
	
	$fiemp = $_POST['fecha_ingm'];
	if ($fiemp == ''){ $fingempre = $_POST['buff_fing']; }	else  {$fingempre = $fiemp;}
		
	$fsin = $_POST['fecha_sindi'];
	if ($fsin == ''){ $fingsin = $_POST['buff_altasindi']; } else  {$fingsin = $fsin;}
	
	//$fbm = $_POST['fecha_bmutual'];
	//if ($fbm == ''){ $fbajamutual = $_POST['buff_fbmutual']; } else  {$fbajamutual = $fbm;}
	
	//$fbs = $_POST['fecha_bsindi'];
	//if ($fbs == ''){ $fbajasindi = $_POST['buff_fbsindi']; } else  {$fbajasindi = $fbs;}
	
	//$fbos = $_POST['fecha_bajaos'];
	//if ($fbos == ''){ $fbajaos = $_POST['buff_fbajaos']; } else  {$fbajaos = $fbos;}
	
	$fpmi = $_POST['fpmi'];
	if ($fpmi == ''){ $matinf = $_POST['buff_fpmi']; } else  {$matinf = $fpmi;}

	$fim = $_POST['fecha_mutu'];
	if ($fim == ''){ $faltmutual = $_POST['buff_altamut']; } else  {$faltmutual = $fim;}
	
	$fdd = $_POST['fecha_desde'];
	if ($fdd == ''){ $desemDesde = $_POST['buff_desde']; } else  {$desemDesde = $fdd;}
	
	$fha = $_POST['fecha_hasta'];
	if ($fha == ''){ $desemHasta = $_POST['buff_hasta']; } else  {$desemHasta = $fha;}
	
		/*TFECBAJM = '$fbajamutual',
	TFECBAJS = '$fbajasindi',
	TFECBAJAOS = '$fbajaos',*/

$sql="UPDATE titulares SET
	OBSHABER = '$obserHab',
	INIACT = '$diaIni',
	MAIL = '$email',
	TTELE2 = '$t2',
	PCIA = '$prov',
	DPTO = '$dpt',
	TLETT = '$tipoAfi',
	TZONA = '$zona',
	CUIL = '$cuil',
	CUITEMPRESA = '$cuitEmpre',
	TNAFI = '$nroafil',
	TAPEL = '$apelEmple',
	TNOMB = '$nomEmple',
	TTDOC = '$tipoDocu',
	TDOMI = '$domi',
	TLOCA = '$local',
	TTELE = '$t1',
	SueldoBasico = '$sueldo',
	TIPOACT = '$tipoAct',
	TSEXO = '$sex',
	TFING = '$fingempre',
	TFINS = '$fingsin',
	DESEMDESDE='$desemDesde',
	DESEMHASTA='$desemHasta',
	MOTBAJA='$motivobaja',
	TFNAC = '$fnac',
	TNDOC = '$docum',
	TCPOS = '$codp',
	ORIGENOS='$origen_os',
	FECHAMODIF = '$feModif',
	TNACI = '$nacionalidad',
	TESCI = '$estCiv',
	TOSOC = '$tosoc',
	FeAltSegSep = '$altaSep',
	FeBajSegSep = '$bajaSep',
	FeAltaObSoc = '$fosoc',
	TMUT='$tmutual',
	TFINMUTUAL='$faltmutual',
	NMUTUAL='$nrmutual',
	TFPMI='$matinf',
	TNSIN = '$nsindi',
	TFAMI='$cantFlia',
	TFAMCAR='$familcargo',
	USUARIO = '$user',
	RECIBO = '$recibo',
	MOTIVOMODIFICA='$obser',
	FFVENPAT = '$fvpato',
	TDISC = '$discap',
	TPATO='$pato',
	TSINDI='$tsindi',
	OBSERV='$obv',
	LUGARAFIL = '$l_filial',
	HaPaDjObSo = '$VHaPaDjObSo'
	
	WHERE CUIL = '".$buff_cuil."'";

	$agrega = mysql_query($sql);

	/*ACTUALIZACION DEL CUIL DEL EMPLEADO SOBRE LOS FAMILLIARES*/
$sqlBusca="select CUILTITU from famiba where CUILTITU='$buff_cuil'";
$resultBusca=mysql_query($sqlBusca);
$num = mysql_num_rows($resultBusca);

if ($num != 0){//si la persona no tiene un familiar no realiza el guardado...
	//nota: update 'nombre_tabla' set nombre_campo= replace(nombre_campo, 'string_a_encontrar', 'string_a_reemplazar');
	$sqlBuscaCuil="update famiba set CUILTITU=replace(CUILTITU, ".$buff_cuil.", ".$cuil.")";
	$resultBuscaCuil=mysql_query($sqlBuscaCuil);
			}
/*--------------------------------------------------------------------*/
	
	$alerta=412;//El empleado fue actualizado correctamente
	if (!mysql_error()){header("Location: menu.php?alerta=$alerta");} 
		else { echo " ERROR al grabar sus datos. Comuniquese con el administrador <br><br> - El error es:" .mysql_errno(); 
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
	
	mysql_close();}
}
?>