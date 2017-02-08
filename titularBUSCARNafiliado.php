<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
$user = $_SESSION["user"];
$dato_titu = $_POST["dato_titu"];

include("includes/header.php");
?>
<div id="contenedor" class="centraTabla">
<div id="cajachicasup"></div>
<div id="cajappal">
<h1 align="center"  class='emple'>Panel de BUSQUEDA de Titulares || Usuario: <b><? echo $user; ?></b></h1>
<div id="cajacuadro">
<?
$tipo = ($_POST['busca_titu']);

switch ($tipo) {
	case 'Editar...':
		$action = "empleadoEDICION.php";
		$boton = "Editar";
		$valu = 'Editar...';
		break;
	case 'Buscar...':
		$action = "empleadoMOSTRAR.php";//"empleadoMOSTRAR.php";
		$boton = "Mostrar";
		$valu = 'Buscar...';
		break;
	case 'Agregar Familiar...':
		$action = "famiGESTION_ALTA.php";//"familiarALTA.php";
		$boton = "Agregar";
		$valu = 'Agregar Familiar...';
		break;
}
?>
<form action="titularBUSCARNafiliado.php" name="formulario" id="formulario" method="POST">
            	<input type="text" name="dato_titu" size="17" maxlength="11" value="NRO AFILIADO" 
            		onFocus="if (this.value=='NRO AFILIADO') this.value='';"/>
                <input type="submit" name="busca_titu" value="<? print $valu; ?>" size="11" />
</form>
</div>

<form action="<?print $action;?>" name="formulario" id="formulario" method="POST"> 
<div id="CajaEmple" >

<?
$buscar = $dato_titu;

if(is_numeric($buscar)){
	$resul1 = mysql_query("select CUIL, TNDOC, TNAFI, TNOMB, TAPEL from titulares where TNAFI like '%$dato_titu%' ORDER BY TNAFI");
	?>
	<select size="1" name="tnafi" style="width:300px">
	<?
	while ($myrow=mysql_fetch_array($resul1))
	{
		$selec1=$myrow['TNAFI'];
		$selec11 = $myrow['TNAFI']." - ".$myrow['TAPEL']." ".$myrow['TNOMB'];
     ?>
     	<option value="<? echo $selec1;?>"><? echo $selec11; ?></option>
	<?} ?>
		</select>
	<?	} 
	
	else {
		$buscar = strtoupper($buscar);
		$resul1 = mysql_query("select CUIL, TAPEL, TNOMB from titulares where TAPEL like '%$dato_titu%' OR TNOMB like '%$dato_titu%' ORDER BY TAPEL"); ?>
<!-- 	/*comprobar si fuinciona bien la busqueda con or*/ -->
	<select size="1" name="cuil_titu" style="width:300px">
	<?
	while ($myrow=mysql_fetch_array($resul1))
	{
		$selec1=$myrow['CUIL'];
		$selec11 = $myrow['CUIL']." - ".$myrow['TAPEL']." ".$myrow['TNOMB'];
     ?>
  
	<option value="<? echo $selec1;?>"><? echo $selec11;?></option>
	<?} ?>
	</select>
 	<input type="hidden" name="elprimero" size="40" maxlength="11" value="<? print $selec1; ?>"/>
		 <?	} ?>

 	<input type="submit" size="8" name="Mostrar" value="<? print $boton; ?>">

</div> <!-- CajaEmpre -->

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

<script type="text/javascript" src="cargarDptos.js"></script>
<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>

<?
include("includes/footer.php");
}
?>