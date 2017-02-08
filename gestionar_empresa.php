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

<script>	
function guardarEmpresa(){

$(function(){
    $("option").bind("dblclick", function(){
    	var a=$(this).text()
    	window.location = "pruebas.php?empresa=" + a;
    });
});
      
		//window.location = "empresaGESTION.php";
		
//		var cuit_empreJS="<?//php echo $cuit_emp;?>";
// 		if (confirm("La empresa existe ¿Desea editarla?") == true) { 
// 			window.open("empresaEDITAR.php?cuit_empre="+cuit_empreJS,'_parent');} 
		
// 			var misVariablesGet = getVarsUrl();
// 			var a=misVariablesGet.empresa;// devuelve "cuil"

// 			window.location = "estudiocontableALTA.php?lugar=" + lugar+"&cuit_empre="+a;
// 		}


	}

</script>

<div id="contenedor">
<div id="cajachicasup"></div>

<div id="cajappal" class="centraTabla">
<h1 align="center">
Panel de GESTI&Oacute;N de Datos: EMPRESAS || Usuario: <b><? echo $user; ?></b>
</h1>

<form action="empresaGESTION.php" name="formulario" id="formulario" method="GET"> 
<div id="CajaEmpre" class='centraTabla'>
		<table>
			<tr ALIGN="center">
				<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA">Elija una empresa para guardar</td>
			</tr>
			<tr ALIGN="center">
				<td>
					<?php $result = mysql_query("select cuit, nombre from empredesdefilial order by nombre asc");?>
						<select size="20" name="empresa" style="width:355px" multiple="multiple" ondblclick="guardarEmpresa();">
						<? while ($myrow=mysql_fetch_array($result))
							{?>
								<option value="<? echo $myrow[cuit]; ?>">
								<? echo $myrow[nombre]; ?> - CUIT: <? echo $myrow[cuit];?></option>
						<?	}?>
						</select>
				</td>
			</tr>
		</table>
</div> <!-- CajaEmpre -->

<table>
	<tr ALIGN="center">
			    <td height="15" valign=middle> 
				<input type="submit" name ="aceptar" value="Aceptar" size="10" class="grabar"/>
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
					alert("ATENCI\u00d3N: Por favor seleccione una empresa.");
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