<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
include ("fciondiamesanio.php");
//include ("fciondiamesanioIni_Nac.php");
include ("fcionzona.php");
include ("fcionlocalidad.php");
include ("fciontipoactividad.php");
include ("fcionbajaEmpre.php");
include ("fcion_dptos_er.php");
include ("fcionmostrarempresa.php");



$cuitEmpre = $_GET["cuitempre"];
$cuil = $_GET["titular"];
$user = $_SESSION["user"];

$cuil_titu = $_POST["cuil_titu"];//agregado
$sqlBusca = "select * from titulares where CUIL = '$cuil_titu'";
$resultBusca = mysql_query($sqlBusca);

$pcias = mysql_query("select * from titulares where CUIL = '$cuil_titu'");
$row=mysql_fetch_assoc($pcias);

$tbmut = $row['TMUT'];
$tbosoc = $row['TOSOC'];
$tbsindi = $row['TSINDI'];

if (mysql_num_rows($resultBusca)==1){

	$alerta='empleExiste';
	header("Location: menu.php?alerta=$alerta");

}

if (($tbmut == 'NO') or ($tbosoc == 'NO') or ($tbsindi == 'NO')){
	$alerta='tituBaja';
	header("Location: menu.php?alerta=$alerta");
}

include ("includes/header.php"); //Encabezado
?>

<script type="text/javascript" src="js/cargarDptos.js"></script>
<script type="text/javascript" src="js/checkcuitl.js"></script>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/vanadium.js"></script>

<script>
function esconde(form)
{
if ((form.cuilemple.value != "") && (form.apelemple.value != "") && (form.nomemple.value != "") && (form.domicilio.value != "") && (form.tel2.value != "")  && (form.docu.value != ""))
{ form.graba.style.visibility = "visible";  document.getElementById("Caja_graba").style.display = 'block'; } else { form.graba.style.visibility = "hidden"; }

}

function agregarEmpresa()
{
	var cont = document.formulario.cuitempreAgre.value;
	
	if (cont == "1"){
		window.open("empresaALTA.php", "_self"); 
	}
}

function checkEmpresa(){
	var tipo1 = document.formulario.cuitempreAgre.value;
	if (tipo1 == '2'){
		alert("ATENCI\u00d3N: Por favor elija una empresa!");
		}
	}

function falta_dni(){
	var falta_dni = document.formulario.dni.value;
	if (falta_dni == 'null'){
		alert("ATENCI\u00d3N: Por favor elija un tipo de DNI!");
		}
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

if(form.pcia.value=="entrerios") { document.getElementById("Cajadptoer").style.display = 'block'; } else { document.getElementById("Cajadptoer").style.display = 'none'; }

}
</script>

<script type="text/javascript">

function altasindical(form) {

if(form.sindi[1].checked) { document.getElementById("Cajaaltasindical").style.display = 'block';
				form.aniosin.value=form.anioIni.value; form.messin.value=form.mesIni.value; form.diasin.value=form.diaIni.value; }
if(form.sindi[0].checked) { document.getElementById("Cajaaltasindical").style.display = 'none'; }

}

</script>

<script type="text/javascript">

function altamutual(form) {

if(form.mut[1].checked) { document.getElementById("Cajaaltamutual").style.display = 'block';
				form.aniomut.value=form.anioIni.value; form.mesmut.value=form.mesIni.value; form.diamut.value=form.diaIni.value; }
if(form.mut[0].checked) { document.getElementById("Cajaaltamutual").style.display = 'none'; }

}

</script>

<div id="contenedor" class="centraTabla">

<div id="cajachicasup"></div>

<!--'document.getElementById(fecha).disabled = true;-->

<div id="cajappal" class='centraTabla'>
<!--
<div id="txt1">
TODOS los campos son OBLIGATORIOS. Deben estar completos para que se guarden</div>
-->
<h1 align="center" class="emple">
Panel de ALTA de AFILIADO || Usuario: <b><? echo $user; ?></b>
</h1>

<? if ($_GET["falto"]=="falta") { ?>
				<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Complete TODOS los Campos Obligatorios ::: </b></span>
			<? } ?>
			
<form action="graba_titu.php" name="formulario" id="formulario" method="POST"> 

<div id="CajaEmple">

<table>

			<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA"> Complete los Datos ANTES de enviar Documentaci&oacute;n a Afiliaciones</td>
			</tr>

			<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA"> MiSimplificaci&oacute;n CCT 40/89 - O.S. 103204</td>
			</tr>
					
			
			
			<!-- Comparar los dos campos según la forma en la cual llegue, 1- desde Alta Empresa cargando los empleados, 
			  	 2- directamente desde el menu alta empleados con una lista desplegable.
			  	 "cuitempreAgre" es el name o la etiqueta POST/GET que envía "mostrarCuitEmpresa"
			  	 y "cuitEmpre" el que cargo manualmente"-->
			<?php if($cuitEmpre == ''){?>
						 <tr ALIGN="center">
			   			 <td height="15" valign=middle class="txt"> CUIT EMPRESA:</td>
						 <td height="15" valign=middle onChange=agregarEmpresa();>
									<? mostrarCuitEmpresa();?>
					     </td>
						 </tr>
				
			<?} else {?> 
					 <tr ALIGN="center">
			   		 <td height="15" valign=middle class="txt">CUIT EMPRESA:</td>
			   		 <td height="15" valign=middle class="txt">
					 <input type="text" name="cuitempre" size="40" maxlength="11" readonly="readonly" 
						value="<?print $cuitEmpre;?>" class=":integer :max_length;11" 
						onFocus="if (this.value=='SIN guiones') this.value='';"/></td>
					 </tr>
			
			<?}?>
			<!-- 			--------------------Acá termina la comprobación del CUIT ---------------------------------- -->
			
  			
  			
  			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"> ····················· DATOS PERSONALES ····················· </td>
			</tr>

			<!-- Cuil afiliado, dato traido 1) del menu de inicio 2) o de alta empresa -->
			
			<? if($cuil == ''){?>
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> CUIL Afiliado:</td>
		 		    <td height="15" valign=middle class="txt" onchange=checkcuitl(); >
					<input type="text" name="cuilemple" size="40" maxlength="11" 
					value="<? import_request_variables("pg","f_"); echo $f_cuil_titu?>" 
					class=":integer :required"  onFocus="if (this.value=='SIN guiones') this.value='';"/></td>
				
			</tr>
			
			<?} else {?> 
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> CUIL Afiliado:</td>
			   <td height="15" valign=middle class="txt" onchange=checkcuitl();>
				<input type="text" name="cuilemple" size="40" maxlength="11" value="<? print $cuil; ?>" class=":required :integer" onFocus="if (this.value=='SIN guiones') this.value='';"/></td>
			</tr>
			<?}?>						
				
			<!--
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Sexo: </td>
			   <td height="15" valign=middle class="txt">
				<select name="sex" id="sex">
                                 	<option value="Null">Seleccione...</option>
                                 	<option value="F">F</option>
                                 	<option value="M">M</option>
				</select>
			    </td>
			</tr>
			-->

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Nacionalidad:</td>
			   <td height="15" valign=middle class="txt">
				<select name="nacio" id="nacio">
                                 	<option value="null">Seleccione Una Opci&oacute;n</option>
                                 	<option value="ARGENTINA">ARGENTINA</option>
                                 	<option value="URUGUAYA">URUGUAYA</option>
                                 	<option value="BRASILERA">BRASILERA</option>
                                 	<option value="BOLIVIANA">BOLIVIANA</option>
                                 	<option value="PARAGUAYA">PARAGUAYA</option>
                                 	<option value="VENEZOLANA">VENEZOLANA</option>
                                 	<option value="OTRA">OTRA</option>
                 </select>

				<!--<input type="text" name="nacio" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" /></td>-->
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Apellido:</td>
			   <td height="15" valign=middle><input type="text" name="apelemple" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" onChange="checkEmpresa(), checkcuitl();"/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Nombres:</td>
			   <td height="15" valign=middle><input type="text" name="nomemple" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" onChange="checkcuitl();"/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> DNI Tipo:</td>

			   <td height="15" valign=middle class="txt">
				<select name="dni" id="dni">
                                 	<option value="null">Selecciona Tipo DNI</option>
                                 	<option value="DU">DU</option>
                                 	<option value="DNI" selected="selected">DNI</option>
                                 	<option value="LE">LE</option>
                                 	<option value="LC">LC</option>
                                 	<option value="PAS">PAS</option>
				</select>
				<span class="req">*</span> Nro: <input type="text" name="docu" size="20" maxlength="11" value="SIN Puntos" class=":required :integer" onChange="falta_dni();" onFocus="if (this.value=='SIN Puntos') this.value='';"/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Fecha Nacimiento:</td>
			    <td height="15" valign=middle>  <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
				<?/* diaNac(); mesNac(); anioNac();*/ ?>
			</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Estado Civil:</td>

			   <td height="15" valign=middle class="txt">
				<select name="civil" id="civil">
                                 	<option value="null">Seleccionar Estado</option>
                                 	<option value="SOLTERO">SOLTERO</option>
                                 	<option value="CASADO">CASADO</option>
                                 	<option value="VIUDO">VIUDO</option>
                                 	<option value="DIVORCIADO">DIVORCIADO</option>
                                 	<option value="UCONVIVENCIAL">U. CONVIVENCIAL</option>
				</select>
			   </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Provincia:</td>

			   <td height="15" valign=middle class="txt">

				<? $pcias=mysql_query("SELECT * from zona ORDER BY NOMZON ASC"); ?>
				<select name="pcia" id="pcia" onchange="cargarDptos(); dptoER(this.form);">
                                 	<option value="null">Selecciona una Provincia!</option>
                                 	<option value="entrerios">ENTRE RIOS</option>
<!--
           	 				<? while($row=mysql_fetch_assoc($pcias)){
					print '<option value="'.strtolower($row['NOMZON']).'" >'.$row['ZONA']." - ".$row['NOMZON'].'</option>';
											} ?>
-->
				</select>

				</td>
			</tr>


			<tr ALIGN="center">
			    	<td height="15" valign=middle colspan="2"> 
					      <div id="Cajadptoer" style="display:none;" class="txt">Dpto. Entre R&iacute;os <? dpto_er(); ?></div>
				</td>
			</tr>


			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Localidad / C.P.:</td>

			   	<td height="15" valign=middle class="txt">
					<select name="localidad" id="departamento">
                                		<option value="null">Selecciona una localidad:</option>
           				</select>
				</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Domicilio:</td>

					      
			<td height="15" valign=middle><input type="text" name="domicilio" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Tel. Fijo:</td>


			<td height="15" valign=middle><input type="text" name="tel1" size="40"/>
                         </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Tel. Celu.:</td>


			<td height="15" valign=middle><input type="text" name="tel2" size="40" onkeyup="esconde(this.form)" class=":required"/>
                         </td>
			</tr>
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Mail contacto:</td>

					      
			<td height="15" valign=middle><input type="email" name="mail" size="40" maxlength="50" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"> ····················· DATOS LABORALES	 ····················· </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Categoría Laboral:</td>
					      
			   <td height="15" valign=middle> <? tipoactividad(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Inicio Activ.:</td>
			
			<td height="15" valign=middle>
				 <input type="date" name="fecha_afip" id="fecha_afip">
				<? /*diaIni(); mesIni(); anioIni();*/ ?> <strong>(Alta Temprana AFIP)</strong>
			</td>
			</tr>
			
			<tr ALIGN="center"><td height="15" valign=middle class="txt">Recibo Haberes Observaci&oacute;n: </td>
			<td height="15" valign=middle><TEXTAREA rows="4" cols="36" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="observa_haberes" style="text-transform:uppercase">...</TEXTAREA>
			</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"> ····················· DATOS FILIATORIOS	 ····················· </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Tipo Afiliado:</td>

			   <td height="15" valign=middle class="txt">
				<select name="t_afi" id="t_afi">
                                 	<option value="null">Seleccionar Tipo</option>
                                 	<option value="ACTIVO">ACTIVO</option>
                                 	<option value="JUBILADO">JUBILADO</option>
                                 	<option value="ADHERENTE">ADHERENTE</option>
                                 	<option value="SIN EMPLEO">SIN EMPLEO</option>
                                 	<option value="CONTRATADO">CONTRATADO</option>
                                 	<option value="P.M.O.">P.M.O.</option>
                                 	<option value="NO AFILIADO">NO AFILIADO</option>
                                 	<option value="CICLICO">CICLICO</option>
                                 	<option value="PENSIONADA">PENSIONADA</option>
                                 	<option value="APORT S/DJ">APORT S/DJ</option>
				</select>
			   </td>
			</tr>

			<tr ALIGN="center">

			   <td height="15" valign=middle class="txt1" colspan="2" class="txt">Origen O.S.:
				<select name="orig_os" id="orig_os" OnChange="desactivar(this.form)">
                                 	<option value="null">Seleccionar Tipo</option>
                                 	<option value="CAMIONERO">O.S. 103204</option>
                                 	<option value="OPCION">OPCIÓN</option>
                                 	<option value="MT">MONOTRIBUTISTA</option>
                                 	<option value="UNIFICACION">UNIFICACIÓN</option>
                                 	<option value="DESEMPLEADO">DESEMPLEADO</option>
                                 	<option value="OTRA">OTRA</option>
				</select>
			<div id="Cajadesempleado" style="display:none;" class="txt">
						<p>Desde: <input type="text" name="diad" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/> - <input type="text" name="mesd" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/> - <input type="text" name="aniod" size="4" value="Anio" onFocus="if (this.value=='Anio') this.value='';"/></p>
						<p>Hasta: <input type="text" name="diah" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/> - <input type="text" name="mesh" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/> - <input type="text" name="anioh" size="4" value="Anio" onFocus="if (this.value=='Anio') this.value='';"/></p>
			</div>
			   </td>
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class="txt1" colspan="2" class="txt">SINDICATO: 
				<input type="Radio" name="sindi" value="NO" checked id="sindi" OnClick="altasindical(this.form)"> NO 
				<input type="Radio" name="sindi" value="SI" id="sindi"  OnClick="altasindical(this.form)"> SI
				<div id="Cajaaltasindical" style="display:none;" class="txt">
						<p>Fecha Alta: <input type="text" name="diasin" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/>
							 - <input type="text" name="messin" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/>
							 - <input type="text" name="aniosin" size="4" value="Anio" value="Anio" onFocus="if (this.value=='Anio') this.value='';"/></p>
				</div>
			   </td>
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class="txt1" colspan="2">MUTUAL: 
				<input type="Radio" name="mut" value="NO" checked id="mut" OnClick="altamutual(this.form)"> NO 
				<input type="Radio" name="mut" value="SI" id="mut"  OnClick="altamutual(this.form)"> SI
				<div id="Cajaaltamutual" style="display:none;" class="txt">
						<p>Fecha Alta: <input type="text" name="diamut" size="2" value="D&iacute;a" onFocus="if (this.value=='D&iacute;a') this.value='';"/> - <input type="text" name="mesmut" size="2" value="Mes" onFocus="if (this.value=='Mes') this.value='';"/> - <input type="text" name="aniomut" size="4" value="Anio" onFocus="if (this.value=='Anio') this.value='';"/></p>
				</div>
			   </td>
			</tr>
		
		<tr ALIGN="center"><td height="15" valign=middle class="txt">Observaci&oacute;n: </td>
			<td height="15" valign=middle><TEXTAREA rows="4" cols="36" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obnserva01" style="text-transform:uppercase">...</TEXTAREA>
			</td>
			</tr>
		</table>

</div> <!-- CajaEmpre -->

<div id="Caja_graba"  style="display:none;" class="centraTabla">

<table>
	<tr ALIGN="center">
			    <td height="15" valign=middle> 
				<input type="submit" name ="graba" value="Grabar" size="10" class="grabar" style="visibility: hidden"/>
				<input name="cargaflia" type="checkbox" value="SI"/>Cargar Flia.
			    </td>
	</tr>
</table>

</div>

</form>

<table >

		<tr>
			<td width="" height="23" align="center" valign="middle">
				<button onclick="window.location.href='menu.php'" class="inicio">Inicio</button> 
				
			<td width="" height="23" align="center" valign="middle">
			<button onclick="window.location.href='cerro.php'" class="salir">Salir</button>
			
			</td>
		</tr>

</table>




<div id="cajapie"></div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->
<?php include("includes/footer.php");
}
?>