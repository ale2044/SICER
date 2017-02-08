<?
session_start();
require_once("includes/connection.php");

include ("fciones/fcionEdad.php");
$user =$_SESSION["user"];
$hoy= Date("Y-m-d");

//$cuitEmpre=$_POST["cuitempre"];//ahora creo que debería recibir el cuit de la empresa

$cuil_titu = $_POST["cuil_titu"];
$cuil_fami = $_POST["cuil_fami"];
$apel_fami =  utf8_encode(strtoupper( trim ( $_POST["apel_fami"])));
$nom_fami =  utf8_encode(strtoupper( trim ( $_POST["nom_fami"])));
$sexo = $_POST["sex"];
$nacionalidad =  utf8_encode(strtoupper( trim ( $_POST["nacio"])));
$tipo_docu = $_POST["dni"];
$nro_docu = $_POST["docu"];
$nacimiento = $_POST['fecha_nacimiento'];//$_POST["anioNac"]."-".$_POST["mesNac"]."-".$_POST["diaNac"];
$edad=CalculaEdad($nacimiento);


$tipoparen = $_POST["tipoparen"];

	if (($tipoparen=="04") OR ($tipoparen=="06")) {
							$fecha_est= $_POST["anio_est"]."-".$_POST["mes_est"]."-".$_POST["dia_est"];
							$fecha_est_vto= $_POST["anio_est_vto"]."-".$_POST["mes_est_vto"]."-".$_POST["dia_est_vto"];
							$nivel = $_POST["nivel_est"];
							$des_est = $_POST["descrpcion_est"];
						      } else { $fecha_est = "0000-00-00"; $fecha_est_vto = "0000-00-00"; $nivel = "xxxx"; $des_est = "xxxx"; }

	if (($tipoparen=="08") OR ($tipoparen=="10")) {
							$disc ="SI";
							$fecha_disc= $_POST["anio_disc"]."-".$_POST["mes_disc"]."-".$_POST["dia_disc"];
							$fecha_disc_vto= $_POST["anioVto_disc"]."-".$_POST["mesVto_disc"]."-".$_POST["diaVto_disc"];
							$desc_disc = $_POST["descrpcion_disc"];
						      } else { $disc ="NO"; $fecha_disc = "0000-00-00"; $fecha_disc_vto = "0000-00-00"; $desc_disc = "****"; }

if (isset($_POST["pmi"])) { $pmi="SI"; $fecha_pmi_vto= $_POST["anio_pmi"]."-".$_POST["mes_pmi"]."-".$_POST["dia_pmi"];
			  } else {
					if ($edad == 0) { $pmi="RN";  $fecha_pmi_vto= ($_POST["anioNac"]+1)."-".$_POST["mesNac"]."-".$_POST["diaNac"];
							} else {$pmi="NO"; $fecha_pmi_vto="0000-00-00"; }
				}

$pendiente =  utf8_encode(strtoupper( trim ( $_POST["docu_pendiente"])));

if (isset($_POST["otro_domi"])) {
				$otro_domi = "SI";
				$pcia_fami =  utf8_encode(strtoupper( trim ( $_POST["pcia_fami"])));
				$dpto_fami =  utf8_encode(strtoupper( trim ( $_POST["dpto_fami"])));
				$local_fami =  utf8_encode(strtoupper( trim ( $_POST["localidad_fami"])));
				$domi_fami =  utf8_encode(strtoupper( trim ( $_POST["domicilio_fami"])));
			       } else {

					$ssql = "SELECT pcia, dpto, localidad, domi FROM titudesdefilial WHERE cuil='$cuil_titu'";
					$rs = mysql_query($ssql, $link);
					$row=mysql_fetch_array($rs);

				$otro_domi = "NO";
				$pcia_fami =  utf8_encode(strtoupper( trim ( $row["pcia"]))); 
				$dpto_fami =  utf8_encode(strtoupper( trim ( $row["dpto"])));
				$local_fami =  utf8_encode(strtoupper( trim ( $row["localidad"])));
				$domi_fami =  utf8_encode(strtoupper( trim ( $row["domi"])));
			       }

$sql = "insert into famidesdefilial (usuario, cuil_titu, cuil_fami, apel_fami, nom_fami, sexo, nacionalidad, tipo_docu, nro_docu,
				    nacimiento, edad, tipoparen, fecha_est_ini, fecha_est_vto, nivel_est, des_est,
					disc, fecha_disc_ini, fecha_disc_vto, desc_disc, pmi, fecha_pmi_vto, docu_pendiente,
					 otro_domi, pcia_fami, dpto_fami, localidad_fami, domicilio_fami, cargado)
		 		values ('$user', '$cuil_titu', '$cuil_fami', '$apel_fami', '$nom_fami', '$sexo', '$nacionalidad',
					 '$tipo_docu', '$nro_docu', '$nacimiento', '$edad', '$tipoparen', '$fecha_est', '$fecha_est_vto', '$nivel', '$des_est',
					'$disc', '$fecha_disc', '$fecha_disc_vto', '$desc_disc', '$pmi', '$fecha_pmi_vto', '$pendiente', '$otro_domi',
					 '$pcia_fami', '$dpto_fami', '$local_fami','$domi_fami','$hoy')";

$agrega = mysql_query ($sql, $link);

if (!mysql_error())
		{	 
			$alerta=415;//flia guardada correctamente
			if(isset($_POST["carga_fami"])){
			header ("Location: familiarALTA.php?titular=$cuil_titu"); } else { header ("Location: menu.php?alerta=$alerta");} 
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
				case 2049: echo "Conexión mediante el protocolo de autentica";
			}
		}

mysql_close($link);

?>