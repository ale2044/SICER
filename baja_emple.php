<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
$user = $_SESSION["user"];

$motivobaja = $_POST["listabajaEmple"];
$cuil = $_POST["cuilpersona"];

$tbcuit = $_POST["cuitempresa"];
$tbfing = $_POST["tfing"];
$tbcaterialab = $_POST["tipoact"];
$tbiniact = $_POST["iniact"];
$tbtafil = $_POST["tlett"];
$tborigenOS = $_POST["origenos"];
$tbdesdedes = $_POST["desemdesde"];
$tbhastades = $_POST["desemhasta"];
$tbaltaSindi = $_POST["tfins"];
$tbfinmut = $_POST["tfinmutual"];
$ndoc = $_POST['ndoc'];
$nafil = $_POST['nafil'];

$alerta=414;

/* cuando se elije dar de baja a todo 
SI: ESTA DADO DE ALTA
NO: ESTA DADO DE BAJA
*/

if (isset($_POST["baja_todo"])) {
	$baja_todo = 'NO';
	$fecha_todo= $_POST["aniotodo"]."-".$_POST["mestodo"]."-".$_POST["diatodo"];
            
	$sql="UPDATE titulares SET 
							TFECBAJAOS='$fecha_todo',
							TFECBAJM='$fecha_todo',	
							TFECBAJS='$fecha_todo', 
							TSINDI='$baja_todo', 
							TMUT='$baja_todo', 
							TOSOC='$baja_todo',
							MOTBAJA='$motivobaja',
							TMARC='' 
							WHERE CUIL='".$cuil."'";
	$agrega = mysql_query($sql);
	
	$alerta=413;//El empleado fue dado de baja
	
	/*Para el historial*/
	$HisFecBOS = $fecha_todo;
	$HisFecBM = $fecha_todo;
	$HisFecBS = $fecha_todo;
	$HisMUT = $baja_todo;
	$HisSINDI = $baja_todo;
	$HisOSOC = $baja_todo;
	$HisMotiv = $motivobaja;
	/*----------------*/

		$sqlHistorial = "insert into historial_titu (CUIL, TNDOC, TNAFI, TFECBAJM, TFECBAJS, TFECBAJAOS, MOTBAJA, TMUT, TSINDI, TOSOC, 
									CUITEMPRESA, TFING, TIPOACT, INIACT, TLETT, ORIGENOS, DESEMDESDE, DESEMHASTA, TFINS, TFINMUTUAL)
					values ('$cuil', '$ndoc',  '$nafil', '$HisFecBM', '$HisFecBS', '$HisFecBOS', '$HisMotiv', '$HisMUT', '$HisSINDI', '$HisOSOC',
							'$tbcuit','$tbfing','$tbcaterialab','$tbiniact','$tbtafil','$tborigenOS','$tbdesdedes','$tbhastades',
							'$tbaltaSindi','$tbfinmut')";
		$agregaHis = mysql_query ( $sqlHistorial );

		if (!mysql_error()){ header("Location: menu.php?alerta=$alerta"); }
		       else { echo " ERROR al grabar sus datos. Comuniquese con el administrador <br><br> - El error es:" .mysql_errno(); 
		       			switch(mysql_errno())
   					{
       							case 2003: echo "No se puede conectar al servidor MySQL";
           						case 2006: echo "El servidor MySQL se ha apagado";
           						case 2008: echo "MySQL se quedó sin memoria";
           						case 2013: echo "Se perdió la conexión con el servidor MySQL durante la consulta";
           						case 2047: echo "incorrecto o desconocido protocolo";
           						case 2048: echo "No válido identificador de conexión";
					}
		       }
			mysql_close();		
	}

/* reinicio de datos para trabajar con bajas parciales */
if (($_POST['baja_parcial'])=='on'){
$baja_mut =$_POST['bufmut'];
$baja_osocial = $_POST['bufosoc'];
$baja_sindi = $_POST['bufsindi'];
$fecha_sindi = $_POST['fbufsindi'];
$fecha_mut = $_POST['fbufmut'];
$fecha_osocial = $_POST['fbufosoc'];


				//baja sindicato
				if (isset($_POST["check_sindi"])){
					$baja_sindi = 'NO';
					$fecha_sindi = $_POST["aniosin"]."-".$_POST["messin"]."-".$_POST["diasin"];
				}
				//baja mutual
				if (isset($_POST["check_mut"])){
					$baja_mut = 'NO';
					$fecha_mut = $_POST["aniomut"]."-".$_POST["mesmut"]."-".$_POST["diamut"];
				}
				//baja obra social
				if (isset($_POST["check_osocial"])){
						$baja_osocial = 'NO';
						$fecha_osocial = $_POST["anioosoc"]."-".$_POST["mesosoc"]."-".$_POST["diaosoc"];
				} 	

				$sql="UPDATE titulares SET 
							TFECBAJAOS='$fecha_osocial',
							TFECBAJM='$fecha_mut',	
							TFECBAJS='$fecha_sindi', 
							TSINDI='$baja_sindi', 
							TMUT='$baja_mut', 
							TOSOC='$baja_osocial',
							MOTBAJA='$motivobaja',
							TMARC=''  
							WHERE CUIL='".$cuil."'";
				$agrega = mysql_query($sql);

	
				$alerta=413;//El empleado fue dado de baja

				/*Para el historial*/
				$HisFecBOS = $fecha_osocial;
				$HisFecBM = $fecha_mut;
				$HisFecBS = $fecha_sindi;
				$HisMUT = $baja_mut;
				$HisSINDI = $baja_sindi;
				$HisOSOC = $baja_osocial;
				$HisMotiv = $motivobaja;
				/*----------------*/

		$sqlHistorial = "insert into historial_titu (CUIL, TNDOC, TNAFI, TFECBAJM, TFECBAJS, TFECBAJAOS, MOTBAJA, TMUT, TSINDI, TOSOC, 
									CUITEMPRESA, TFING, TIPOACT, INIACT, TLETT, ORIGENOS, DESEMDESDE, DESEMHASTA, TFINS, TFINMUTUAL)
					values ('$cuil', '$ndoc',  '$nafil', '$HisFecBM', '$HisFecBS', '$HisFecBOS', '$HisMotiv', '$HisMUT', '$HisSINDI', '$HisOSOC',
							'$tbcuit','$tbfing','$tbcaterialab','$tbiniact','$tbtafil','$tborigenOS','$tbdesdedes','$tbhastades',
							'$tbaltaSindi','$tbfinmut')";
		$agregaHis = mysql_query ( $sqlHistorial );
	}

		if (!mysql_error()){ header("Location: menu.php?alerta=$alerta"); }
		       else { echo " ERROR al grabar sus datos. Comuniquese con el administrador <br><br> - El error es:" .mysql_errno(); 
		       			switch(mysql_errno())
   					{
       							case 2003: echo "No se puede conectar al servidor MySQL";
           						case 2006: echo "El servidor MySQL se ha apagado";
           						case 2008: echo "MySQL se quedó sin memoria";
           						case 2013: echo "Se perdió la conexión con el servidor MySQL durante la consulta";
           						case 2047: echo "incorrecto o desconocido protocolo";
           						case 2048: echo "No válido identificador de conexión";
					}
		       }
		mysql_close(); }
	?> 