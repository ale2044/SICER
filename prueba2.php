<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
//include ("fciondiamesanio.php");
//include ("fciondiamesanioIni_Nac.php");
include ("fcionzona.php");
include ("fcionlocalidad.php");
include ("fcionbajaEmpre.php");
include ("fcion_dptos_er.php");
include ("fciones/fciontipodoc.php");

$user = $_SESSION["user"];
$cuil = $_GET["titular"];


?> 

<?include("includes/header.php");?>

<script type="text/javascript" src="js/checkcuitl.js"></script>
<script type="text/javascript" src="js/cargarDptos.js"></script>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/vanadium.js"></script>

<script type="text/javascript" >
function esconde(form)
{
if ((form.apel_fami.value != "") && (form.nom_fami.value != "") && (form.cuil_fami.value != ""))
{ form.graba.style.visibility = "visible"; } else { form.graba.style.visibility = "hidden"; }
}
</script>

<script type="text/javascript">
function desactivar(form) {

if (form.orig_os.value=="DESEMPLEADO") { document.getElementById("Cajadesempleado").style.display = 'block'; }
					 else { document.getElementById("Cajadesempleado").style.display = 'none'; }

}
</script>

<script type="text/javascript">
function dptoER(form) {

if(form.pcia.value=="ENTRE RIOS") { document.getElementById("Cajadptoer").style.display = 'block'; } else { document.getElementById("Cajadptoer").style.display = 'none'; }

}
</script>

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

<script type="text/javascript">
function pmi_ver(form)
{
if (form.sex.value == "F"){ document.getElementById("Caja_pmi").style.display = 'block'; } else { document.getElementById("Caja_pmi").style.display = 'none'; }

}
</script>

<script type="text/javascript">
function pmi_fecha(form)
{
if(document.getElementById('pmi').checked) { form.dia_pmi.style.visibility = "visible"; form.mes_pmi.style.visibility = "visible"; form.anio_pmi.style.visibility = "visible"; } else {
 					      form.dia_pmi.style.visibility = "hidden";
					      form.mes_pmi.style.visibility = "hidden";
					      form.anio_pmi.style.visibility = "hidden"; }
}

</script>

<script type="text/javascript">

function domi_fami(form)
{
if(document.getElementById('otro_domi').checked) { document.getElementById("Caja_otro_domi").style.display = 'block'; } else {
						   document.getElementById("Caja_otro_domi").style.display = 'none'; }

}

</script>

<div id="contenedor">

<div id="cajachicasup"></div>

<div id="cajappal" class='centraTabla'>

<div id="txt1">
TODOS los campos son OBLIGATORIOS. Deben estar completos para que se guarden
</div>

<h1 align="center" class="emple">Panel de ALTA de FAMILIARES || Usuario: <b><? echo $user; ?></b></h1>

<? if ($_GET["falto"]=="falta") { ?>
				<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Complete TODOS los Campos Obligatorios ::: </b></span>
			<? } ?>	

<form action="prueba.php" name="formulario" id="formulario" method="POST">

<div id="CajaFami" class='centraTabla'>
		<table>
			<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA"> Complete los Datos ANTES de enviar Documentaci&oacute;n a Afiliaciones</td>
			</tr>

			<tr ALIGN="center">
			   		 <td height="15" valign=middle class='txt'>CUIT TITULAR:</td>
			   		 <td height="15" valign=middle>
					 <input type="text" name="cuil_titu" size="40" maxlength="11" readonly="readonly" 
						value="<?print $cuil;?>" class=":integer :max_length;11" 
						onFocus="if (this.value=='SIN guiones') this.value='';"/></td>
			</tr>
			
						
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'> ····················· DATOS PERSONALES FAMILIAR····················· </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'><span class="req">*</span> Apellido:</td>
			   <td height="15" valign=middle><input type="text" name="apel_fami" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'><span class="req">*</span> Nombres:</td>
			   <td height="15" valign=middle><input type="text" name="nom_fami" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> CUIL:</td>
			   <td height="15" valign=middle class="txt" onchange=checkcuitlfam();>
				<input type="text" name="cuil_fami" size="20" maxlength="11" value="SIN GUION"  class=":required :integer" onFocus="if (this.value=='SIN GUION') this.value='';"/>
			   </td>
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
			    <td height="15" valign=middle class='txt'> Nacionalidad:</td>
			   <td height="15" valign=middle class="txt">
				<select name="nacio" id="nacio">
                                 	<option value="Null">Seleccione Una Opci&oacute;n</option>
                                 	<option value="ARGENTINA">ARGENTINA</option>
                                 	<option value="URUGUAYA">URUGUAYA</option>
                                 	<option value="OTRA">OTRA</option>
				</select>

			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'><span class="req">*</span> DNI Tipo:</td>

			   <td height="15" valign=middle class="txt">
				<? tipodoc(); ?>
				<span class="req">* </span>Nro: <input type="text" name="docu" size="20" maxlength="11" value="SIN Puntos" class=":required :integer" onFocus="if (this.value=='SIN Puntos') this.value='';" OnChange="esconde(form);" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'><span class="req">*</span> Fecha Nacimiento:</td>
			
			<td height="15" valign=middle>
				<input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
				<?// diaNac(); mesNac(); anioNac(); ?>
			</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><span class="req">*</span> Tipo Parentesco:

				<? $resultados = mysql_query("select cod_paren, desc_paren from parentesco order by cod_paren asc"); ?>

				<select size="1" name="tipoparen" style="width:300px" OnChange="activar(this.form);">

					<? while ($myrow=mysql_fetch_array($resultados))
						{ ?>

						<option value="<? echo $myrow[cod_paren]; ?>"><? echo $myrow[desc_paren]; ?> </option>

						<? } ?>
				</select>

				<div id="Caja_estudio" style="display:none;" class='txt'><h2> E S T U D I O </h2>
						<p>Emitido: <input type="text" name="dia_est" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/> - <input type="text" name="mes_est" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/> - <input type="text" name="anio_est" size="4" value="Anio" onFocus="if (this.value=='Anio') this.value='';"/></p>
						<p>Vencimiento: <input type="text" name="dia_est_vto" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/> - <input type="text" name="mes_est_vto" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/> - <input type="text" name="anio_est_vto" size="4" value="Anio" onFocus="if (this.value=='Anio') this.value='';"/></p>

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
						<p>Emitido: <input type="text" name="dia_disc" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/> - <input type="text" name="mes_disc" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/> - <input type="text" name="anio_disc" size="4" value="Anio" onFocus="if (this.value=='Anio') this.value='';"/></p>
						<p>Vencimiento: <input type="text" name="diaVto_disc" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/> - <input type="text" name="mesVto_disc" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/> - <input type="text" name="anioVto_disc" size="4" value="Anio" onFocus="if (this.value=='Anio') this.value='';"/></p>
						<p>Descripci&oacute;n: <input type="text" name="descrpcion_disc" size="50" maxlength="150" style="text-transform:uppercase;" /></p>

				</div>

				<div id="Caja_pmi" style="display:none;" class='txt'>P.M.I. -Con FPP- <input type="checkbox" name="pmi" id="pmi" value="SI" onclick="pmi_fecha(this.form)" >
						<input type="text" name="dia_pmi" id="dia_pmi" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';" style="visibility: hidden">
						<input type="text" name="mes_pmi" id="mes_pmi" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';" style="visibility: hidden">
						<input type="text" name="anio_pmi" id="anio_pmi" size="4" value="Anio" onFocus="if (this.value=='Anio') this.value='';" style="visibility: hidden">
				</div>

						<p>Documentaci&oacute;n Pendiente: <input type="text" name="docu_pendiente" size="100"  maxlength="150" style="text-transform:uppercase;" /></p>
						<p>Otro Domicilio: <input type="checkbox" name="otro_domi" id="otro_domi" onclick="domi_fami(this.form)" /></p>
					
				<div id="Caja_otro_domi" style="display:none;" class='txt'>
						<p>Provincia: <input type="text" name="pcia_fami" id="pcia_fami" size="50" style="text-transform:uppercase;"/></p>
						<p>Departamento: <input type="text" name="pto__fami" id="pto__fami" size="50" style="text-transform:uppercase;"/></p>
						<p>Localidad: <input type="text" name="localidad_fami" id="localidad_fami" size="50" style="text-transform:uppercase;" /></p>
						<p>Domicilio: <input type="text" name="domicilio_fami" id="domicilio_fami" size="50" style="text-transform:uppercase;" /></p>
				</div>

						<!-- CheckBox para cargar otro familiar-->
						<p>Cargar otro familiar: <input name="carga_fami" type="checkbox" checked="checked" value="carga_fami"/></p>
				
				</td>
			   


			</tr>
</table>

</div> <!-- Caja Fami -->
	<table>
		<tr ALIGN="center">
				    <td height="15" valign=middle> 
		<input type="submit" name="graba" class='grabar' value="Grabar" size="10" style="visibility: hidden" />
	 				</td>	
	 	</tr>
	</table>
</form>

<div id="cajapie" class='centraTabla'>
<table>

		<tr>
			<td width="" height="23" align="center" valign="middle">
				<button onclick="window.location.href='menu.php'" class='inicio'>Inicio</button>
			</td>

			<td width="" height="23" align="center" valign="middle">
				<button onclick="window.location.href='cerro.php'" class='salir'>Salir</button>
			</td>
		</tr>

</table>
</div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->
<? include("includes/footer.php");
}
?>
