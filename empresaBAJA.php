<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
include ("fciondiamesanio.php");
include ("fcionzona.php");
include ("fciontipoactividad.php");
include ("fcionbajaEmpre.php");

$user = $_SESSION["user"];
$cuit_empre = $_POST["cuit_empre"];

$sqlBusca="select SUSS from empresas where SUSS='$cuit_empre'";
$resultBusca=mysql_query($sqlBusca, $link);

if (mysql_num_rows($resultBusca)==1){	

$pcias = mysql_query("SELECT * from empresas WHERE SUSS='$cuit_empre'");
$row=mysql_fetch_assoc($pcias);

$a=$row['BAJA'];
	if ( $a != '*' ){
?>

<?include("includes/header.php");?>

<div id="contenedor">
<div id="cajachicasup">
</div>
<div id="cajappal" class='centraTabla'>

<h1 align="center">
Panel de baja de Datos: EMPRESAS || Usuario: <b><? echo $user; ?></b>
</h1>

<? if ($_GET["falto"]=="falta") { ?>
				<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Complete TODOS los Campos Obligatorios ::: </b></span>
			<? } ?>	
			
<form action="baja_empre.php" name="formulario" id="formulario" method="POST">

<div id="CajaEmpre">

	<table>

			<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA">Complete los Datos de la Empresa</td>
			</tr>
			
			<tr ALIGN="left">
			<td height="15" valign=middle class='txt'><b> CUIT:</b></td>
   			<td height="15" valign=middle ><input type="text" name="cuitE" size="40" maxlength="11" readonly="readonly"
   				class=":required" style="text-transform: uppercase;" value="<?php print $row['SUSS'];?>" /></td>			    
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> EMPRESA:</b> </td>
			    <td height="15" valign=middle class='txt2'><?			    
			    $nroEmpre = $row['EMPRESA'];
			    
			    $cuenta = strlen ( $nroEmpre );
			    
			    switch ($cuenta) {
			    	case 1:
			    		$muestra = '000'.$nroEmpre;
			    		break;
			    	case 2:
			    		$muestra = '00'.$nroEmpre;
			    		break;
			    	case 3:
			    		$muestra = '0'.$nroEmpre;
			    		break;
			    	case 4:
			    		$muestra = $nroEmpre;
			    		break;
			    }
			    
			    				print $muestra; ?></td>			    
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Clave:</b> </td>
			    <td height="15" valign=middle class='txt2'><?php print $row['CLAVE'];?></td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Nombre:</b> </td>
			    <td height="15" valign=middle class='txt2'><? print $row['NOMBRE'];?></td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b>Nom. Fantasia: </b></td>
			    <td height="15" valign=middle class='txt2'> <?php print $row['FANTASI'];?></td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> E-mail: </b></td>
			    <td height="15" valign=middle class='txt2'><?php print $row['E_MAIL'];?></td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Cód. Baja:</b> </td>
			    <td height="15" valign=middle>
				<? bajaE(); ?></td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Fecha Baja</b></td>
				<td height="15" valign=middle>
				<? diaBe(); mesBe(); anioBe(); ?>
			</td></tr>
			
			<tr ALIGN="left">
		    <td height="15" valign=middle class='txt'><b> Observaciones: </b></td>
			<td height="15" valign=middle><TEXTAREA rows="4" cols="36" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="observBaja" style="text-transform:uppercase">...</TEXTAREA>
			</td>
			</tr>
</table>

</div> <!-- CajaEmpre -->

<table>
	<tr ALIGN="center">
			    <td height="15"> 
				<input type="submit" name ="graba" class='grabar' value="Dar de baja" size="10" />
			    </td>
	</tr>
</table>
	

</form>

<table>
		<tr ALIGN="center">

			<td width="" height="23" align="center">
				<button onclick="window.location.href='menu.php'" class='inicio'>Inicio</button>
			</td>

			<td width="" height="23" align="center">
				<button onclick="window.location.href='menu.php'" class='cancelar'>Cancelar</button>
			</td>

			<td width="" height="23" align="center">
				<button onclick="window.location.href='cerro.php'" class='salir'>Salir</button>
			</td>
		</tr>
</table>




<div id="cajapie">

</div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->

</body>
</html>

<?php 
}else
	{ 
		$alerta='empbaja';
		header("Location: menu.php?alerta=$alerta");
	}
}else
{
	$alerta=407; //CUIT NO ENCONTRADO;
	header("Location: menu.php?alerta=$alerta");	
}

php include("includes/footer.php");
}
?>