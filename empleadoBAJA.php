<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
include ("conexion.inc.php");
include ("fciondiamesanio.php");
include ("fciondiamesanioIni_Nac.php");
include ("fcionzona.php");
include ("fcionlocalidad.php");
include ("fciondiamesanioIni_Sis.php");
include ("fcion_dptos_er.php");
include ("fcionbajaEmple.php");

$user = $_SESSION["user"];
$cuil_titu = $_POST["cuil_titu"];


$sqlBusca="select CUIL from titulares where CUIL='$cuil_titu'";
$resultBusca=mysql_query($sqlBusca, $link);

if(mysql_num_rows($resultBusca)==1){
$pcias=mysql_query("SELECT * from titulares WHERE CUIL='$cuil_titu' ");
$row=mysql_fetch_assoc($pcias);

$tbmut = $row['TMUT'];
$tbosoc = $row['TOSOC'];
 
if (isset($row['TSINDI'])){
	$tbsindi = 'NO';
} else $tbsindi = $row['TSINDI'];

$fbajaos = $row['FECBAJAOS'];
$fbajamut = $row['TFECBAJM'];	
$fbajasindi = $row['TFECBAJS'];

$tbcuit = $row['CUITEMPRESA'];

$empresa=mysql_query("SELECT NOMBRE, SUSS from empresas WHERE SUSS='$tbcuit' ");
$row_empre=mysql_fetch_assoc($empresa);

$tbfing = $row['TFING'];//fecha de ingreso a la empresa
$tbcaterialab = $row['TIPOACT'];//categoria laboral
$tbiniact = $row['INIACT'];// inicio de actividad
$tbtafil = $row['TLETT'];//tipo de afiliado
$tborigenOS = $row['ORIGENOS']; //origen de la obra social
$tbdesdedes = $row['DESEMDESDE'];
$tbhastades = $row['DESEMHASTA'];
$tbaltaSindi = $row['TFINS']; //ingreso al sistema sindical
$tbaltamutual = $row['TFINMUTUAL'];//ingreso a la mutual
$ndoc = $row['TNDOC'];
$nafil = $row['TNAFI'];

$marc = $row['TMARC'];


if ((($tbmut == 'NO') and ($tbosoc == 'NO') and ($tbsindi == 'NO')) or ($marc == '*')){
	$alerta='tituBaja_B';
	header("Location: menu.php?alerta=$alerta");
}
?>

<script type="text/javascript" src="cargarDptos.js"></script>

<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>

<script type="text/javascript">
function emple_todo(form)
{
	if(document.getElementById('baja_todo').checked) { document.getElementById("Caja_emple_todo").style.display = 'block'; } else {
		document.getElementById("Caja_emple_todo").style.display = 'none'; }
}

function emple_parcial(form)
{
	if(document.getElementById('baja_parcial').checked) { document.getElementById("Caja_emple_parcial").style.display = 'block'; } else {
		document.getElementById("Caja_emple_parcial").style.display = 'none'; }
}
function fecha_sindicato(form)
{
	if(document.getElementById('fecha_sindi').checked) { document.getElementById("Caja_parcial_sindi").style.display = 'block'; } else {
		document.getElementById("Caja_parcial_sindi").style.display = 'none'; }
}

function fecha_mutual(form)
{
	if(document.getElementById('fecha_mut').checked) { document.getElementById("Caja_parcial_mutual").style.display = 'block'; } else {
	   document.getElementById("Caja_parcial_mutual").style.display = 'none'; }
}

function fecha_obrasocial(form)
{
	if(document.getElementById('fecha_osocial').checked) { document.getElementById("Caja_parcial_osocial").style.display = 'block'; } else {
		document.getElementById("Caja_parcial_osocial").style.display = 'none'; }
}

/*Oculta la caja parcial*/	
function ocultar_cp(form){
	if(document.getElementById('baja_todo').checked){
		document.getElementById("caja_parcial").style.display = 'none';
	}else {document.getElementById("caja_parcial").style.display = 'block';}
}

/*Oculta la caja total*/
function ocultar_ct(form){
	if(document.getElementById('baja_parcial').checked){
		document.getElementById("caja_todo").style.display = 'none';
	}else {document.getElementById("caja_todo").style.display = 'block';}
}

/*Valida las opciones de baja parcial*/
function validarparcial(form){

	if(document.getElementById('fecha_sindi').checked && document.getElementById('fecha_osocial').checked){
				document.getElementById('fecha_mut').style.display ='none';
		} else {document.getElementById('fecha_mut').style.display = 'block';}

	if(document.getElementById('fecha_osocial').checked && document.getElementById('fecha_mut').checked){
				document.getElementById('fecha_sindi').style.display ='none';//	alert('Solo debe seleccionar dos opciones');
		} else {document.getElementById("fecha_sindi").style.display = 'block';}

	if(document.getElementById('fecha_sindi').checked && document.getElementById('fecha_mut').checked){
				document.getElementById('fecha_osocial').style.display ='none';	//alert('Solo debe seleccionar dos opciones');
		} else {document.getElementById("fecha_osocial").style.display = 'block';}
}


</script>

<?include("includes/header.php");?>

<div id="contenedor">
<div id="cajachicasup"></div>
<div id="cajappal" class='centraTabla'>

<h1 align="center" class="emple">
Panel de BAJA de AFILIADO || Usuario: <b><? echo $user; ?></b>
</h1>

<? if ($_GET["falto"]=="falta") { ?>
				<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Complete TODOS los Campos Obligatorios ::: </b></span>
			<? } ?>
			
		<!--	baja_emple.php-->
<form action="baja_emple.php" name="formulario" id="formulario" method="POST"> 
<div id="CajaNotificacion"><div class="txt1">CUIL y AFILIADO A DAR BAJA:<strong> <? print $cuil_titu; print " || ".$row["TAPEL"]." ".$row["TNOMB"]; ?></strong></div>

<br>Nombre de la EMPRESA: <strong> "<?print $row_empre['NOMBRE'];?>"</strong>
<br>Sindicato: <strong> "<?if(($row['TSINDI']) == ""){ print "NO";}
			else{
				print $row['TSINDI'];
				}?>"</strong> 
<br>Obra Social: <strong> "<?print $row['TOSOC'];?>"</strong>
<br>AMUTCAER: <strong> "<?print $row['TMUT'];?>"</strong>

</div>

<div id="CajaEmple">

<input type="hidden" name="cuitempresa" size="40" maxlength="11"  value="<? print $tbcuit; ?>"/>
<input type="hidden" name="tfing" size="40" maxlength="11"  value="<? print $tbfing; ?>"/>
<input type="hidden" name="tipoact" size="40" maxlength="11"  value="<? print $tbcaterialab; ?>"/>
<input type="hidden" name="iniact" size="40" maxlength="11"  value="<? print $tbiniact; ?>"/>
<input type="hidden" name="tlett" size="40" maxlength="11"  value="<? print $tbtafil; ?>"/>
<input type="hidden" name="origenos" size="40" maxlength="11"  value="<? print $tborigenOS; ?>"/>
<input type="hidden" name="desemdesde" size="40" maxlength="11"  value="<? print $tbdesdedes; ?>"/>
<input type="hidden" name="desemhasta" size="40" maxlength="11"  value="<? print $tbhastades; ?>"/>
<input type="hidden" name="tfins" size="40" maxlength="11"  value="<? print $tbaltaSindi; ?>"/>
<input type="hidden" name="tfinmutual" size="40" maxlength="11"  value="<? print $tbaltamutual; ?>"/>
<input type="hidden" name="ndoc" size="40" maxlength="11"  value="<? print $ndoc; ?>"/>
<input type="hidden" name="nafil" size="40" maxlength="11"  value="<? print $nafil; ?>"/>

<input type="hidden" name="bufmut" size="40" maxlength="11"  value="<? print $tbmut; ?>"/>
<input type="hidden" name="bufosoc" size="40" maxlength="11"  value="<? print $tbosoc; ?>"/>
<input type="hidden" name="bufsindi" size="40" maxlength="11"  value="<? print $tbsindi; ?>"/>

<input type="hidden" name="fbufmut" size="40" maxlength="11"  value="<? print $fbajamut; ?>"/>
<input type="hidden" name="fbufosoc" size="40" maxlength="11"  value="<? print $fbajaos; ?>"/>
<input type="hidden" name="fbufsindi" size="40" maxlength="11"  value="<? print $fbajasindi; ?>"/>

<table>
	<tr><td height="15"  WIDTH=300 valign=middle class='txt'><br></td></tr>	
	<tr ALIGN="center" valign=middle>
		<td height="15"  WIDTH=300 valign=middle class='txt'>CUIL: </td>
		<td height="15"  WIDTH=300 valign=middle class="txt">
		<input type="text" name="cuilpersona" size="40" maxlength="11"  value="<? print $row['CUIL']; ?>"
					class=":integer :max_length;11"  readonly="readonly" />
		</td>
	</tr>
	  
	<tr ALIGN="center">
	    	 <td height="15" valign=middle class='txt'> MOTIVO DE BAJA:</td>
			 <td height="15" valign=middle>	<? listbajaEmple();?> </td>
	</tr>

</table>

<br><br>
<hr width="60%">

		<!-- Baja Empleado Seleccionar TODO -->
		<div id="caja_todo" class='txt'>
			Todo: <input type="checkbox" name="baja_todo" id="baja_todo" onclick="emple_todo(this.form), ocultar_cp(this.form)"/>
						<div id="Caja_emple_todo" style="display:none;">
			Fecha Baja: <input type="text" name="diatodo" size="2" maxlength="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/>
					 - <input type="text" name="mestodo" size="2" maxlength="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/>
					 - <input type="text" name="aniotodo" size="4" maxlength="4" value="A&ntilde;o" onFocus="if (this.value=='A&ntilde;o') this.value='';"/>
						</div>
		</div><!-- Termina la caja_todo -->

	 
		
		<!-- Baja Empleado Seleccionar PARCIAL -->
		<div id="caja_parcial"  class='txt'>
			Parcial: <input type="checkbox" name="baja_parcial" id="baja_parcial" onclick="emple_parcial(this.form), ocultar_ct(this.form)"/>
						<div id="Caja_emple_parcial" style="display:none;">
							
							<table>
							<tr>
							<td><b>Sindicato: </b>
							<? if ((($row['TSINDI'])=='NO') or (($row['TSINDI'])=='')){
														print " Fue dado de baja o no está afiliado.";
								} else {?>

							<input type="checkbox" name="check_sindi" id="fecha_sindi" onclick="fecha_sindicato(this.form), validarparcial(this.form)"/></td>
								<td><div id="Caja_parcial_sindi" style="display:none;">
								<p>Fecha Baja: <input type="text" name="diasin" size="2" maxlength="2"  value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/>
							 	- <input type="text" name="messin" size="2" value="Mes" maxlength="2" onFocus="if (this.value=='Mes') this.value='';"/>
							 	- <input type="text" name="aniosin" size="4" value="A&ntilde;o" maxlength="4"  onFocus="if (this.value=='A&ntilde;o') this.value='';"/></p>
								</div>
							</td><? } ?>
							</tr>
							
							<tr>
							<td><b>Obra Social: </b>
							<? if ((($row['TOSOC'])=='NO') or (($row['TOSOC'])=='')){
														print " Fue dado de baja o no está afiliado.";
								} else {?>
							<input type="checkbox" name="check_osocial" id="fecha_osocial" onclick="fecha_obrasocial(this.form), validarparcial(this.form)"/></td>
								 <td><div id="Caja_parcial_osocial" style="display:none;">
								<p>Fecha Baja: <input type="text" name="diaosoc" size="2" value="D&iacute;a" maxlength="2" onFocus="if (this.value=='D&iacute;a') this.value='';"/>
							 	- <input type="text" name="mesosoc" size="2" value="Mes" maxlength="2" onFocus="if (this.value=='Mes') this.value='';"/>
							 	- <input type="text" name="anioosoc" size="4" value="A&ntilde;o" maxlength="4" onFocus="if (this.value=='A&ntilde;o') this.value='';"/></p>
								</div>
							</td><? } ?>
							</tr>

							<tr>
							<td><b>Mutual: </b>
							<? if ((($row['TMUT'])=='NO') or (($row['TMUT'])=='')){
														print " Fue dado de baja o no está afiliado.";
								} else {?>
							<input type="checkbox" name="check_mut" id="fecha_mut" onclick="fecha_mutual(this.form), validarparcial(this.form)"/></td>
								<td><div id="Caja_parcial_mutual" style="display:none;">
								<p>Fecha Baja: <input type="text" name="diamut" size="2" value="D&iacute;a" maxlength="2" onFocus="if (this.value=='D&iacute;a') this.value='';"/>
							 	- <input type="text" name="mesmut" size="2" value="Mes" maxlength="2" onFocus="if (this.value=='Mes') this.value='';"/>
							 	- <input type="text" name="aniomut" size="4" value="A&ntilde;o" maxlength="4" onFocus="if (this.value=='A&ntilde;o') this.value='';"/></p>
							 	</div>
							</td><? } ?>
							</tr>
							</table>
							
						</div>
		</div><!-- Termina caja_parcial -->
						


</div> <!-- CajaEmpre -->



							 		<!-- Botón grabar... -->
<div id="Caja_graba" >

<table>
	<tr ALIGN="center">
			    <td height="15" valign=middle> 
				<input type="submit" name ="graba" value="Grabar" class='grabar' size="10"/>
				</td>
	</tr>
</table>

</div>

</form>
						 		<!-- Pie de página, cerrar sesión... -->
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




<div id="cajapie"></div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->

<?
}else 
{
	$alerta=411; //El emppleado NO existe;
	header("Location: menu.php?alerta=$alerta");	
}

 include("includes/footer.php");
}
?>