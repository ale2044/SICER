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
include ("fciontipoactividad.php");
include ("fcionbajaEmpre.php");
include ("fcionEstudioContable.php");
include ("fcionfilial.php");

$user = $_SESSION ["user"];
$cuil_titu = $_POST ["titular"];
$cuil_buffer = $_POST ["titular"];

$sqlBusca="select cuil from titudesdefilial where cuil='$cuil_buffer'";
$resultBusca=mysql_query($sqlBusca);

if (mysql_num_rows($resultBusca)==1){
	$pcias = mysql_query ( "SELECT * from titudesdefilial WHERE cuil='$cuil_buffer'" );
	$row = mysql_fetch_assoc ( $pcias );
}else
{
	$alerta='seleccionar';
	header("Location: gestionar_titu.php?alerta=$alerta");
}

/* PARA MOSTAR EL NOMBRE DE LA EMPRESA */
$tbcuit = $row['cuitempresa'];
$empresa = mysql_query("SELECT NOMBRE, SUSS from empresas WHERE SUSS='$tbcuit' ");
$row_empre=mysql_fetch_assoc($empresa);
/* ----------------------------------- */
?>

<?include("includes/header.php");?>

<script type="text/javascript">
function pmi_ver(form)
{
if (form.sex.value == "F"){ document.getElementById("Caja_pmi").style.display = 'block'; } else { document.getElementById("Caja_pmi").style.display = 'none'; }

}
</script>

<script type="text/javascript">
function pmi_fecha(form)
{
if(document.getElementById('pmi').checked) { form.fecha_pmi.style.visibility = "visible"; } else {
 					      form.fecha_pmi.style.visibility = "hidden"; }
}
</script>

	<div id="contenedor">
	<div id="cajachicasup"></div>
		<div id="cajappal" class='centraTabla'>
			<h1 align="center">
				Panel de GESTI&Oacute;N de Datos: TITULARES || Usuario: <b><? echo $user; ?></b>
			</h1>
	<!--	grabar_act_titu.php -->
<form action="grabar_act_titu.php" name="formulario" id="formulario" method="POST">
	
	<div id="CajaEmpre" class="centraTabla">
		<!-- Guarda en Buffer el CUIL -->
		<input type="hidden" name="cuil_buffer" size="40" maxlength="11" value="<? print $cuil_buffer; ?>" class=":integer :max_length;11" />
		<!-- Guarda el usuario -->
		<input type="hidden" name="usuario_filial" size="40" maxlength="11" value="<? print $row['usuario']; ?>" class=":integer :max_length;11" />
						
		<table>
			<tr align="center">
				<td colspan="2" height="20" valign=middle bgcolor="#EFEEDA">Seleccione el campo que desee modificar</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br> ····················· DATOS PERSONALES	 ····················· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt"><span class="req">*</span> CUIL TITULAR:</td>
				<td height="15" valign=middle><input type="text" name="cuiltitu" size="40" maxlength="11"	value="<? print $row['cuil']; ?>"
						class=":integer :max_length;11 :required" />
				</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></td>
			</tr>
					
			<tr align="center">
				<td height="15" valign=middle class="txt">Apellido:</td>
				<td height="15" valign=middle><input type="text" name="apellido" size="40"	style="text-transform: uppercase;"	value="<? print utf8_decode($row['apellido']); ?>" /></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Nombres:</td>
				<td height="15" valign=middle><input type="text" name="nombres" size="40"	style="text-transform: uppercase;"	value="<? print utf8_decode($row['nombres']); ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Tipo de documento:</td><td height="15" valign=middle class="txt">
				<input type="text" name="tipodoc" size="4" maxlength="4" style="text-transform:uppercase;" value="<? print $row['tipo_docu']; ?>"/>
				Nro:<input type="text" name="dni" size="22.7" maxlength="10" value="<? print $row['nro_docu']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt"><span class="req">*</span><i> Fecha de nacimiento:</i></td>
					<td height="15" valign=middle>
						<?
							$naci1 = $row ['nacimiento'];
							$naci2 = date ( "d-m-Y", strtotime($naci1) );
						?>
						<input type="hidden" name="buff_nacimiento" readonly="readonly" value="<? print $naci1; ?>" />
						<b><i><? print $naci2; ?></i></b>
					</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt"><span class="req">*</span> Fecha de Nacimiento p/ modif.:</td>
				
				<td height="15" valign=middle><input type="date" name="fecha_nacimiento_modifica" id="fecha_nacimiento_modifica">
				<? //diapes(); mespes(); aniopes(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Estado Civil:</td>
				<td height="15" valign=middle><input type="text" name="estcivil" size="40" maxlength="50" style="text-transform: uppercase;" value="<? 
				print utf8_decode( $row['estado_civil'] ); ?>" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Sexo:</td>
			   <td height="15" valign=middle class="txt">
				<select name="sexo" id="sex" OnChange="pmi_ver(this.form)">
                                 	<option value="Null">Seleccione...</option>
                                 	<option value="F">F</option>
                                 	<option value="M">M</option>
				</select>
			    </td>
			</tr>
		
			<tr align="center">
				<td height="15" valign=middle class="txt"></td>
				<td height="15" valign=middle>
			<div id="Caja_pmi" style="display:none;" class='txt'>P.M.I. -Con FPP-<input type="checkbox" name="pmi" id="pmi" value="SI" onclick="pmi_fecha(this.form)" ><br>

						<input type="date" name="fecha_pmi" id="fecha_pmi" style="visibility: hidden">
			</div></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Nacionalidad:</td>
				<td height="15" valign=middle><input type="text" name="nacio" size="40" maxlength="50" style="text-transform: uppercase;" value="<? print utf8_decode( $row['nacionalidad'] ); ?>" /></td>
			</tr>

			<tr align="center">
                             <td height="15" valign=middle class="txt">Sede del Afiliado: </td>
                             <td height="15" valign=middle><? filiales(); ?></td>							
            </tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br>····················· RESIDENCIA Y LOCALIZACIÓN ·····················</td>
				 <td height="15" valign=middle colspan="2" class="txt"><br></td>
			</tr>
			
			<tr ALIGN="center">
				<td height="15" valign=middle class="txt">Provincia:</td><td height="15" valign=middle class="txt">
				<input type="text" name="pcia" size="22" style="text-transform:uppercase;" value="<? print utf8_decode($row['pcia']);?>"/>

				Zona:<input type="text" name="zona" size="4" maxlength="2" value="10" /></td>
			</tr>	
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Departamento:</td>
				<td height="15" valign=middle><input type="text" name="dpto" size="40"	style="text-transform: uppercase;"	value="<? print utf8_decode($row['dpto']); ?>" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Localidad:</td><td height="15" valign=middle class="txt">
				<input type="text" name="localidad" size="22.7" style="text-transform:uppercase;" value="<? print utf8_decode($row['localidad']); ?>"/>
				Cód. Postal:<input type="text" name="cp" size="4" maxlength="10" value="<? print $row['codpost']; ?>" /></td>
			</tr>	
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Domicilio:</td>
				<td height="15" valign=middle><input type="text" name="domi" size="40" style="text-transform: uppercase;" value="<? print utf8_decode($row['domi']); ?>" /></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Tel. #1:</td>
				<td height="15" valign=middle><input type="text" name="tel1" size="40" value="<? print $row['tel1']; ?>" /></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Tel. #2 (Celular):</td>
				<td height="15" valign=middle><input type="text" name="tel2" size="40" value="<? print $row['tel2']; ?>" /></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">E-mail:</td>
				<td height="15" valign=middle><input type="email" name="email" size="40" maxlength="30" value="<? print $row['mail']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br> ····················· DATOS LABORALES ····················· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">EMPRESA:</td>
				<td height="15" valign=middle><? print utf8_decode( $row_empre['NOMBRE'] ); ?></td>
			</tr>
			<!-- Acá realizamos la comparación si el empleado es "caja de jubilaciones o desempleado" -->
			<tr ALIGN="center">
			    <td height="15" valign=middle  class="txt">CUIT EMPRESA:</td>
			   <td height="15" valign=middle>
			   <input type="hidden" name="cuitempre" readonly="readonly" value="<? print $row['cuitempresa']; ?>" />
			   <b><i><?
			   switch ($row['cuitempresa']){
			   	case '9999': print "DESEMPLEADO";
			   		break;
				case '8888': print "CAJA DE JUBILACIONES";
					break;
			   	default: print $row['cuitempresa'];
			   							   }  
			   							   ?>
 			   </i></b></td>
			</tr>

			<!-- -------------------------Acá termina la comparación-------------------------------------------- -->
			
			<!-- ---------------- TIPO ACTIVIDAD ------------------ -->
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>Categoría Laboral:</i></td>
				<td height="15" valign=middle>
					<?
						$act = $row ['tipo_actividad'];
						$act = mysql_query ( "SELECT DESCRIPCION from tipoactividad WHERE TIPOACT='$act'" );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					<input type="hidden" name="buff_act" readonly="readonly" value="<? print $row['tipo_actividad']; ?>" />
					<i><b><?	print utf8_decode($row['tipo_actividad'].' - '.$row1['DESCRIPCION']); ?></b></i>
				</td>
			</tr>

			<!-- recordar: name="tipoact" -->
			<tr align="center">
				<td height="15" valign=middle class="txt">Categor&iacute;a Laboral p/ modif.:</td>
				<td height="15" valign=middle><? tipoactividad(); ?></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Sueldo B&aacute;sico: $</td>
				<td height="15" valign=middle><input type="text" name="sueldobasico" size="20" maxlength="30" value="" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- -------------------- INICIO DE ACTIVIDADES --------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Inicio de Actividad: </i></td>
					<td height="15" valign=middle>
						<?
							$fechaini = $row ['inicio_actividad'];
							$fechaini2 = date ( "d-m-Y", strtotime ( $fechaini ) );
						?>
						<input type="hidden" name="buff_inic" readonly="readonly" value="<? print $fechaini; ?>" /> <strong>(Alta Temprana AFIP):
						<? print $fechaini2; ?></strong>
					</td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de Inicio de Act. p/ modif.:</td>
								<td height="15" valign=middle>
								<input type="date" name="fecha_iniact" id="fecha_iniact">
						<? //diaInic(); mesInic(); anioInic(); ?>
					</td>
			</tr>

			<!-- Ingreso a la empresa -->
			<tr align="center">
				<td height="15" valign=middle class="txt">Ingreso a la empresa: </td>
				<td height="15" valign=middle>
				<input type="date" name="fecha_ingreso" id="fecha_ingreso"></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt"></td>
				<td height="15" valign=middle><i>Las fechas son iguales: </i><input type="checkbox" name="igualfechaact" value="SI" checked>Si
			</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS SOBRE SEPELIO ····················· </td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Por Recibo Descuento:</td>
				<td height="15" valign=middle>
					<input type="checkbox" name="xrecibo" value="SI" checked>Si<br>
			</tr>						

			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de alta:</td>
				<td height="15" valign=middle><input type="date" name="fsepelio"></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de Baja:</td>
				<td height="15" valign=middle><input type="date" name="fbsepelio"></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>	
		
			<!-- ----------------- FECHA DE DESEMPLEADO DESDE -------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de desempleo desde:</i></td>
					<td height="15" valign=middle>
				<?
					$fecha1 = $row ['desem_desde'];
					$fecha2 = date ( "d-m-Y", strtotime ( $fecha1 ) );
				?>
					<input type="hidden" name="buff_desde" readonly="readonly" value="<? print $fecha1; ?>" /> 
					<input type="text" name="" size="11" maxlength="10"	value="<? 
							if ( $fecha1 != '0000-00-00' ){
							print $fecha2 = date ( "d-m-Y", strtotime($fecha1) );} ?>" />
					</td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de desempleo desde p/ modif.:</td>
					<td height="15" valign=middle>
					<input type="date" name="fecha_desde" id="fecha_desde">
					<? // diaIngs(); mesIngs(); anioIngs(); ?></td>
					<!-- uso los datos de fecha de ingreso al sistema -->
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>			
			
			<!-- -------------------- FECHA DE DESEMPLEADO HASTA --------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de desempleo hasta:</i></td>
					<td height="15" valign=middle>
						<?
							$des1 = $row ['desem_hasta'];
							$des2 = date ( "d-m-Y", strtotime($des1) );
						?>
						<input type="hidden" name="buff_hasta" readonly="readonly" value="<? print $des1; ?>" />
						<input type="text" name="" size="11" maxlength="10"	value="<? 
							if ( $des1 != '0000-00-00' ){
							print $des2 = date ( "d-m-Y", strtotime($des1));}?>" />
				</td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de desempleo hasta p/ modif.:</td>
				<td height="15" valign=middle>
				<input type="date" name="fecha_hasta" id="fecha_hasta">
				<? //diaCNT(); mesCNT(); anioCNT(); ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr align="center">
					<td height="15" valign=middle class="txt">Observaciones de haberes:</td>
					<td height="15" valign=middle>
					<textarea rows="9" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obser_hab" style="text-transform: uppercase;">
						<? print utf8_decode( trim ($row['observa_haberes']) ); ?>
					</textarea>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>Tipo afiliado:</i></td>
				<td height="15" valign=middle><input type="hidden" readonly="readonly" name="buff_tipoafil" size="10" maxlength="30" value="<? print $row['tipo_afil']; ?>"/>
				<? print $row['tipo_afil'];?>
				</td>
			</tr>
			
			<tr align="center">
			    <td height="15" valign=middle class="txt">Tipo Afiliado p/ modificar:</td>

				   <td height="15" valign=middle class="txt">
						<select name="t_afi" id="t_afi">
                                 	<option value="null">Seleccionar Tipo</option>
                                 	<option value="ACTIVO">ACTIVO</option>
                                 	<option value="JUBILADO">JUBILADO</option>
                                 	<option value="ADHERENTE">ADHERENTE</option>
                                 	<option value="SIN EMPLEO">SIN EMPLEO</option>
                                 	<option value="CONTRATADO">CONTRATADO</option>
                                 	<option value="P.M.O.">P.M.O.</option>
                                 	<option value="NO AFILIAD">NO AFILIADO</option>
                                 	<option value="CICLICO">CICLICO</option>
                                 	<option value="PENSIONADA">PENSIONADA</option>
                                 	<option value="APORT S/DJ">APORT S/DJ</option>
						</select>
			   		</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS OBRA SOCIAL ····················· </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">Nro de beneficiario de Obra social:</span> </td><!-- numero de afiliado -->
 			    <td height="15" valign=middle>
				<input type="text" name="nro_afi" size="20" maxlength="6" style="text-transform:uppercase;" value="" /></td>
			</tr>	
				
		
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>Origen O.S.:</i></td>
				<td height="15" valign=middle><input type="hidden" name="buff_origenos" readonly="readonly" size="12" maxlength="30" value="<? print $row['origen_os']; ?>" /> <i><b><? print $row['origen_os'];?></b></i>
				</td>
			</tr>

		<!-- Guarda si esta en la obra social SI o NO -->
		<input type="hidden" name="tosoc_buffer" size="40" maxlength="11" value="<? print $row['tosoc']; ?>"/>

			<tr align="center">
				<td height="15" valign=middle class="txt">Origen O.S. p/ modif.:</td>
				  <td height="15" valign=middle class="txt">
					<select name="orig_os" id="orig_os" OnChange="desactivar(this.form)">
                                 	<option value="null">Seleccionar Tipo</option>
                                 	<option value="CAMIONERO">O.S. 103204</option>
                                 	<option value="OPCION">OPCIÓN</option>
                                 	<option value="M.T.">MONOTRIBUTISTA</option>
                                 	<option value="UNIFICACION">UNIFICACIÓN</option>
                                 	<option value="DESEMPLEADO">DESEMPLEADO</option>
                                 	<option value="OTRA">OTRA</option>
					</select>
				  </td>	
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Alta O.S.:</td>
				<td height="15" valign=middle><input type="date" name="fecha_os" id="fecha_os"></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">HaPaDjObSo:</td>
				<td height="15" valign=middle><input type="txt" maxlength="6" name="EHaPaDjObSo"></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS SINDICAL ····················· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">SINDICATO: <br><span class="req">El n&uacutemero sindical<br> se genera automáticamente</span></td>
				<td height="15" valign=middle><input type="hidden" name="buff_sindi" readonly="readonly" size="4" maxlength="2" value="<? print $row['sindicato']; ?>" />

				<b><i><? print $row['sindicato']; ?></i></b>

				</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">SINDICATO p/ modif.:</td>
				  <td height="15" valign=middle class="txt">
					<select name="sindi" id="sindi">
									<option value="null">seleccione una opción</option>
                                 	<option value="NOnSindi">NO</option>
                                 	<option value="SInSindi">SI</option>
 					</select>
				  </td>	
			</tr>
			
<!-- 			<tr ALIGN="center"> -->
<!-- 			    <td height="15" valign=middle class="txt"> Nro. Sindical:</td>
			    <td height="15" valign=middle><input type="text" name="tnsindi" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" value=""/></td>
 			</tr> -->
			
			<!-- -------------------- FECHA DE ALTA DE SINDICATO --------------------- -->
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Alta Sindicato:</i></td>
					<td height="15" valign=middle>
						<?
							$alt1 = $row ['alta_sindi'];
							$alt2 = date ( "d-m-Y", strtotime($alt1) );
						?>
						<input type="hidden" name="buff_altasindi" readonly="readonly" value="<? print $alt1; ?>" />
						<b><i><? print $alt2; ?></i></b>
				</td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Alta Sindicato p/ modif.:</td>
				
				<td height="15" valign=middle><input type="date" name="fecha_sindi" id="fecha_sindi"></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>



			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS MUTUAL ····················· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">MUTUAL (AMUTCAER):</td>
				<td height="15" valign=middle><input type="hidden" name="mutual" size="4" maxlength="2"	value="<? print $row['mutual']; ?>" />

<b><i><? print $row['mutual']; ?></i></b>

				</td>
			</tr>
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">Nro. Mutual:</span> </td>
			    <td height="15" valign=middle><input type="text" name="nmutual" size="20" maxlength="50" style="text-transform:uppercase;" value=""/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Alta MUTUAL:</i></td>
					<td height="15" valign=middle>
						<?
							$altm1 = $row ['alta_mutual'];
							$altm2 = date ( "d-m-Y", strtotime($altm1) );
						?>
						<input type="hidden" name="buff_altamut" value="<? print $altm1; ?>" />
						<b><i><? print $altm2; ?></i></b>
				</td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Alta MUTUAL p/ modif.:</td>
				<td height="15" valign=middle>
				<input type="date" name="fecha_mutu" id="fecha_mutu">
				<? //diapm(); mespm(); aniopm(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			<!-- --------------------------------------------------------------	 -->
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS FAMILIARES	 ····················· </td>
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class="txt" colspan="2" >Cant. de Familiares: <input type="text" name="cflia" size="2" style="text-transform:uppercase;" value="" />
						Flia a cargo: <input type="text" name="famicargo" size="2" value="" />
			   </td>
			</tr>
			
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS SOBRE DISCAPACIDAD ····················· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Tipo de discapacidad:</td>
			    <td height="15" valign=middle><input type="text" name="tdis" size="40" maxlength="50" style="text-transform:uppercase;" value=""/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Tipo de patología:</td>
			    <td height="15" valign=middle><input type="text" name="tipopat" size="40" maxlength="50" style="text-transform:uppercase;" value=""/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Venc. de Certific. de disc.:</td>
			    <td height="15" valign=middle><input type="date" name="fecha_pato"></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ······························································· </td>
			</tr>			
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br></td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt">Observaciones:</td>
					<td height="15" valign=middle>
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obser" style="text-transform: uppercase;">
						<? utf8_decode( trim (print $row['observacion'] )); ?>
					</textarea>
			</tr>				
	</table>
	
	<table>
		<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2"><br>···················································································· </td>
		</tr>
		<tr ALIGN="center">
				<td height="15" valign=middle class="txt2">Cargado desde filial por:<? print "  ".$row["usuario"]; ?></td>
		</tr>
		
		<tr align="center">
				<td height="15" valign=middle class="txt2">Fecha de carga:<? print "  ".$row["alta_en_filial"]; ?></td>
		</tr>
		
		<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
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

<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>
<?
include("includes/footer.php");
}?>