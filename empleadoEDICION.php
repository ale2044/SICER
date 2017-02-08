<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
include ("fciondiamesanio.php");
include ("fciondiamesanioIni_Nac.php");
include ("fcionzona.php");
include ("fcionlocalidad.php");
include ("fciontipoactividad.php");
include ("fcionbajaEmple.php");
include ("fcion_dptos_er.php");
include ("fcionmostrarempresa.php");
include ("fcionfilial.php");

$user = $_SESSION["user"];
$dni_titu = $_POST["dni_titu"];
$cuil_titu = $_POST["cuil_titu"];

/* Consultas ------------------- */
$sqlBusca="select CUIL from titulares where CUIL='$cuil_titu'";
$resultBusca=mysql_query($sqlBusca, $link);

if(mysql_num_rows($resultBusca)==1){
	$pcias=mysql_query("SELECT * from titulares WHERE CUIL='$cuil_titu' ");
	$row=mysql_fetch_assoc($pcias);

/* --------------------------- */

/* PARA MOSTAR EL NOMBRE DE LA EMPRESA */
$tbcuit = $row['CUITEMPRESA'];
$empresa = mysql_query("SELECT NOMBRE, SUSS from empresas WHERE SUSS='$tbcuit' ");
$row_empre=mysql_fetch_assoc($empresa);
/* ----------------------------------- */
?> 

<script type="text/javascript" src="cargarDptos.js"></script>
<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>

<script type="text/javascript">
function comparar(form){

var tipo1 = document.formulario.tnsindi.value;
var tipo2 = document.formulario.nmutual.value;

if (tipo1 != tipo2){
	alert("El nro de mutual y el nro sindical deben ser iguales");
	}
}
</script>

<?include("includes/header.php");?>

<div id="contenedor">

<div id="cajachicasup"></div>

<!--'document.getElementById(fecha).disabled = true;-->

<div id="cajappal" class='centraTabla'>

<h1 align="center" class="emple">
Panel de MODIFICACI&Oacute;N de AFILIADO || Usuario: <b><? echo $user; ?></b>
</h1>

<!-- actualiza_emple.php -->
<form action="actualiza_emple.php" name="formulario" id="formulario" method="POST">
<div id="CajaNotificacion"><div class="txt">CUIL y AFILIADO A EDITAR:<strong> 
<? print utf8_decode( $row['CUIL']); print utf8_decode( " || ".$row["TAPEL"]." ".$row["TNOMB"] ); ?></strong>
<br>Nombre de la EMPRESA: <strong> "<?

  			   switch ($row['CUITEMPRESA']){
			   	case '9999': print "DESEMPLEADO";
			   		break;
				case '8888': print "CAJA DE JUBILACIONES";
					break;
			   	default: print utf8_decode( $row_empre['NOMBRE'] );
 			   }

?>"</strong>
</div></div>

<div id="CajaEmple">

<table>
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· DATOS PERSONALES ····················· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Número de Afiliado: </td>
 			    <td height="15" valign=middle>
				<input type="text" name="nro_afi" size="40" maxlength="9" style="text-transform:uppercase;" value="<? print $row['TNAFI']; ?>" class=":required" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
				</tr>

			<tr ALIGN="center">
				<td height="15" valign=middle  class="txt">Sede del Afiliado:</td>
				<td height="15" valign=middle> 
				<input type="hidden" name="buff_lugarfil" value="<? print $row['LUGARAFIL']; ?>">
					<? 
					$numero = $row['LUGARAFIL'];
					filiales_mostrar($numero);
					?>
				</td>
			</tr>
			
			<tr align="center">
                             <td height="15" valign=middle class="txt">Modif. Sede: </td>
                             <td height="15" valign=middle class='txt1'><? filiales(); ?></td>							
            </tr>

            <tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
				</tr>
			
			<tr ALIGN="center">
			   <td height="15" valign=middle class="txt"> CUIL TITULAR:</td>
			   <td height="15" valign=middle>
			   <input type="hidden" name="buff_cuilemple" size="40" maxlength="11" value="<? print $row['CUIL']; ?>"/>
			   <input type="text" name="cuilemple" size="40" maxlength="11" value="<? print $row['CUIL']; ?>" class=":required :integer" /></td>
			</tr>
	
			
			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> Apellido:</td>
			   <td height="15" valign=middle><input type="text" name="apelemple" size="40" maxlength="25" class=":required" style="text-transform:uppercase;" 
			   value="<? print utf8_decode( $row['TAPEL'] ); ?>"/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Nombres:</td>
			   <td height="15" valign=middle><input type="text" name="nomemple" size="40" maxlength="25" class=":required" style="text-transform:uppercase;" 
			   value="<? print utf8_decode( $row['TNOMB'] ); ?>" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Tipo de documento:</td>
 			    <td height="15" valign=middle class='txt'>
				<input type="text" name="dni" size="4" maxlength="3" style="text-transform:uppercase;" value="<? print $row['TTDOC']; ?>"/>
				Nro: <input type="text" name="docu" size="22.7" value="<? print $row['TNDOC']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> Sexo:</td>
			   <td height="15" valign=middle><input type="text" name="sexo" size="12" maxlength="1" class=":required" style="text-transform:uppercase;" 
			   value="<? print $row['TSEXO']; ?>" /> <b><i>F: femenino - M: masculino</i></b></td>
			</tr>
			
				<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
				</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de nacimiento:</i></td>
					<td height="15" valign=middle>
						<?
							$naci1 = $row ['TFNAC'];
							if ($naci1 == null) { $naci2='0000-00-00'; }
						?>
						<input type="hidden" name="buff_nacimiento" readonly="readonly" value="<? print $row['TFNAC']; ?>" />
						<input type="text" name="" readonly="readonly" size="11" maxlength="11"	value="<?
							if( $naci1 != "0000-00-00" ){
							echo date('d-m-Y',strtotime($naci1)); }
						?>" />
					</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de Nacimiento p/ modif.:</td>
				
				<td height="15" valign=middle><input type="date" name="fecha_nac" id="fecha_nac"></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Estado Civil:</td>
 			    <td height="15" valign=middle>
				<input type="text" name="est_civ" size="40" style="text-transform:uppercase;" value="<? print utf8_decode( $row['TESCI'] ); ?>"/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· RESIDENCIA Y LOCALIZACIÓN ····················· </td>
			</tr>
			
			<tr ALIGN="center">
				<td height="15" valign=middle class="txt">Provincia:</td><td height="15" valign=middle class="txt">
				<input type="text" name="provincia" size="22" style="text-transform:uppercase;" value="<? print utf8_decode( $row['PCIA'] ); ?>"/>
				Zona:<input type="text" name="zona" size="4" maxlength="2" value="<? print $row['TZONA'] ?>" /></td>
			</tr>	

			<tr ALIGN="center">
			     <td height="15" valign=middle class="txt"> Departamento: </td>
			  	 <td height="15" valign=middle>
				<input type="text" name="dpto" size="40" style="text-transform:uppercase;" value="<? print utf8_decode( $row['DPTO'] ); ?>"/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Localidad:</td><td height="15" valign=middle class="txt">
				<input type="text" name="localidad" size="22.7" style="text-transform:uppercase;" value="<? print utf8_decode( $row['TLOCA'] ); ?>"/>
				Cód. Postal:<input type="text" name="cp" size="4" maxlength="10" value="<? print $row['TCPOS']; ?>" /></td>
			</tr>				
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Domicilio: </td>
			    <td height="15" valign=middle><input type="text" name="domicilio" size="40" style="text-transform:uppercase;" value="<? print utf8_decode( $row['TDOMI'] ); ?>"/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Tel. Fijo:</td>
			    <td height="15" valign=middle><input type="text" name="tel1" size="40" value="<? print $row['TTELE']; ?>"/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Tel. Celu.</td>
			    <td height="15" valign=middle><input type="text" name="tel2" size="40" value="<? print $row['TTELE2']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> E-mail:</td>
			    <td height="15" valign=middle><input type="email" name="mail" size="40" maxlength="40" style="text-transform:uppercase;" value="<? print utf8_decode( $row['MAIL'] ); ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· DATOS LABORALES ····················· </td>
			</tr>
			
			<!-- Acá realizamos la comparación si el empleado es "caja de jubilaciones o desempleado" -->
			<tr ALIGN="center">
				<td height="15" valign=middle  class="txt">CUIT EMPRESA:</td>
			   <td height="15" valign=middle>
			   <b><?
			   switch ($row['CUITEMPRESA']){
			   	case '9999': print "DESEMPLEADO";
			   		break;
				case '8888': print "CAJA DE JUBILACIONES";
					break;
			   	default: print $row['CUITEMPRESA'];
			   	}
			   	?></b>
 			   </td>
			</tr>

			<tr ALIGN="center">
				 <td height="15" valign=middle class="txt"> MODIFICAR EMPRESA:</td>
				 <td height="15" valign=middle>
 				 <input type="hidden" name="buff_CUIT" readonly="readonly" value="<? print $row['CUITEMPRESA']; ?>" />
									<? nombrarEmpresa(); ?>
			     </td>
				 </tr>
			<!-- 			--------------------Acá termina la comprobación del CUIT ---------------------------------- -->
				
						
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>Categoría Laboral:</i></td>
				<td height="15" valign=middle>
					<?
						$act = $row ['TIPOACT'];
						$act = mysql_query ( "SELECT DESCRIPCION from tipoactividad WHERE TIPOACT='$act'" );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					<input type="hidden" name="buff_act" readonly="readonly" value="<? print $row['TIPOACT']; ?>" />
					<input type="text" name=""  readonly="readonly" size="45" maxlength="50" value="<? print utf8_decode( $row['TIPOACT'].' - '.$row1['DESCRIPCION'] ); ?>" />
				</td>
			</tr>

			<!-- recordar: name="tipoact" -->
			<tr align="center">
				<td height="15" valign=middle class="txt">Categoría Laboral p/ modif.:</td>
				<td height="15" valign=middle><? tipoactividad(); ?></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Sueldo B&aacute;sico:</td>
				<td height="15" valign=middle><input type="text" name="sueldob" size="20" value=""/></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- -------------------- INICIO DE ACTIVIDADES --------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Inicio de Actividad:</i></td>
					<td height="15" valign=middle>
						<?
							$fechaini = $row ['INIACT'];
						?>
						<input type="hidden" name="buff_inic" readonly="readonly" value="<? print $row['INIACT'];?>" />
						<input type="text" name="" size="11"  readonly="readonly" maxlength="10" value="<?
						print $fechaini2; 
						if($row['INIACT']!="0000-00-00"){
							echo date('d-m-Y',strtotime($fechaini)); }
						?>" />
					</td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de Inicio de Act. p/ modif.:</td>
								<td height="15" valign=middle>
								<input type="date" name="fecha_iniact" id="fecha_iniact">
					</td>
			</tr>
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de Ingreso a la empresa:</i></td>
					<td height="15" valign=middle>
						<?
							$fing1 = $row['TFING'];
						?>
						<input type="hidden" name="buff_fing" readonly="readonly" value="<? print $row['TFING']; ?>" />
						<input type="text" name="" size="11"  readonly="readonly" maxlength="11"	value="<? 
							if($row['TFING']!="0000-00-00"){ echo date('d-m-Y',strtotime($fing1)); } ?>" />
					</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de ingreso a la Empresa p/ modif.:</td>
				<td height="15" valign=middle><input type="date" name="fecha_ingm" id="fecha_ingreso_m"></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr align="center">
					<td height="15" valign=middle class="txt">Observaciones de haberes:</td>
					<td height="15" valign=middle>
					<textarea rows="9" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obser_hab" style="text-transform: uppercase;">
						<? print utf8_decode(trim ($row['OBSHABER'])); ?>
					</textarea>
			</tr>
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> OBRA SOCIAL: </td>
			   <input type="hidden" name="buff_altaobrasocial" size="2" maxlength="2" value="<? print $row['TOSOC']; ?>"/>
			   <td height="15" valign=middle><span style="color: red" class='txt'><? print $row['TOSOC']; if ($row['TOSOC']=='NO'){?></span><i><input name="altaobrasocial" type="checkbox"/>Tilde para dar de Alta<?;}?></i><br/></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Alta Obra Social:</td>
				<td height="15" valign=middle><input type="date" name="fecha_obrasoc" id="fecha_os"></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>Tipo afiliado:</i></td>
				<td height="15" valign=middle><input type="text" readonly="readonly" name="buff_tipoafil" size="10" maxlength="30" value="<? print $row['TLETT']; ?>" /></td>
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
                                 	<option value="NO AFILIADO">NO AFILIADO</option>
                                 	<option value="CICLICO">CICLICO</option>
                                 	<option value="PENSIONADA">PENSIONADA</option>
                                 	<option value="APORT S/DJ">APORT S/DJ</option>
						</select>
			   		</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>Origen O.S.:</i></td>
				<td height="15" valign=middle><input type="text" name="buff_origenos" readonly="readonly" size="12" maxlength="30" value="<? print $row['ORIGENOS']; ?>" /></td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Origen O.S. p/ modif.:</td>
				  <td height="15" valign=middle class="txt">
					<select name="orig_os" id="orig_os" OnChange="desactivar(this.form)">
                                 	<option value="null">Seleccionar Tipo</option>
                                 	<option value="CAMIONERO">CAMIONERO</option>
                                 	<option value="OPCION">OPCION</option>
                                 	<option value="M.T.">M.T.</option>
                                 	<option value="UNIFICACION">UNIFICACION</option>
                                 	<option value="DESEMPLEADO">DESEMPLEADO</option>
                                 	<option value="OTRA">OTRA</option>
					</select>
				  </td>	
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">HaPaDjObSo:</td>
				<td height="15" valign=middle><input type="txt" maxlength="6" name="EHaPaDjObSo" value="<? print $row["HaPaDjObSo"]; ?>"></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>	
		
			<!-- ----------------- FECHA DE DESEMPLEADO DESDE -------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de desempleo desde:</i></td>
					<td height="15" valign=middle>
				<?
					$fecha1 = $row ['DESEMDESDE'];
					if ( $fecha1 == null ){ $fecha1 = '0000-00-00'; }

				?>
					<input type="hidden" name="buff_desde" readonly="readonly" value="<? print $row['DESEMDESDE']; ?>" /> 
					<input type="text" name="" size="11"  readonly="readonly" maxlength="10"	value="<? 
					if($fecha1 != "0000-00-00"){
						echo date('d-m-Y',strtotime($fecha1)); }
				?>" />
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
					<td height="15" valign=middle class="txt2">Fecha de desempleo hasta:</td>
					<td height="15" valign=middle>
						<?
							$des1 = $row ['DESEMHASTA'];
							if ($des1 == null){ $des1 = '0000-00-00'; }
						?>
						<input type="hidden" name="buff_hasta" readonly="readonly" value="<? print $row['DESEMHASTA']; ?>" />
						<input type="text" name="" size="11" maxlength="10"  readonly="readonly"	value="<? 
						if($des1!= "0000-00-00"){
						echo date('d-m-Y',strtotime($des1)); }
						?>" />
				</td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de desempleo hasta p/ modif.:</td>
				<td height="15" valign=middle>
				<input type="date" name="fecha_hasta" id="fecha_hasta">
				<? //diaCNT(); mesCNT(); anioCNT(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS SINDICAL ····················· </td>
			</tr>
			
			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'>SINDICATO: </td>
			   <input type="hidden" name="buff_altasindicato" size="2" maxlength="2" value="<? print $row['TSINDI']; ?>"/>
			   <td height="15" valign=middle><span style="color: red" class='txt'><? print $row['TSINDI']; if ($row['TSINDI']=='NO'){?></span><i><input name="altasindicato" type="checkbox"/>Tilde para dar de Alta<?;}?></i><br/></td>
		</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Alta Sindicato:</i></td>
					<td height="15" valign=middle>
						<?
							$alt1 = $row ['TFINS'];
							if ($alt1 == null){
								$alt1 = '0000-00-00';
							}
						?>
						<input type="hidden" name="buff_altasindi" readonly="readonly" value="<? print $alt1 = $row['TFINS']; ?>" />
						<input type="text" name="" size="11" maxlength="11"	 readonly="readonly" value="<?
						if($alt1!="0000-00-00"){
							echo date('d-m-Y',strtotime($alt1)); }
						?>" />
				</td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Alta Sindicato p/ modif.:</td>
				
				<td height="15" valign=middle><input type="date" name="fecha_sindi" id="fecha_sindi"><?// diaRcp(); mesRcp(); anioRcp(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Nro. Sindical:</td>
			    <td height="15" valign=middle><input type="text" name="tnsindi" size="40" maxlength="50" style="text-transform:uppercase;" value="<? print $row['TNSIN']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS MUTUAL ····················· </td>
			</tr>
			
			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'>AMUTCAER:</td>
			   <input type="hidden" name="buff_altamutual" size="2" maxlength="2" value="<? print $row['TMUT']; ?>"/>
			   <td height="15" valign=middle><span style="color: red" class='txt'><? print $row['TMUT']; if ($row['TMUT']=='NO'){?></span><i><input name="altamutual" type="checkbox"/>Tilde para dar de Alta<?;}?></i><br/></td>
			</tr>


			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Nro. Mutual:</td>
			    <td height="15" valign=middle><input type="text" name="nmutual" size="40" maxlength="50" style="text-transform:uppercase;" value="<? print $row['NMUTUAL']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Alta MUTUAL:</i></td>
					<td height="15" valign=middle>
						<?
							$altm1 = $row ['TFINMUTUAL'];
						?>
						<input type="hidden" name="buff_altamut" value="<? print $row['TFINMUTUAL']; ?>" />
						<input type="text" name="" size="11"  readonly="readonly" maxlength="11"	value="<? 
							if($row['TFINMUTUAL']!="0000-00-00"){
								echo date('d-m-Y',strtotime($altm1)); }
						?>" />
				</td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Alta MUTUAL p/ modif.:</td>
				<td height="15" valign=middle>
				<input type="date" name="fecha_mutu" id="fecha_mutu">
				<? //diapm(); mespm(); aniopm(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS FAMILIARES	 ····················· </td>
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class="txt" colspan="2" >Cant. de Familiares: <input type="text" name="cflia" size="2" style="text-transform:uppercase;" value="<? print $row['TFAMI']; ?>" />
						Flia a cargo: <input type="text" name="famicargo" size="2" value="<? print $row['TFAMCAR']; ?>" />
			   </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt2">Fecha Plan Materno Infantil:</td>
					<td height="15" valign=middle>
						<?
							$fpm1 = $row ['TFPMI'];
							if ($fpm1 = null){ $fpm1 = '0000-00-00'; }
						?>
						<input type="hidden" name="buff_fpmi" value="<? print $row['TFPMI']; ?>" />
						<input type="text" name="" size="11"  readonly="readonly" maxlength="11"	value="<? 
						
						if($row['TFPMI']!="0000-00-00"){
							echo date('d-m-Y',strtotime($fpm1)); }
							
						?>" />
				</td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha P.M.I. p/ modif.:</td>
				<td height="15" valign=middle>
				<input type="date" name="fpmi" id="fpmi">
				</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS SOBRE DISCAPACIDAD	 ····················· </td>
			</tr>
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Tipo de discapacidad:</td>
			    <td height="15" valign=middle><input type="text" name="tdis" size="40" maxlength="50" style="text-transform:uppercase;" value="<? print utf8_decode( $row['TDISC'] ); ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Tipo de patología:</td>
			    <td height="15" valign=middle><input type="text" name="tipopat" size="40" maxlength="50" style="text-transform:uppercase;" value="<? print utf8_decode( $row['TPATO'] ); ?>"/></td>
			</tr>

			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Venc. patolog&iacute;a:</i></td>
					<td height="15" valign=middle>
						<?
							$pat1 = $row ['FFVENPAT'];
							if ($pat1 == null) { $pat2='0000-00-00'; }
						?>
						<input type="hidden" name="buff_pat" readonly="readonly" value="<? print $row['FFVENPAT']; ?>" />
						<input type="text" name="" readonly="readonly" size="11" maxlength="11"	value="<?
							if( $pat1 != "0000-00-00" ){
							echo date('d-m-Y',strtotime($pat1)); }
						?>" />
					</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Venc. patolog&iacute;a p/ modif.:</td>
				<td height="15" valign=middle><input type="date" name="fecha_vpato"></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS SOBRE SEPELIO ····················· </td>
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> Por Recibo Descuento: </td>
			   <td height="15" valign=middle>
					<input type="text" name="xrecibo" size="2" value="<? print $row['RECIBO']; ?>"> 
				</td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de Alta:</i></td>
					<td height="15" valign=middle>
						<?

							$time = strtotime($row ['FeAltSegSep']);
							$sepa1 = ($time === false) ? '0000-00-00' : date('Y-m-d', $time);
						?>
						<input type="hidden" name="buff_sep" readonly="readonly" value="<? print $row['FeAltSegSep']; ?>" />
						<input type="text" name="" readonly="readonly" size="11" maxlength="11"	value="<?
							if( $sepa1 != "0000-00-00" ){
							echo date('d-m-Y',strtotime($sepa1)); }
						?>" />
					</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de alta p/ modif.:</td>
				<td height="15" valign=middle><input type="date" name="fsepelio"></td>
			</tr>

			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de Baja:</i></td>
					<td height="15" valign=middle>
						<?
							$time = strtotime($row ['FeBajSegSep']);
							$sepb1 = ($time === false) ? '0000-00-00' : date('Y-m-d', $time);
						?>
						<input type="hidden" name="buff_sepb" readonly="readonly" value="<? print $row['FeBajSegSep']; ?>" />
						<input type="text" name="" readonly="readonly" size="11" maxlength="11"	value="<?
							if( $sepb1 != "0000-00-00" ){
							echo date('d-m-Y',strtotime($sepb1)); }
						?>" />
					</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de Baja p/ modif.:</td>
				<td height="15" valign=middle><input type="date" name="fbsepelio"></td>
			</tr>







			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· MOTIVO DE BAJA (MUTUAL/SINDICAL/O.S.): ····················· </td>
			</tr>			
			
<!-- 			<tr ALIGN="center">
			    <td height="15" valign=middle >MOTIVO DE BAJA:<br> </td> 
 			    <td height="15" valign=middle class="txt"> 
				<input type="text" name="motbaja" size="40" maxlength="50" style="text-transform:uppercase;" value="<? /*print $row['MOTBAJA'];*/ ?>" /></td>
		</tr> -->

<!-- modificando el codigo de baja-->
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>MOTIVO DE BAJA: </td>
				<td height="15" valign=middle>
			<? $act = $row['MOTBAJA'] ;$act=mysql_query("SELECT CTDES from bajas_determ WHERE CTCOD='$act' ");
					$row1=mysql_fetch_assoc($act); ?>
			<input type="text" name="bajaEbuffer" size="40" maxlength="40"  readonly="readonly" style="text-transform:uppercase;" value="<? print utf8_decode( $row['MOTBAJA'].' - '.$row1['CTDES'] ); ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Motivo de Baja p/ modificar: </td> 
			    <td height="15" valign=middle class="txt">
				<? listbajaEmple(); ?></td>
<!-- 				name es listabajaEmple -->
			</tr>
			
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br></td>
			</tr>
			
			<tr ALIGN="center"><td height="15" valign=middle class="txt">Observaciones por Modificación: </td>
			<td height="15" valign=middle>
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obnserva01" style="text-transform: uppercase;">
						<? print utf8_decode( trim($row['MOTIVOMODIFICA']) ); ?>
					</textarea>
			</tr>
		
			<tr align="center">
					<td height="15" valign=middle class="txt">Observaciones:</td>
					<td height="15" valign=middle>
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obser" style="text-transform: uppercase;">
						<? print utf8_decode( trim($row['OBSERV']) ); ?>
					</textarea>
			</tr>	
   
		</table>
		<table>
		<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2"><br>···················································································· </td>
		</tr>
		<tr ALIGN="center">
				<td height="15" valign=middle class="txt2">Modificado por:<? print "  ".$row['USUARIO']; ?></td>
		</tr>
		
		<tr align="center">
				<td height="15" valign=middle class="txt2">Última modificación:<? print "  ".$row['FECHAMODIF']; ?></td>
		</tr>
		
		<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
		</tr>
		</table>

</div> <!-- CajaEmpre -->


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

</div><!-- contenedor -->

<? include("includes/footer.php");
}else 
{
	$alerta=411; //El emppleado NO existe;
	header("Location: menu.php?alerta=$alerta");	
}


}
?>