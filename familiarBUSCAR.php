<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION["user"];
$dato_fami = $_POST["dato_flia"];

//array(2) { ["dato_flia"]=> string(9) "321923675" ["busca_fliar"]=> string(9) "Buscar..." }
//var_dump($_POST);
?>

<?include("includes/header.php");?>

<div id="contenedor" class="centraTabla">
<div id="cajachicasup"></div>
<div id="cajappal">
<h1 align="center">Panel de BUSQUEDA de FAMILIAR || Usuario: <b><? echo $user; ?></b></h1>
<div id="cajacuadro">
<?
$tipo = ($_POST['busca_fliar']);

switch ($tipo) {
	case 'Editar...':
		$action = "familiaEDICION.php";
		$boton = "Editar";
		$valu = 'Editar...';
		break;
	case 'Buscar...':
		$action = "familiarMOSTRAR.php";
		$boton = "Mostrar";
		$valu = 'Buscar...';
		break;
}
?>

<form action="familiarBUSCAR.php" name="formulario" id="formulario" method="POST">
            	<input type="text" name="dato_flia" size="17" maxlength="11" value="DNI o NOMBRE" 
            		onFocus="if (this.value=='DNI o NOMBRE') this.value='';"/>
                <input type="submit" name="busca_fliar" value="<? print $valu; ?>" size="11" />
</form>
</div>

<form action="<?print $action;?>" name="formulario" id="formulario" method="POST"> 
<div id="CajaFami" >

<?
$buscar = $dato_fami;

if(is_numeric($buscar)){
	$resul1 = mysql_query("select FNDOC, APELFAMI, NOMFAMI from famiba where FNDOC like '%$dato_fami%' ORDER BY FNDOC");
	?>
	<select size="1" name="dni_fami" style="width:300px">
	<?
	while ($myrow=mysql_fetch_array($resul1))
	{
		$selec1=$myrow['FNDOC'];
		$selec11 = $myrow['FNDOC'].": ".$myrow['APELFAMI']." - ".$myrow['NOMFAMI'];
     ?>
		<option value="<? echo $selec1?>"><? echo $selec11;?></option>
	<?} ?>
		</select>
	<?	} 
	
	else {
		$buscar = strtoupper($buscar);
		$resul1 = mysql_query("select APELFAMI, NOMFAMI, FNDOC from famiba where NOMFAMI like '%$dato_fami%' OR APELFAMI like '%$dato_fami%' ORDER BY NOMFAMI"); ?>

	<select size="1" name="dni_fami" style="width:300px">
	<?
	while ($myrow=mysql_fetch_array($resul1))
	{
		$selec1=$myrow['FNDOC'];
		$selec11 = $myrow['FNDOC'].": ".$myrow['APELFAMI']." - ".$myrow['NOMFAMI'];
     ?>
	<option value="<? echo $selec1?>"><? echo $selec11;?></option>
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

<? include("includes/footer.php");
}
?>