<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
$user = $_SESSION["user"];
$alerta = $_GET["alerta"];
$cuilTitu = $_GET['cuilTitu'];
// echo "GETS: ";
// var_dump($_GET);
?>

<?include("includes/header.php");?>

<script>

	
function guardarClicFami(){

$(function(){
    $("option").bind("dblclick", function(){
    	var a=$(this).text()
    	window.location = "pruebas.php?empresa=" + a;
    });
});
    
}

</script>

</head>

<body>
<div id="contenedor">
<div id="cajachicasup"></div>

<div id="cajappal" class="centraTabla" >
<h1 align="center" class="fami">
Panel de GESTI&Oacute;N de Datos: FAMILIARES || Usuario: <b><? echo $user; ?></b>
</h1>

<!-- famiGESTION.php -->

<form action="famiGESTION.php" name="formulario" id="formulario" method="GET"> 
<div id="CajaFami" class='centraTabla'>
	<table>
			<tr ALIGN="center">
				<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA">Elija un familiar para guardar</td>
			</tr>
	</table>
	
	<?
	
	$dato_emple = $cuilTitu;
		
	$resul1 = mysql_query("select cuil_titu, cuil_fami, apel_fami, nom_fami from famidesdefilial where cuil_titu like '%$dato_emple%' order by nom_fami asc")
	?>
	
	<input type="hidden" name="cuitTituBuffer" value="<? print $cuilTitu; ?>"/>
		
	<select size="10" name="cuil_fami" style="width:300px">
	<?
	while ($myrow=mysql_fetch_array($resul1))
	{
		$selec1=$myrow['cuil_fami'];
		$selec11 = $myrow['nom_fami']." - ".$myrow['apel_fami'];
     ?>
		<option value="<? echo $selec1?>"><? echo $selec11;?></option>
	<?} ?>
		</select>
</div>

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
					alert("ATENCI\u00d3N: Por favor seleccione un familiar.");
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