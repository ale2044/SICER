<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

include ("fcionzona.php");
include ("fcionlocalidad.php");
include ("fcion_dptos_er.php");

$user = $_SESSION["user"];
$alerta = $_GET["alerta"];

include("includes/header.php");
?> 

<script type="text/javascript" src="cargarDptos.js"></script>

<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>
<script>
function muestra_dpto(form)
{
if (form.pcia.value == "ENTRE RIOS") { document.getElementById("Cajadptoer").style.display = 'block'; }
					 else { document.getElementById("Cajadptoer").style.display = 'none'; }
}

function bloquear()
{
	var cont = document.formulario.pcia.value;
	
	if (cont != 'null'){
		formulario.localidad.disabled=false;
		formulario.cp.disabled=false;	
			}
}
</script>

</head>

<body>

<div id="contenedor">

<div id="cajachicasup"></div>

<div id="cajappal" class="centraTabla">
<div id="txt1">
TODOS los campos son OBLIGATORIOS. Deben estar completos para que se guarden</div>
<h1 align="center">
Panel de ALTA de Localidad y C.P. || Usuario: <b><? echo $user; ?></b>
</h1>

<form action="grabarlocalidad.php" name="formulario" id="formulario" method="POST" > 

<div id="CajaEmpre" class="centraTabla">

<table>

			<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA"> Elija una provincia y complete los datos</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Provincia:</td>

			   <td height="15" valign=middle  onchange="bloquear();">
			   		 <? $pcias=mysql_query("SELECT * from zona ORDER BY NOMZON ASC"); ?>
				<select name="pcia" id="pcia"  onchange="cargarDptos(); muestra_dpto(this.form);">
                                 	<option value="null">Selecciona una Provincia!</option>
           	 				<?							
							while($row=mysql_fetch_assoc($pcias)){
					print '<option value="'.strtolower($row['NOMZON']).'" >'.$row['NOMZON']." - ".$row['ZONA'].'</option>';
							}
						?>
				</select><? print $row['NOMZON'];?>
			</td>
			</tr>			
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Localidad:</td>
			<td height="15" valign=middle><input type="text" disabled name="localidad" size="40" maxlength="50" class=":required"  style="text-transform:uppercase;" /></td>
			</tr>

			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Código Postal</td>
					<td height="15" valign=middle><input type="text" disabled name="cp" size="40" maxlength="4" class=":required" />
            </td>
			</tr>
</table>

</div> <!-- CajaEmpre -->

<table>
	<tr ALIGN="center">
			    <td height="15" valign=middle> 
				<input type="submit" name ="graba" value="Grabar" class="grabar" size="10"/>
				
			    </td>
	</tr>
</table>
</form>

<div id="cajapie" class = "centraTabla">
<table>
		<tr>
		
		<td width="110" height="23" align="center" valign="middle">
			<button onclick="window.location.href='empresaALTA.php'" class="inicio">Cancelar</button>
		</td>
					
		</tr>

</table>
</div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->

<?
/*verificar el tipo de alerta y notificar*/
switch ($alerta) {
	case 'correcto':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: La Localidad fue guardada correctamente!");
			</script>
		<?; break;
   				 }
?>

</body>
</html>

<?}?>