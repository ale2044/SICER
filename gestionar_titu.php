<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION["user"];
$alerta = $_GET["alerta"];
?>

<?include("includes/header.php");?>

<div id="contenedor">
<div id="cajachicasup"></div>

<div id="cajappal" class="centraTabla" >
<h1 align="center" class="emple">
Panel de GESTI&Oacute;N de Datos: TITULARES || Usuario: <b><? echo $user; ?></b>
</h1>

<!-- tituGESTION -->
<form action="tituGESTION.php" name="formulario" id="formulario" method="POST"> 
<div id="CajaEmple" class='centraTabla'>
	<table>
			<tr ALIGN="center">
				<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA">Elija un titular para guardar</td>
			</tr>
			<tr>
				<td>
					<?php $result = mysql_query("select cuil, apellido, nombres from titudesdefilial order by apellido asc");?>
						<select size="20" name="titular" style="width:355px" ondblclick="guardarTitular();">
						<? while ($myrow=mysql_fetch_array($result))
							{?>
								<option value="<? echo $myrow[cuil]; ?>">
								<? echo $myrow[apellido].' '.$myrow[nombres]; ?> - CUIL: <? echo $myrow[cuil];?></option>
						<?	}?>
						</select>
				</td>
			</tr>
	</table>
</div> <!-- CajaEmpre -->

<table>
	<tr ALIGN="center">
			    <td height="15" valign=middle> 
				<input type="submit" name ="aceptar" value="Aceptar" size="10" class="grabar" />
				</td>
	</tr>
</table>
</form>



<div id="cajapie" class="centraTabla">
<table>
	<tr>
		<td width="" height="23" align="center" valign="middle">
			<button onclick="window.location.href='menu.php'" class="inicio">Inicio</button>
		</td>

		<td width="" height="23" align="center" valign="middle">
			<button onclick="window.location.href='cerro.php'" class="salir">Salir</button>
		</td>
	</tr>
</table>
</div>
</div> <!-- CajaPrincipal-->
</div><!-- contenedor -->

<?
	switch ($alerta) {
		
    	case 208:
			?>
				<script type="text/JavaScript1.2">
					alert("ATENCI\u00d3N: Los datos fueron GRABADOS correctamente.");
				</script>
			<?; break;
		case 'seleccionar':
			?>
				<script type="text/JavaScript1.2">
					alert("ATENCI\u00d3N: Por favor seleccione un empleado.");
				</script>
			<?; break;
		 }			
?>

<script type="text/javascript" src="cargarDptos.js"></script>
<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>
<? include("includes/footer.php");
}
?>