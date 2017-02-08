<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
include ("fciondiamesanio.php");
include ("fcionzona.php");
include ("fcionlocalidad.php");
include ("fcionbajaEmpre.php");
include ("fcion_dptos_er.php");

$user = $_SESSION["user"];
$cuit_emp = $_GET["cuit_empre"];
?> 

<?include("includes/header.php");?>

<script type="text/javascript" src="cargarDptos.js"></script>

<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>

<script>
function esconde(form)
{
if ((form.cuitestudio.value != "") && (form.nomestudio.value != "") && (form.domicilio.value != "") && (form.tel1.value != ""))
{ form.graba.style.visibility = "visible"; }

else {
form.graba.style.visibility = "hidden"; }
}

function muestra_dpto(form)
{
if (form.pcia.value == "ENTRE RIOS") { document.getElementById("Cajadptoer").style.display = 'block'; }
					 else { document.getElementById("Cajadptoer").style.display = 'none'; }
}
</script>

<div id="contenedor">

<div id="cajachicasup"></div>

<div id="cajappal" class="centraTabla">
<div id="txt1">
(<span class="req">*</span>) TODOS los campos que son OBLIGATORIOS deben estar completos para que se guarden.</div>
<h1 align="center">
Panel de ALTA para Centros Contables || Usuario: <b><? echo $user; ?></b>
</h1>

<? if ($_GET["falto"]=="falta") { ?>
				<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Complete TODOS los Campos Obligatorios ::: </b></span>
			<? } ?>	

<form action="graba_conta.php" name="formulario" id="formulario" method="POST" > 

<div id="CajaEmpre" class="centraTabla">

			<!-- Guarda en Buffer el CUIT de la empresa y el lugar -->
			<input type="hidden" name="sitio" size="40" maxlength="11" value="<? print $_GET['lugar']; ?>"/>
			<input type="hidden" name="buff_cuit_empre" size="40" maxlength="11" value="<? print $_GET['cuit_empre']; ?>"/>

<table>

			<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA">Complete los Datos del Estudio Contable</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> CUIT:</td>
			
			   <td height="15" valign=middle>
				<input type="text" name="cuitestudio" size="40" maxlength="11" value="SIN guiones" class=":integer :required"  onFocus="if (this.value=='SIN guiones') this.value='';"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Nombre:</td>
			   <td height="15" valign=middle><input type="text" name="nomestudio" style="text-transform:uppercase;" size="40" maxlength="50" class=":required" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Provincia: </td>
			    <td height="15" valign=middle>
			   
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
			    <td height="15" valign=middle class="txt">Localidad / C.P.</td>

			   	<td height="15" valign=middle>
					<select name="departamento" id="departamento">
                                		<option value="null">Selecciona una localidad</option>
           				</select>
				</td>
			</tr>

			<tr ALIGN="center">
			    	<td height="15" valign=middle colspan="2"> 
					      <div id="Cajadptoer" style="display:none;" class="txt">Dpto. Entre R&iacute;os <? dpto_er(); ?></div>
				</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Domicilio:</td>
				<td height="15" valign=middle><input type="text" name="domicilio" size="40" maxlength="50" class=":required"  style="text-transform:uppercase;" /></td>
			</tr>

			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Tel&eacute;fono #1:</td>
				<td height="15" valign=middle><input type="text" name="tel1" size="40" maxlength="50" class=":required" onkeyup="esconde(this.form)" />
                         </td>
			</tr>


			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Mail contacto: </td>
				<td height="15" valign=middle><input type="email" name="mail" size="40" maxlength="50" />
			</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"> Observaci&oacute;n : <input type="text" name="obser" size="60" style="text-transform:uppercase;" />
                </td>
			
</table>

</div> <!-- CajaEmpre -->

<table>
	<tr ALIGN="center">
			    <td height="15" valign=middle> 
				<input type="submit" name ="graba" class="grabar" value="Grabar" size="10" style="visibility: hidden"/>
				
			    </td>
	</tr>
</table>
</form>
<div id="cajapie" class="centraTabla">
<table>
		<tr>
		<td width="110" height="23" align="center" valign="middle">
		
				<?php 
				if ($_GET['lugar']=='editar'){?>
					<!-- <a href="empresaEDITAR.php?cuit_empre=<?php //print $cuit_emp;?>" class='cancelar'>Cancelar</a> -->
				<!-- En este caso como el formulario debe enviar un POST, debí crear un formulario diferente -->
				<form method="post" action="empresaEDITAR.php?cuit_empre=<?php print $cuit_emp;?>">
					<input type="hidden" name="cuit_empre" value="<?php print $cuit_emp;?>" />
					<input type="submit" value="Cancelar" class='cancelar' />
				</form>
				<?php }

				if ($_GET['lugar']=='gestion'){?>
				<a href="empresaGESTION.php?empresa=<?php print $cuit_emp;?>" class='cancelar'>Cancelar</a>
				<?php }
				if ($_GET['lugar']=='alta'){?>
				<a href="empresaALTA.php?cuit_empre=<?php print $cuit_emp;?>" class='cancelar'>Cancelar</a>
				<?php }
		?>	
		</td>
					
		</tr>

</table>
</div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->

<?php include("includes/footer.php");
}
?>