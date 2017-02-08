<?
session_start();
require_once("includes/connection.php");

include ("fciones/fcionEdad.php");
$user =$_SESSION["user"];
$hoy= Date("Y-m-d");

//$cuitEmpre=$_POST["cuitempre"];//ahora creo que debería recibir el cuit de la empresa

$cuil_titu = $_POST["cuiltitu"];
$afil_fam = $_POST["afilfam"];
$orden = $_POST["orden"];
$cuil_fami = $_POST["cuilfami"];
$tipo_docu = $_POST["dni"];
$nro_docu = $_POST["docu"];
$apel_fami = strtoupper($_POST["apellido"]);
$nom_fami = strtoupper($_POST["nombres"]);
$nacimiento = $_POST["fnacimiento"];
$nacionalidad = strtoupper($_POST["nacio"]);
$sexo = $_POST["sex"];

$VHaPaDjObSo = $_POST["EHaPaDjObSo"];

$f_ing_mutual = $_POST["fecha_ing_mutual"];
$f_ing_sindi = $_POST["fecha_ing_sind"];
$f_ing_os = $_POST["fecha_ing_os"];

$edad=CalculaEdad($nacimiento);

$tipoparen = $_POST["tipoparen"];

	if (($tipoparen=="04") OR ($tipoparen=="06")) {
							$fecha_est= $_POST["f_est"];
							$fecha_est_vto= $_POST["f_est_vto"];
							$nivel = $_POST["nivel_est"];
							$des_est = $_POST["descrpcion_est"];
						      } else { $fecha_est = "0000-00-00"; $fecha_est_vto = "0000-00-00"; $nivel = "xxxx"; $des_est = "xxxx"; }

	if (($tipoparen=="08") OR ($tipoparen=="10")) {
							$disc ="SI";
							$fecha_disc= $_POST["f_disc"];
							$fecha_disc_vto= $_POST["f_Vto_disc"];
							$desc_disc = $_POST["descrpcion_disc"];
						      } else { $disc ="NO"; $fecha_disc = "0000-00-00"; $fecha_disc_vto = "0000-00-00"; $desc_disc = "****"; }

if (isset($_POST["pmi"])) { $pmi="SI"; $fecha_pmi_vto= $_POST["fpmi"];
			  } else {
					if ($edad == 0) { $pmi="RN";  $fecha_b = $_POST["fnacimiento"]; //ej 2016-09-15
												  $anio = (substr($fecha_b, 0, -6))+1;//2016
												  $mesdia = substr($fecha_b, 4); //-09-15
												  $fecha_pmi_vto = $anio.$mesdia;
									} else {$pmi="NO"; $fecha_pmi_vto="0000-00-00"; }
				}

$pendiente = $_POST["docu_pendiente"];

$feCarga =  date("c");

if (isset($_POST["otro_domi"])) {
				$otro_domi = "SI";
				$pcia_fami = strtoupper($_POST["pcia_fami"]);
				$dpto_fami = strtoupper($_POST["dpto_fami"]);
				$local_fami = strtoupper($_POST["localidad_fami"]);
				$domi_fami = strtoupper($_POST["domicilio_fami"]);
			       } else {

					$ssql = "SELECT pcia, dpto, localidad, domi FROM titudesdefilial WHERE cuil='$cuil_titu'";
					$rs = mysql_query($ssql, $link);
					$row=mysql_fetch_array($rs);

				$otro_domi = "NO";
				$pcia_fami = $row["pcia"];
				$dpto_fami = $row["dpto"];
				$local_fami = $row["localidad"];
				$domi_fami = $row["domi"];
			       }

$sql = "insert into famiba (FLETF, FechaIngOS, FechaIngSI, FechaIngMU, FORDE, USUARIO, CUILTITU, CUILFAMI, APELFAMI, NOMFAMI, FSEXO, NACIONALIDAD, FTDOC, FNDOC, FFNAC, FPARE, F_ESTADOINI, F_ESTADOVTO, NIVELEST, DESCEST, DISC, F_DISCINI, F_DISCVTO, DESCDISC, 
		PMI, F_PMIVTO, DOCPEND, OTRODOMI, PCIFAMI, DPTOFAMI, LOCALFAMI, DOMIFAMI, CARGADO, HaPaDjObSo)
		values ('$afil_fam', '$f_ing_os', '$f_ing_sindi', '$f_ing_mutual', '$orden', '$user', '$cuil_titu', '$cuil_fami', '$apel_fami', '$nom_fami', '$sexo', '$nacionalidad', '$tipo_docu', '$nro_docu', '$nacimiento', '$tipoparen', '$fecha_est', '$fecha_est_vto', '$nivel', '$des_est', '$disc', '$fecha_disc', '$fecha_disc_vto', '$desc_disc', '$pmi', '$fecha_pmi_vto', '$pendiente', '$otro_domi', '$pcia_fami', '$dpto_fami', '$local_fami', '$domi_fami', '$feCarga', '$VHaPaDjObSo')";

$agrega = mysql_query ($sql, $link);

// if (!mysql_error())

// {if(isset($_POST["carga_titu"])) { header ("Location: empleadoALTA.php?empre=$cuit"); } else { $_SESSION = array(); header ("Location: menu.php");}

if (!mysql_error())
		{	 
			$alerta=415;//flia guardada correctamente
			if(isset($_POST["carga_fami"])){
			header ("Location: familiarALTA.php?titular=$cuil_titu"); } else { header ("Location: menu.php?alerta=$alerta");} 

// 				echo "<b>GRABO CORRECTAMENTE LOS SIGUIENTES DATOS: </br>";
// 						echo ">> cuil titu: ".$cuil_titu."<br>";
// 						echo ">> cuit empre: ".$cuitEmpre."<br>";
						
			
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