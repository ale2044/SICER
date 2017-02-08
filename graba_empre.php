<?
session_start();
require_once("includes/connection.php");

$user = $_SESSION["user"];

$longnEm = strlen($nEmpre);

$falta = 5 - $longnEm;

If ( $falta != 0) {
		$aux ="";
		for ( $i = 1 ; $i <= $falta ; $i ++) {
		//print $i;
		$aux= $aux."0";
						}
		    }

$cuitEmpre = $_POST["cuitempre"];
$nombEmpre = strtoupper($_POST["nomempre"]);
$prov = strtoupper($_POST["pcia"]);

$resul= mysql_query("select ZONA from zona where NOMZON='$prov'");
$row=mysql_fetch_array($resul);
$zona = $row[ZONA];

$falta1 = 2 - strlen($zona);

If ( $falta1 != 0) {
			$zona= "0".$zona;

		    }

$localidad = strtoupper($_POST["departamento"]); //localidad ej TARTAGAL4560

$departamento = substr($localidad, 0, -4);

//$dpto1 = substr($dpto,0,(strlen($dpto)-4));

$codP = substr($localidad, -4); //Codigo Postal

$subZ = substr($codP, 0, 2);

$domiEm = strtoupper($_POST["domicilio"]);

/*---------ACTIVIDADES 1, 2, 3, 4, Y 5 ----------------------------*/

if ($_POST["act_afipP"]==""){
	$tipoAc = "null";
}else { 
	//$tipoAc = $_POST["act_afipP"];
$tipoAc = substr($_POST["act_afipP"], 0, 6);
}

if ($_POST["act_afipS"]==""){
	$subAct = "null";
}else {
	//$subAct = $_POST["act_afipS"];
	$subAct = substr($_POST["act_afipS"], 0, 6);
}

if ($_POST["act_afipT"]==""){
	$subIIAct = "null";
}else {
// 	$subIIAct = $_POST["act_afipT"];
	$subIIAct = substr($_POST["act_afipT"], 0, 6);
}

if ($_POST["act_afipC"]==""){
	$subIIIAct = "null";
}else {
// 	$subIIIAct = $_POST["act_afipC"];
	$subIIIAct = substr($_POST["act_afipC"], 0, 6);
}

if ($_POST["act_afipQ"]==""){
	$subIVAct = "null";
}else {
// 	$subIVAct = $_POST["act_afipQ"];
	$subIVAct = substr($_POST["act_afipQ"], 0, 6);
}

/*------------------TERMINA LOS TIPO DE ACTIVIDAD ------------------*/

$EstudioCont = $_POST["agregarEstudioContable"];

$TelEmp = $_POST["tel1"];
$TelEmp2 = $_POST["tel2"];
$mail =  $_POST["mail"];
$obser =  strtoupper($_POST["obser"]);

//$dIng = $_POST["dia"]; Estaban ya escritas en el sistema y no tienen uso por el momento
//$mIng = $_POST["mes"];
//$aIng = $_POST["anio"];

//$dIngs = $_POST["diaIng"]; //Fecha de ingreso al sistema
//$mIngs = $_POST["mesIng"];
//$aIngs = $_POST["anioIng"];

//$dIni = $_POST["diaIni"]; //Fecha de Inicio de actividad
//$mIni = $_POST["mesIni"];
//$aIni = $_POST["anioIni"];

$clave = $subZ .$nEmpre.$zona;

//if (strlen($dIni) == 1) { $dIni = "0".$dIni; } 
//if (strlen($mIni) == 1) { $mIni = "0".$mIni; }

//if (strlen($dIngs) == 1) { $dIngs = "0".$dIngs; }
//if (strlen($mIngs) == 1) { $mIngs = "0".$mIngs; }

$feIni = $_POST['f_iniact'];//$aIni."-".$mIni."-".$dIni;

//$feIngSis = $aIngs."-".$mIngs."-".$dIngs;

$feIng = date("c");//Fecha de ingreso real al sistema sindi, fecha de carga

$sql = "insert into empredesdefilial (usuario, cuit, nombre, pcia, localidad, zona, domi, tel1, tel2, mail, tipo_actividad, inicio_actividad, sub_actividad, subII_actividad, subIII_actividad, subIV_actividad, observacion, fecha_de_carga, id_estudio, CODPOST)
		 values ('$user', '$cuitEmpre', '$nombEmpre', '$prov', '$departamento', '$zona', '$domiEm', '$TelEmp', '$TelEmp2', '$mail', '$tipoAc', '$feIni', '$subAct','$subIIAct','$subIIIAct','$subIVAct', '$obser', '$feIng', '$EstudioCont', '$codP')";
	
$agrega = mysql_query ($sql, $link);

if (!mysql_error())
		{
		if(isset($_POST["carga_titu"])) { header ("Location: empleadoALTA.php?cuitempre=$cuitEmpre"); } 
		/*408=para enviar un cartel que notifique que se grabo correctamente*/
		else { $alerta=408; header ("Location: menu.php?alerta=$alerta");}
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