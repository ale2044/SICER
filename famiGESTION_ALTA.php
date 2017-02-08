<?
session_start();
require_once("includes/connection.php");
include("fciones/fciontipoafil_familiar.php");
include("fciones/fciontipodoc.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION ["user"];

$cuiltitu = $_POST['cuil_titu'];

$sql = "select CUIL from titulares where CUIL='$cuiltitu'";
$res = mysql_query($sql, $link);
if(mysql_num_rows($res) == 1){
	$pcias = mysql_query( "SELECT * from titulares WHERE CUIL='$cuiltitu'");
	$row=mysql_fetch_assoc($pcias);  }else{ header("location:index.php"); }

?>

<script type="text/javascript">

function activar(form) {

if (form.tipoparen.value=="04" || form.tipoparen.value=="06"){ 
					document.getElementById("Caja_estudio").style.display = 'block';
							      } else { document.getElementById("Caja_estudio").style.display = 'none'; }

if (form.tipoparen.value=="08" || form.tipoparen.value=="10"){
					document.getElementById("Caja_discapacidad").style.display = 'block'; 
							     } else { document.getElementById("Caja_discapacidad").style.display = 'none'; }

}
</script>

<script type="text/javascript" >
function esconde(form)
{
if ((form.apel_fami.value != "") && (form.nom_fami.value != "") && (form.cuil_fami.value != ""))
{ form.graba.style.visibility = "visible"; } else { form.graba.style.visibility = "hidden"; }

}

function checkcuitl(){
	var tipo1 = document.formu.cuil_fami.value;

	numCarac = tipo1.length;

	if (numCarac < 11 )
	{
		alert("ATENCI\u00d3N: El nro de CUIT debe tener 11 d\u00edgitos.");
	}
}
</script>

<script type="text/javascript">
function pmi_ver(form)
{
if (form.sex.value == "F"){ document.getElementById("Caja_pmi").style.display = 'block'; } else { document.getElementById("Caja_pmi").style.display = 'none'; }

}
</script>

<script type="text/javascript">
function pmi_fecha(form)
{
if(document.getElementById('pmi').checked) { form.fpmi.style.visibility = "visible"; } else {
 					      form.fpmi.style.visibility = "hidden";
					   				}
}

</script>

<script type="text/javascript">

function domi_fami(form)
{
if(document.getElementById('otro_domi').checked) { document.getElementById("Caja_otro_domi").style.display = 'block'; } else {
						   document.getElementById("Caja_otro_domi").style.display = 'none'; }

}

</script>

<script languaje=javascript>
//autocompleta la fecha
    function informacion(form)
    {
        var idx;
        {
			form.fecha_ing_sind.value = form.fecha_ing_os.value;
			form.fecha_ing_mutual.value = form.fecha_ing_os.value;
		}
	}
</script>

<?include("includes/header.php");?>

	<div id="contenedor">
	<div id="cajachicasup"></div>
		<div id="cajappal" class='centraTabla'>
			<h1 align="center">
				Panel de GESTI&Oacute;N de Datos: FAMILIARES || Usuario: <b><? echo $user; ?></b>
			</h1>
			
<div id="CajaNotificacion"><div class="txt"><strong><? print "CUIL DEL TITULAR"; print " || ".$cuiltitu; print " ".$row['TAPEL']." ".$row['TNOMB']; ?></strong></div></div>
		
		<!-- "grabar_fami_gestion.php" -->
<form action="graba_fami_gestion.php" name="formulario" id="formulario" method="POST">
	
	<div id="CajaFami" class="centraTabla">
		<table>
			<tr align="center">
				<td colspan="2" height="20" valign=middle bgcolor="#EFEEDA">Seleccione el campo que desee modificar</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle><input type="hidden" name="cuiltitu" size="40" value="<? print $cuiltitu; ?>"/>
				</td>
			</tr>

			<tr align="center">
			    <td height="15" valign=middle class="txt">Tipo de Afiliado (familiar):</td>
			    <td height="15" valign=middle class="txt"><? afilfam(); ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br> ····················· DATOS PERSONALES	 ····················· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> CUIL FAMILIAR:</td>
			   <td height="15" valign=middle class="txt" onchange=checkcuitl();>
				<input type="text" name="cuilfami" size="20" maxlength="11" value="SIN GUION"  class=":required :integer" onFocus="if (this.value=='SIN GUION') this.value='';"/>
			   </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> DNI Tipo:</td>

			   <td height="15" valign=middle class="txt">
				<? tipodoc(); ?>
				Nro: <input type="text" name="docu" size="20" maxlength="11" value="SIN Puntos" class=":required :integer" onFocus="if (this.value=='SIN Puntos') this.value='';" OnChange="esconde(form);" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></td>
			</tr>
					
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Apellido:</td>
			   <td height="15" valign=middle><input type="text" name="apellido" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Nombres:</td>
			   <td height="15" valign=middle><input type="text" name="nombres" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Fecha de Nacimiento:</td>
				<td height="15" valign=middle><input type="date" name="fnacimiento" id="fnacimiento"></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Nacionalidad:</td>
			   <td height="15" valign=middle class="txt">
				<select name="nacio" id="nacio">
                                 	<option value="Null">Seleccione Una Opci&oacute;n</option>
                                 	<option value="ARGENTINO">ARGENTINO</option>
                                 	<option value="URUGUAYO">URUGUAYO</option>
                                 	<option value="OTRA">OTRA</option>
				</select>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Sexo:</td>
			   <td height="15" valign=middle class="txt">
				<select name="sex" id="sex" OnChange="pmi_ver(this.form)">
                                 	<option value="Null">Seleccione...</option>
                                 	<option value="F">F</option>
                                 	<option value="M">M</option>
				</select>
			    </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br> ····················· DATOS AFILIATORIOS	 ····················· </td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de ingr. O.S.:</td>
				<td height="15" valign=middle><input type="date" class="inputbox" name="fecha_ing_os" id="fecha_ing_os"><br>
				<i><small>Check fechas iguales</small></i><input onClick="informacion(this.form)" type="checkbox" value="1" name="informacion_formulario"></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de ingr. SINDICATO.:</td>
				<td height="15" valign=middle><input type="date" class="inputbox" name="fecha_ing_sind" id="fecha_ing_sind"></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de ingr. AMUTCAER:</td>
				<td height="15" valign=middle><input type="date" class="inputbox" name="fecha_ing_mutual" id="fecha_ing_mutual"></td>
			</tr>
				
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">HaPaDjObSo:</td>
				<td height="15" valign=middle><input type="txt" maxlength="6" name="EHaPaDjObSo"></td>
			</tr>
				
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'> Tipo Parentesco

				<? $resultados = mysql_query("select cod_paren, desc_paren from parentesco order by cod_paren asc"); ?>

				<select size="1" name="tipoparen" style="width:300px" OnChange="activar(this.form);">

					<? while ($myrow=mysql_fetch_array($resultados))
						{ ?>

						<option value="<? echo $myrow[cod_paren]; ?>"><? echo $myrow[desc_paren]; ?> </option>

						<? } ?>
				</select>

				<div id="Caja_estudio" style="display:none;" class='txt'><h2> E S T U D I O </h2>
						<p>Emitido: <input type="date" name="f_est" id="f_est"></p>
						<p>Vencimiento: <input type="date" name="f_est_vto" id="fnacimiento"></p>
		
						<select name="nivel_est" id="nivel_est">
                                 			<option value="null">Seleccionar Estudio</option>
                                 			<option value="PRIMARIO">PRIMARIO</option>
                                 			<option value="SECUNDARIO">SECUNDARIO</option>
                                 			<option value="TERCIARIO">TERCIARIO</option>
                                 			<option value="OTROS">OTROS</option>
						</select>
						<p>Descripci&oacute;n: <input type="text" name="descrpcion_est" size="50" maxlength="150" style="text-transform:uppercase;" /></p>

				</div>

				<div id="Caja_discapacidad" style="display:none;" class='txt'><h2> D I S C A P A C I D A D </h2>
						<p>Emitido: <input type="date" name="f_disc" id="f_disc"></p>
						<p>Vencimiento: <input type="date" name="f_Vto_disc" id="f_Vto_disc"></p>
						<p>Descripci&oacute;n: <input type="text" name="descrpcion_disc" size="50" maxlength="150" style="text-transform:uppercase;" /></p>
				</div>

				<div id="Caja_pmi" style="display:none;" class='txt'>P.M.I. -Con FPP- <input type="checkbox" name="pmi" id="pmi" value="SI" onclick="pmi_fecha(this.form)" >
						<input type="date" name="fpmi" id="fpmi" style="visibility: hidden">
				</div>

						<p>Otro Domicilio: <input type="checkbox" name="otro_domi" id="otro_domi" onclick="domi_fami(this.form)" /></p>
					
				<div id="Caja_otro_domi" style="display:none;" class='txt'>
						<p>Provincia: <input type="text" name="pcia_fami" id="pcia_fami" size="50" style="text-transform:uppercase;"/></p>
						<p>Departamento: <input type="text" name="pto__fami" id="pto__fami" size="50" style="text-transform:uppercase;"/></p>
						<p>Localidad: <input type="text" name="localidad_fami" id="localidad_fami" size="50" style="text-transform:uppercase;" /></p>
						<p>Domicilio: <input type="text" name="domicilio_fami" id="domicilio_fami" size="50" style="text-transform:uppercase;" /></p>
				</div>

					</td>
				</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Documentaci&oacute;n Pendiente:</td>
				<td height="15" valign=middle>
				<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="docu_pendiente" style="text-transform:uppercase;"></textarea> 			
			</tr>
	</table>
	
</div> <!-- Cajaempre -->

		<table>
			<tr align="center">
				<td height="15" align="center" valign="middle"><input type="submit" class="grabar" name="graba" value="Grabar" size="10" /></td>
			</tr>
		</table>

</form>

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

			<div id="cajapie"></div>

</div> <!-- CajaPrincipal-->

</div> <!-- contenedor -->

<?
include("includes/footer.php");
}
?>