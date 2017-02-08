<?
session_start();
require_once("includes/connection.php");

$user = $_SESSION["user"];

$cuilfbuffer = $_POST['cuilf_buffer'];
$cuilTitu = $_POST["cuiltitu"];
$cuilFami = $_POST["cuilfami"];
$tipoDocu = $_POST['tipodoc'];
$nroDocu = $_POST['dni'];
$apellido = utf8_encode( strtoupper( trim($_POST['apellido'])));
$nombres = utf8_encode( strtoupper( trim($_POST['nombres'])));
$VHaPaDjObSo = $_POST["EHaPaDjObSo"];

$nacimiento_mod = $_POST['fecha_nacimiento_modifica'];
$buffer_nacimiento =  $_POST['buff_nacimiento'];

if ($nacimiento_mod==''){ $fnac = $buffer_nacimiento; } else  { $fnac = $nacimiento_mod; }

/*modificacion de sexo y PMI*/

$tipo_afilfam = $_POST['afilfam'];//D:Adherente J=Jubilado B=Pensionada N=No afiliado U=Unificacion de aporte O=Serv. Domestic.

/* fechas de ingreso */
$fingOS = $_POST['fecha_ing_os'];
$fingMU = $_POST['fecha_ing_mutual'];
$fingSI = $_POST['fecha_ing_sind'];

$modifica_sexo = $_POST['sexmodif'];
switch ( $modifica_sexo ) {
	case 'null':
		$tSexo = $_POST['buff_sexo'];
		$pmi = $_POST['buff_pmi'];
		$fpmi = $_POST['buff_fechapmi'];
		break;
	case 'M':
		$tSexo = 'M';
		$pmi = 'NO';
		$fpmi = "0000-00-00";
		break;
	case 'F':
		$tSexo = 'F';
		$pmi = $_POST['pmi'];
		$fpmi = $_POST['fecha_pmi'];
		break;
}

$modif = $_POST['modif_par'];

if ($modif != 'si'){
/*Guardando tipo de parientes modificacion*/
	
	$mtipoParen = $_POST['buff_paren'];

	/*ESTUDIOS MODIFICAR*/

	if (($mtipoParen == '04') OR ($mtipoParen == '06')){
		
		/*comprobar si no se modificaron las fechas Emision*/
		$fEstudioEmi1 = $_POST['f_est_emitido'];
		$fEstudioEmi2 = $_POST['buff_emi_estudio'];
		if ($fEstudioEmi1 == ''){
			$f_est_emi = $fEstudioEmi2;
		}else { $f_est_emi = $fEstudioEmi1; }
		
		/*comprobar si no se modificaron las fechas Vencimiento*/
		$fEstudioVtoEmi1 = $_POST['f_est_vencimiento'];
		$fEstudioVtoEmi2 = $_POST['buff_vto_estudio'];
		if ($fEstudioVtoEmi1 == ''){
			$f_est_vto = $fEstudioVtoEmi2;
		}else { $f_est_vto = $fEstudioVtoEmi1; }
		
		/*Nivel de estudio*/
		$nivelEst = $_POST['nivel_est'];
		
		/*Descripcion del estudio*/
		$descripEst = utf8_encode( strtoupper( trim($_POST['descrpcion_est'])));
				
		/*Formatea datos de discapacidad*/
		$descrip_disc = "-";
		$f_disc_emi = "0000-00-00";
		$f_disc_vto = "0000-00-00";
		$disc = "NO";//Necestito pasarle algun parametro para discapasitado
	}
	
	if (($mtipoParen == '08') OR ( $mtipoParen == '10') ) {
		
		$disc ="SI";//En este caso el familiar si es discapacitado
		
		/*comprobar si no se modificaron las fechas Emision*/
		$fDiscapacidadEmi1 = $_POST['f_disc_emitido'];
		$fDiscapacidadEmi2 = $_POST['buff_fdisem'];
		
		if ($fDiscapacidadEmi1 == ''){
			$f_disc_emi = $fDiscapacidadEmi2;
		}else { $f_disc_emi = $fDiscapacidadEmi1; }
		
		/*comprobar si no se modificaron las fechas Vencimiento*/
		$fDiscapacidadVtoEmi1 = $_POST['f_disc_emitido'];
		$fDiscapacidadVtoEmi2 = $_POST['buff_Dvto'];
		if ($fDiscapacidadVtoEmi1 == ''){
			$f_disc_vto = $fDiscapacidadVtoEmi2;
		}else { $f_disc_vto = $fDiscapacidadVtoEmi1; }
		
		/*Descripcion de Discapacidad*/
		$descrip_disc = utf8_encode( strtoupper( trim($_POST['descrpcion_disc'])));
		
		/*Formatea datos de estudio*/
		$nivelEst = "-";
		$descripEst = "-";
		$f_est_emi = "0000-00-00";
		$f_est_vto = "0000-00-00";
	}
	if (($mtipoParen == '00'))
	 {
				$disc = "NO";
				$descrip_disc = "-";
				$f_disc_emi = "0000-00-00";
				$f_disc_vto = "0000-00-00";
				$nivelEst = "-";
				$descripEst = "-";
				$f_est_emi = "0000-00-00";
				$f_est_vto = "0000-00-00";
	 }
/*Acà termina la modificacion*/	
	}

/*Si hice clic en modificar se activa este*/
else{
	$mtipoParen=$_POST['tparen_modif'];
	
	//Estudiante
	if (($mtipoParen == '04') OR ($mtipoParen == '06')){
		
		$f_est_emi = $_POST['f_est_emitido_modif'];
		$f_est_vto = $_POST['f_est_vencimiento_modif'];
			
		/*Nivel de estudio*/
		$nivelEst = $_POST['nivel_est_m'];
		
		/*Descripcion del estudio*/
		$descripEst = utf8_encode( strtoupper( trim($_POST['descripcion_estudio'] )));
		
		/*Formatea datos de discapacidad*/
		$descrip_disc = "-";
		$f_disc_emi = "0000-00-00";
		$f_disc_vto = "0000-00-00";
		$disc = "NO";
	}
	
	if (($mtipoParen == '08') OR ($mtipoParen == '10')) {
		$disc ="SI";
		$descrip_disc = $_POST["descripcion_disc"];
	
		$f_disc_emi = $_POST['f_disc_emitido_modif'];
		$f_disc_vto = $_POST['f_disc_vencimiento_modif'];
		
		/*Formatea datos de estudio*/
		$nivelEst = "-";
		$descripEst = "-";
		$f_est_emi = "0000-00-00";
		$f_est_vto = "0000-00-00";
	}	
}//fin del else
	
// echo "tipo= ".$mtipoParen." descripcion =".$descripEst."fecha em".$f_est_emi;

$nacionalidad = utf8_encode( strtoupper( trim($_POST['nacio'])));
$otro_domi = $_POST['otro_domi'];
$prov_fami = utf8_encode( strtoupper( trim($_POST['pcia'])));
$depto_fami = utf8_encode( strtoupper( trim($_POST['dpto'])));
$localidad_fami = utf8_encode( strtoupper( trim($_POST['localidad'])));
$domi_fami = utf8_encode( strtoupper( trim($_POST['domi'])));
$doc_pend = utf8_encode( strtoupper( trim($_POST['doc_pend'])));

$feCarga = date("c");//Fecha de ingreso real al sistema sindi, fecha de carga.

//echo "SEXO".$tSexo."PMI".$pmi."fecha".$fpmi;

$fechaedad = time() - strtotime($fnac);
//$edad = floor($fechaedad / 31556926);

/*****GENERA AUTOMÁTICAMENTE EL NUMERO DE ORDEN******/
$searchorde = mysql_query ("SELECT CUILTITU, FORDE FROM famiba WHERE CUILTITU = '$cuilTitu' ORDER BY FORDE DESC LIMIT 0, 1");
$consulta=mysql_fetch_assoc($searchorde);
/*luego de buscar el último número (ultimo numero de orden) sumo uno para tener el numero real*/
					 $forden = $consulta['FORDE'] + 01;
/***---------------------------------------------***/

//echo "tipo de pariente".$mtipoParen." "."descripcion de estudio".$descripEst."descripcion de disc".$descrip_disc;
/*Generar la nueva empresa*/
$sql = "insert into famiba (FLETF, FechaIngOS, FechaIngSI, FechaIngMU, FORDE, USUARIO, CUILTITU, CUILFAMI, APELFAMI, NOMFAMI, FSEXO, NACIONALIDAD, FTDOC, FNDOC, FFNAC, FPARE, F_ESTADOINI, F_ESTADOVTO, NIVELEST, DESCEST, DISC, F_DISCINI, F_DISCVTO, DESCDISC, PMI, F_PMIVTO, DOCPEND, OTRODOMI, PCIFAMI, DPTOFAMI, LOCALFAMI, DOMIFAMI, CARGADO, HaPaDjObSo)
		values ('$tipo_afilfam', '$fingOS', '$fingSI', '$fingMU', '$forden', '$user', '$cuilTitu', '$cuilFami', '$apellido', '$nombres', '$tSexo', '$nacionalidad', '$tipoDocu', '$nroDocu', '$fnac', '$mtipoParen', '$f_est_emi', '$f_est_vto', '$nivelEst', '$descripEst', '$disc', '$f_disc_emi', 
				'$f_disc_vto', '$descrip_disc', '$pmi', '$fpmi', '$doc_pend', '$otro_domi', '$prov_fami', '$depto_fami', '$localidad_fami', '$domi_fami', '$feCarga', '$VHaPaDjObSo')";

$agrega = mysql_query ($sql, $link);

/*borra la familia que se encuentra en la tabla de filial*/
$sqlFilial = "delete from famidesdefilial  where cuil_fami=$cuilfbuffer";
$elimina = mysql_query ($sqlFilial, $link);

/*busca en la tabla de familia de filial la cantidad de familiares del titular*/
$sqlBusca = "select * from buffer_fami where cuiltitu='$cuilTitu'";
$pcias = mysql_query($sqlBusca, $link);
$row = mysql_fetch_assoc ( $pcias );

/*resta 1 por el familiar que ya se dio de alta*/
$restar = $row['cantidad']-1;
$sqlBufferResta = "UPDATE buffer_fami SET cantidad='$restar' WHERE cuiltitu = '".$cuilTitu."'";
$agregaBuff = mysql_query($sqlBufferResta, $link);

if (!mysql_error()){
	
	if ( $restar == '0' ) {
			/*Si ya se dieron todos los familiares de alta se procede a borrar el familiar del buffer*/			
			$sqlVaciarBuffer = "delete from buffer_fami where cuiltitu=$cuilTitu";
			$eliminaBuffer = mysql_query ($sqlVaciarBuffer, $link);
			$alerta=209;//los datos fueron grabados correctamente
			header ("Location: menu.php?alerta=$alerta");
	}else {
			$alerta=208;//los datos fueron grabados correctamente 
			header ("Location: lista_familia.php?alerta=$alerta&cuilTitu=$cuilTitu");
			
			}
		
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