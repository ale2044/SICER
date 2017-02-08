<?
session_start();
require_once("includes/connection.php");
include ("fciones/fcionEdad.php");

$user = $_SESSION["user"];

$usuariof = $_POST["usuario_filial"];
$cuilTitu = $_POST["cuiltitu"];
$cuilBuffer = $_POST["cuil_buffer"];

if ( $_POST['xrecibo']=='SI' ){ $recibo = 'SI'; } else{ $recibo = 'NO'; }

$cuitTitu = $_POST["cuittitu"];
$cuitEmpresa = $_POST["cuitempre"];

$nAfil = $_POST["nro_afi"];
$sbasico = $_POST["sueldobasico"];
$f_os = $_POST["fecha_os"];

	$altaSep = $_POST['fsepelio'];
 	$bajaSep = $_POST['fbsepelio'];

/*****GENERA AUTOMÁTICAMENTE EL NUMERO SINDICAL******/
$pcias = mysql_query ("SELECT TNSIN FROM titulares ORDER BY TNSIN DESC LIMIT 0, 1");
$row=mysql_fetch_assoc($pcias);
/*luego de buscar el último número (ultimo numero de sindical) sumo uno para tener el numero real*/

switch ($_POST['sindi']){
	case 'null': $sindi = $_POST['buff_sindi'];
					if($sindi == 'SI'){
						$nSindical = $row['TNSIN']+1;
					}else $nSindical = '';
					break;
	case 'NOnSindi': $sindi = 'NO';
					 $nSindical = '';
					 break;
	case 'SInSindi': $sindi = 'SI';
					 $nSindical = $row['TNSIN']+1;;
					 break;
}
/***---------------------------------------------***/

/*Guarda los datos de la fecha de nacimiento*/
$fechahoy = date('Y').'-'.date('m').'-'.date('d');
$nacimiento_mod = $_POST['fecha_nacimiento_modifica'];
$buffer_nacimiento =  $_POST['buff_nacimiento'];

if ($nacimiento_mod==''){
	$fnac = $buffer_nacimiento;	
}
else  {$fnac = $nacimiento_mod;}

$sexo = $_POST["sexo"];
/*Fecha plan materno infantil*/
$fpmi = $_POST['fecha_pmi'];

$anio = substr($fnac, 0, -6);
$mes_a = substr($fnac, 0, -3);
$mes = substr($mes_a, 5);
$dia = substr($fnac, 8);

$edad=CalculaEdad($fnac);

if (isset($_POST["pmi"])) { $pmi="SI"; $fecha_pmi_vto = $fpmi;
			  } else {
					if ($edad == 0) { $pmi="RN";  $fecha_pmi_vto= ($anio+1)."-".$mes."-".$dia;
							} else {$pmi="NO"; $fecha_pmi_vto="0000-00-00"; }
				}

$nacionalidad = utf8_encode(strtoupper( trim ( $_POST["nacio"])));
$apellido = utf8_encode(strtoupper( trim ( $_POST["apellido"])));
$nombre = utf8_encode(strtoupper( trim ( $_POST["nombres"])));
$tipodoc = $_POST["tipodoc"];
$dni = $_POST["dni"];

/*Valores con el día de hoy para usar al comparar en las fechas buffer*/
$d=Date('d');
$m=Date('m');
$Y=Date('Y');

$VHaPaDjObSo = $_POST["EHaPaDjObSo"];
$filial = $_POST["lugar"];//lugar donde va el afiliado

$dia_inicio_act = $_POST['fecha_iniact'];
$buffer_iact =  $_POST['buff_inic'];

if ($dia_inicio_act==''){
	$Inac = $buffer_iact;
}
else  {$Inac = $dia_inicio_act;}

/*Fecha ingreso a la empresa*/
if ($_POST['igualfechaact']=='SI'){
	$fingse = $Inac;
} else {$fingse = $_POST['fecha_ingreso'];}


/*Guarda los datos de la fecha de desempleo desde*/
$dia_desde = $_POST['fecha_desde'];
$buffer_ddesde =  $_POST['buff_desde'];

if ($dia_desde==''){
	$fdes = $buffer_ddesde;
}
else  {$fdes = $dia_desde;}

/*Guarda los datos de la fecha de desempleo hasta*/
$dia_hasta = $_POST['fecha_hasta'];
$buffer_hasta =  $_POST['buff_hasta'];

if ($dia_hasta==''){
	$fhasta = $buffer_hasta;
}
else  {$fhasta = $dia_hasta;}

$obserHab = utf8_encode(strtoupper( trim ( $_POST["obser_hab"] ) ) );
$escivil = $_POST["estcivil"];
$prov = utf8_encode(strtoupper( trim ( $_POST["pcia"] )));
$depto = utf8_encode(strtoupper( trim ( $_POST["dpto"])));
$local = utf8_encode(strtoupper( trim ( $_POST["localidad"])));
$codp = $_POST["cp"];
$domicilio = utf8_encode(strtoupper( trim ( $_POST["domi"])));
$zona = $_POST["zona"];
$tel1 = $_POST["tel1"];
$tel2 = $_POST["tel2"];
$mail = $_POST["email"];
$obser = utf8_encode(strtoupper( trim ( $_POST["obser"] ) ) );

/*Guarda dato anterior si no se modifico actividad*/
if(($_POST["tipoact"])=='null'){ $tipoact=$_POST['buff_act']; }else $tipoact=$_POST['tipoact'];

/*Guarda dato anterior si no se modifico tipo de afiliado*/
if(($_POST["t_afi"])=='null'){ $tipoafil=$_POST['buff_tipoafil']; }else $tipoafil=$_POST['t_afi'];

/*Guarda dato anterior si no se modifico el Origen OS*/
if(($_POST["orig_os"])=='null'){ $origenos=$_POST['buff_origenos'];
								 $alta_os = $_POST['tosoc_buffer'];}
else { 
	    $origenos=$_POST['orig_os'];
	    if ($_POST['orig_os'] == 'CAMIONERO'){
	  		  $alta_os='SI';
	        }else { $alta_os = 'NO'; }

	  }

/*Guarda los datos de la fecha de alta de sindicato*/
$dia_sindi = $_POST['fecha_sindi'];
$buffer_sindi =  $_POST['buff_altasindi'];

if ($dia_sindi==''){
	$fsindi = $buffer_sindi;
}
else  {$fsindi = $dia_sindi;}

$disc = $_POST["tdis"];
$tpat = $_POST["tipopat"];

/*Fecha vencimiento patologia*/
$fpat = $_POST['fecha_pato'];

$mutual = $_POST["mutual"]; 
$nmutual = $_POST["nmutual"];

/*Guarda los datos de la fecha de alta mutual*/
$dia_mut = $_POST['fecha_mutu'];
$buffer_mut =  $_POST['buff_altamut'];

if ($dia_mut==''){
	$fmutual = $buffer_mut;
}
else  {$fmutual = $dia_mut;}

/* Familia */
$fami_cargo = $_POST['famicargo'];
$fami_cant = $_POST['cflia'];

/*Guarda los datos de la FECHA DE MODIFICACIÓN*/
$fmodif=date("c");

$orden = "00";

/*Generar el nuevo titular*/
$sql = "insert into titulares (USUARIO, USRFILIAL, TLETT, TZONA, TTDOC, TNDOC, CUIL, CUITEMPRESA, TNOMB, TSEXO, TAPEL, TNACI, TESCI, TDOMI, TLOCA, DPTO, PCIA, TCPOS, TTELE, TTELE2, MAIL, TFNAC, TIPOACT, INIACT, TFING, TFINS, OBSHABER, TNAFI, TNSIN, TDISC, TPATO, FFVENPAT, TFPMI, TFINMUTUAL, TFAMCAR, TFAMI, RECIBO, NMUTUAL, TMUT, TOSOC, ORIGENOS, DESEMDESDE, DESEMHASTA, FECHAMODIF, TSINDI, OBSERV, SueldoBasico, FeAltaObSoc, FeAltSegSep, FeBajSegSep, LUGARAFIL, HaPaDjObSo, TORDE)

		values ('$user', '$usuariof', '$tipoafil', '$zona', '$tipodoc', '$dni', '$cuilTitu', '$cuitEmpresa', '$nombre', '$sexo', '$apellido', '$nacionalidad', '$escivil', '$domicilio', '$local', '$depto', '$prov', '$codp', '$tel1', '$tel2', '$mail', '$fnac', '$tipoact', '$Inac', '$fingse', '$fsindi', '$obserHab', '$nAfil', '$nSindical', '$disc', '$tpat', '$fpat', '$fecha_pmi_vto', '$fmutual',	'$fami_cargo', '$fami_cant', '$recibo', '$nmutual', '$mutual', '$alta_os', '$origenos', '$fdes', '$fhasta', '$fmodif', '$sindi', '$obser', '$sbasico', '$f_os', '$altaSep', '$bajaSep', '$filial', '$VHaPaDjObSo', '$orden')";

$agrega = mysql_query ($sql, $link);

$sqlFilial = "delete from titudesdefilial where cuil=$cuilBuffer";
$elimina = mysql_query ($sqlFilial, $link);

$sqlBusca="select cuil_titu from famidesdefilial where cuil_titu='$cuilBuffer'";
$resultBusca=mysql_query($sqlBusca, $link);
$num = mysql_num_rows($resultBusca);

if ($num != 0){//si la persona no tiene un familiar no se guarda en la tabla buffer_fami
//nota: update 'nombre_tabla' set nombre_campo= replace(nombre_campo, 'string_a_encontrar', 'string_a_reemplazar'); */
$sqlBuscaCuil="update famidesdefilial set cuil_titu=replace(cuil_titu, ".$cuilBuffer.", ".$cuilTitu.")";
$resultBuscaCuil=mysql_query($sqlBuscaCuil, $link);

$sqlBuffer = "insert into buffer_fami (cuiltitu, cantidad, nombre, apellido) values ('$cuilTitu', '$num', '$nombre', '$apellido')";
$agregar_buffer = mysql_query($sqlBuffer, $link);
}

if (!mysql_error()){
		$alerta=208; 
		header ("Location: lista_familia.php?cuilTitu=$cuilTitu");
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