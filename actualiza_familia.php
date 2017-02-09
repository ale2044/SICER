<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
$user = $_SESSION ["user"];

$dni = $_POST ["dni"];
$dni_buffer = $_POST ["dni_buffer"];

$sqlBusca = "select FNDOC from famiba where FNDOC='$dni_buffer'";

$resultBusca = mysql_query ( $sqlBusca );

if (mysql_num_rows ( $resultBusca ) == 1) {
	
	$cuilTitu = $_POST["cuiltitu"];
	$cuilFami = $_POST["cuil_fami"];
	$tipoDocu = $_POST['tipodoc'];
	$nroDocu = $_POST['dni'];
	$apellido = $_POST['apellido'];
	$nombres = $_POST['nombres'];
	
	$nacimiento_mod = $_POST['fecha_nacimiento_modifica'];
	$buffer_nacimiento =  $_POST['buff_nacimiento'];
	
	if ($nacimiento_mod==''){ $fnac = $buffer_nacimiento; } else  { $fnac = $nacimiento_mod; }
	
	/*modificacion de sexo y PMI*/
	
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
			$descripEst = $_POST['descrpcion_est'];
	
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
			$descrip_disc = $_POST['descrpcion_disc'];
	
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
			$descripEst = $_POST['descripcion_estudio'];
	
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
	
	//echo "tipo= ".$mtipoParen." descripcion =".$descripEst."fecha em".$f_est_emi;
	
	$nacionalidad = $_POST['nacio'];
	$otro_domi = $_POST['otro_domi'];
	$prov_fami = $_POST['pcia'];
	$depto_fami = $_POST['dpto'];
	$localidad_fami = $_POST['localidad'];
	$domi_fami = $_POST['domi'];
	$doc_pend = $_POST['doc_pend'];
	
	$feCarga = date("c");//Fecha de ingreso real al sistema sindi, fecha de carga.
	
	
	//$fechaedad = time() - strtotime($fnac);
	//$edad = floor($fechaedad / 31556926);
	//EDAD = '$edad', antes se guardaba la edad ahora se calcula
	
	if ( $_POST['alta'] == 'si' ){
		$alta = '-';
	}else $alta = '*';
	
	$sql = " UPDATE famiba SET
		USUARIO	= '$user',
		CUILTITU = '$cuilTitu',
		CUILFAMI = '$cuilFami',
		APELFAMI = '$apellido',
		NOMFAMI	= '$nombres',
		FSEXO = '$tSexo',
		NACIONALIDAD = '$nacionalidad',
		FTDOC = '$tipoDocu',
		FNDOC = '$nroDocu',
		FFNAC = '$fnac',
		FPARE = '$mtipoParen',
		F_ESTADOINI	= '$f_est_emi',
		F_ESTADOVTO	= '$f_est_vto',
		NIVELEST = '$nivelEst',
		DESCEST= '$descripEst',	
		DISC = '$disc',
		F_DISCINI = '$f_disc_emi',
		F_DISCVTO = '$f_disc_vto',
		DESCDISC = '$descrip_disc',
		PMI	= '$pmi',
		F_PMIVTO = '$fpmi',
		DOCPEND	= '$doc_pend',
		OTRODOMI = '$otro_domi',
		PCIFAMI	= '$prov_fami',
		DPTOFAMI = '$depto_fami',
		LOCALFAMI = '$localidad_fami',
		DOMIFAMI = '$domi_fami',
		CARGADO	= '$feCarga',
		FMARC = '$alta' //////////////// ACA ESTA EL ERROR NO VA FMARC SI NO OTRO TIPO DE BAJA COMO BAJASIN
		
		WERE FNDOC = '" . $dni_buffer . "'";
		
	$agrega = mysql_query ( $sql, $link );
	
	$alerta = 408; // El empleado fue actualizado correctamente
	if (! mysql_error ()) {
		header ( "Location: menu.php?alerta=$alerta" );
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
}
mysql_close ( );
}
?>