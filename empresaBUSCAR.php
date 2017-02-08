<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
$dato_empre = $_POST["dato_empre"];
?>

<?include("includes/header.php");?>

<div id="contenedor" class="centraTabla">
<div id="cajachicasup"></div>
<div id="cajappal">
<h1 align="center">Panel de BUSQUEDA de EMPRESAS || Usuario: <b><? echo $user; ?></b></h1>
<div id="cajacuadro">
<?
$tipo = ($_POST['busca_empre']);

switch ($tipo) {
	case 'Editar...':
		$action = "empresaEDITAR.php";
		$boton = "Editar";
		$valu = 'Editar...';
		break;
	case 'Buscar...':
		$action = "empresaMOSTRAR.php";
		$boton = "Mostrar";
		$valu = 'Buscar...';
		break;
	case 'Volver a buscar':
		$action = "empresaMOSTRAR.php";
		$boton = "Mostrar";
		$valu = 'Buscar...';
		break;
	case 'Editar otro':
		$action = "empresaEDITAR.php";
		$boton = "Editar";
		$valu = 'Editar...';
		break;
}
?>
<form action="empresaBUSCAR.php" name="formulario" id="formulario" method="POST">
            	<input type="text" name="dato_empre" size="17" maxlength="11" value="CUIT o NOMBRE" 
            		onFocus="if (this.value=='CUIT o NOMBRE') this.value='';"/>
                <input type="submit" name="busca_empre" value="<? print $valu; ?>" size="11" />
</form>
</div>

<form action="<?print $action;?>" name="formulario" id="formulario" method="POST"> 
<div id="CajaEmpre" >

<?
$buscar = $dato_empre;

if(is_numeric($buscar)){
	$resul1 = mysql_query("select SUSS, NOMBRE from empresas where SUSS like '%$dato_empre%' ORDER BY SUSS");
	?>
	<select size="1" name="cuit_empre" style="width:300px">
	<?
	while ($myrow=mysql_fetch_array($resul1))
	{
		$selec1=$myrow['SUSS'];
		$selec11 = $myrow['SUSS']." - ".$myrow['NOMBRE'];
     ?>
		<option value="<? echo $selec1?>"><? echo utf8_decode($selec11);?></option>
	<?} ?>
		</select>
	<?	} 
	
	else {
		$buscar = strtoupper($buscar);
		$resul1 = mysql_query("select NOMBRE, SUSS from empresas where NOMBRE like '%$dato_empre%' ORDER BY NOMBRE"); ?>

	<select size="1" name="cuit_empre" style="width:300px">
	<?
	while ($myrow=mysql_fetch_array($resul1))
	{
		$selec1=$myrow['SUSS'];
		$selec11 = $myrow['SUSS']." - ".$myrow['NOMBRE'];
     ?>
	<option value="<? echo $selec1?>"><? echo utf8_decode($selec11);?></option>
	<?} ?>
	</select>
		 <?	} ?>


	<input type="submit" size="8" name="Mostrar" value="<? print $boton; ?>">

</div> <!-- CajaEmpre -->

</form>

<div id="cajapie" class="centraTabla">
<table>

		<tr>
			<td width="" height="23" align="center" valign="middle">
				<button onclick="window.location.href='menu.php'" class="inicio">Volver</button>
				
			</td>

			<!-- Botón volver, lo saque porque me parecio que se puede llegar a confundir el usuario
			<td width="" height="23" align="center" valign="middle">
				<button onclick="window.location.href='cerro.php'" class="salir">Salir</button>
 			</td> -->
		</tr>

</table>
</div>
</div> <!-- CajaPrincipal-->
</div><!-- contenedor -->

<script type="text/javascript" src="cargarDptos.js"></script>
<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script src="jquery-ui.min" type="text/javascript"></script>
<script type="text/javascript" src="vanadium.js"></script>
<?php include("includes/footer.php");
}
?>
