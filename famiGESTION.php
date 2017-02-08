<?
session_start();
require_once("includes/connection.php");
include("fciones/fciontipoafil_familiar.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION ["user"];
$cuil_fami = $_GET ["cuil_fami"];
$copiaCT = $_GET ['cuitTituBuffer'];
$cuilf_buffer = $cuil_fami;

$sqlBusca = "select * from  famidesdefilial where cuil_fami='$cuil_fami'";
$pcias = mysql_query($sqlBusca);
$row = mysql_fetch_assoc ( $pcias );

if ( $cuil_fami == null )
	{
	$alerta='seleccionar';
	header("Location: lista_familia.php?alerta=$alerta&cuilTitu=$copiaCT");
	} 
?>

<?include("includes/header.php");?>

<script type="text/javascript">

function activar(form) {

if (form.tparen_modif.value=="04" || form.tparen_modif.value=="06"){ 
					document.getElementById("Caja_estudio").style.display = 'block';
							      } else { document.getElementById("Caja_estudio").style.display = 'none'; }

if (form.tparen_modif.value=="08" || form.tparen_modif.value=="10"){
					document.getElementById("Caja_discapacidad").style.display = 'block'; 
							     } else { document.getElementById("Caja_discapacidad").style.display = 'none'; }


}

</script>

<script type="text/javascript">
function pmi_ver(form)
{
if (form.sexmodif.value == "F"){ document.getElementById("Caja_pmi").style.display = 'block'; } else { document.getElementById("Caja_pmi").style.display = 'none'; }

}
</script>

<script type="text/javascript">
function pmi_fecha(form)
{
if(document.getElementById('pmi').checked) { form.fecha_pmi.style.visibility = "visible"; } else {
 					      form.fecha_pmi.style.visibility = "hidden"; }
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

	<div id="contenedor">
	<div id="cajachicasup"></div>
		<div id="cajappal" class='centraTabla'>
			<h1 align="center">
				Panel de GESTI&Oacute;N de Datos: FAMILIARES || Usuario: <b><? echo $user; ?></b>
			</h1>
			
<div id="CajaNotificacion"><div class="txt">CUIL y NOMBRE del FAMILIAR A EDITAR:<strong> 
<? print $row['cuil_fami']; print " || ".$row["apel_fami"]." ".$row["nom_fami"]; ?></strong></div></div>
		
<form action="grabar_act_fami.php" name="formulario" id="formulario" method="POST">
	
	<div id="CajaFami" class="centraTabla">
		<!-- Guarda en Buffer el CUIL del familiar -->
		<input type="hidden" name="cuilf_buffer" size="40" maxlength="11" value="<? print $cuilf_buffer; ?>"/>
		
		<table>
			<tr align="center">
				<td colspan="2" height="20" valign=middle bgcolor="#EFEEDA">Seleccione el campo que desee modificar</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">CUIL TITULAR:</td>
				<td height="15" valign=middle><input type="text" readonly name="cuiltitu" size="40" value="<? print $row['cuil_titu']; ?>"/>
				</td>
			</tr>

			<tr align="center">
			    <td height="15" valign=middle class="txt">Tipo de Afiliado (familiar):</td>
			    <td height="15" valign=middle class="txt"><? afilfam(); ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br> ····················· DATOS PERSONALES	 ····················· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">CUIL FAMILIAR:</td>
				<td height="15" valign=middle>
					<input type="text" name="cuilfami" size="40" maxlength="11" value="<? print $row['cuil_fami']; ?>" 
							class=":required :integer :max_length;11" />
				</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Tipo de documento:</td><td height="15" valign=middle class="txt">
				<input type="text" name="tipodoc" size="4" maxlength="4" style="text-transform:uppercase;" 
					class=":required" value="<? print $row['tipo_docu']; ?>"/>
				Nro:<input type="text" name="dni" size="22.7" maxlength="10" class=":required" value="<? print $row['nro_docu']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></td>
			</tr>
					
			<tr align="center">
				<td height="15" valign=middle class="txt">Apellido:</td>
				<td height="15" valign=middle>
					<input type="text" name="apellido" size="40" style="text-transform: uppercase;"	value="<? print utf8_decode($row['apel_fami']); ?>"
							class=":required"/></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Nombres:</td>
				<td height="15" valign=middle>
					<input type="text" name="nombres" size="40"	style="text-transform: uppercase;"	value="<? print utf8_decode($row['nom_fami']); ?>" 
							class="required"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de nacimiento:</i></td>
					<td height="15" valign=middle>
						<?
							$naci1 = $row ['nacimiento'];
							$naci2 = date ( "d-m-Y", strtotime($naci1) );
						?>
						<input type="hidden" name="buff_nacimiento" readonly="readonly" value="<? print $naci1; ?>" />
						<input type="text" name="" size="11" maxlength="11"	value="<? print $naci2; ?>" />
					</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de Nacimiento p/ modif.:</td>
				<td height="15" valign=middle><input type="date" name="fecha_nacimiento_modifica" id="fecha_nacimiento_modifica"></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Sexo:</td><td height="15" valign=middle class="txt">
				<input type="text" name="" size="4" readonly='readonly' style="text-transform:uppercase;" value="<? print $row['sexo']; ?>"/>
				</td>
			</tr>
			
			<? 
			$tipo_sexo = $row['sexo'];
			
			switch ($tipo_sexo) {
				case 'M':
					?>
					<tr ALIGN="center">
			    	<td height="15" valign=middle class="txt">
					<input type="hidden" name="buff_sexo" style="text-transform:uppercase;" value="M"/>
					<input type="hidden" name="buff_pmi" style="text-transform:uppercase;" value="NO"/>
					<input type="hidden" name="buff_fechapmi" style="text-transform:uppercase;" value="0000-00-00"/>
					</td>
					</tr>
					<?
					break;
				case 'F':
					?>
					<tr ALIGN="center">
					<td height="15" valign=middle class="txt">
					<input type="hidden" name="buff_sexo" style="text-transform:uppercase;" value="F"/>
					<input type="hidden" name="buff_pmi" style="text-transform:uppercase;" value="<? print $row['pmi']; ?>"/>
					<input type="hidden" name="buff_fechapmi" style="text-transform:uppercase;" value="<? print $row['fecha_pmi_vto']; ?>"/>
					</td>
					</tr>
					
					<tr ALIGN="center">
			   		<td height="15" valign=middle class="txt">P.M.I.:</td><td height="15" valign=middle class="txt">
					<input type="text" name="" size="4" readonly='readonly' style="text-transform:uppercase;" value="<? print $row['pmi']; ?>"/>
					</td>
					</tr>
					<?
				break;
			}
			?>
				
			<tr align="center">
					<td height="15" valign=middle class="txt2">Fecha venc. P.M.I.:</td>
					<td height="15" valign=middle>
						<?
							$fechapmi = $row ['fecha_pmi_vto'];
							$fechapmi2 = date ( "d-m-Y", strtotime ( $fechapmi ) );
						?>
						<input type="text" name="" size="11" maxlength="10" value="<? print $fechapmi2; ?>" />
					</td>
			</tr>
			
			
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Sexo y P.M.I. p./ Modif:</td>
			   <td height="15" valign=middle class="txt">
				<select name="sexmodif" id="sexmodif" OnChange="pmi_ver(this.form)">
                                 	<option value="null">Seleccione...</option>
                                 	<option value="F">F</option>
                                 	<option value="M">M</option>
				</select>
			    <div id="Caja_pmi" style="display:none;" class='txt'>P.M.I. -Con FPP- <input type="checkbox" name="pmi" id="pmi" value="SI" onclick="pmi_fecha(this.form)" >
						<input type="date" name="fecha_pmi" id="fecha_pmi" style="visibility: hidden">
						
				</div>
			    
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
			
			<!-- 			solo muestra el tipo de pariente -->
			<tr align="center">
				<td height="15" valign=middle class="txt2">Tipo de Parentesco</td>
				<td height="15" valign=middle>
					<?
						$act = $row ['tipoparen'];
						$act = mysql_query ( "SELECT cod_paren, desc_paren from parentesco WHERE cod_paren='$act'" );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					<input type="hidden" name="buff_paren" readonly="readonly" value="<? print $row['tipoparen']; ?>" />
					<input type="text" name="" readonly="readonly" size="45" maxlength="50" 
							value="<? print $row['tipoparen'].' - '.$row1['desc_paren']; ?>" />
				</td>
			</tr>
			<!-- 			*******************************	 -->
						
			<?
			/*****************************************************************************************/
			$segun_paren = $row['tipoparen'];
			
			if (($segun_paren == '04') OR ($segun_paren == '06')){
				?>
						<tr align="center">
						<td height="15" valign=middle class="txt2">ESTUDIO Emitido:</td>
						<td height="15" valign=middle>
							<?	
								$fechaEmiEstudio = $row ['fecha_est_ini'];
								$fechaEmiEstudio2 = date ( "d-m-Y", strtotime ( $fechaEmiEstudio ) );
							?>
									<input type="hidden" name="buff_emi_estudio"  value="<? print $fechaEmiEstudio; ?>" />
									<input type="text" name="" size="11" readonly="readonly" maxlength="10" value="<? print $fechaEmiEstudio2; ?>" />
									</td>
							</tr>
						<tr align="center">
									<td height="15" valign=middle class="txt">Estudio Emitido p/ modif.:</td>
										<td height="15" valign=middle>
										<input type="date" name="f_est_emitido" id="f_est_emitido">
									</td>
						</tr>
					<tr align="center">	
						<td height="15" valign=middle class="txt2">ESTUDIO Vencimiento:</td>
						<td height="15" valign=middle>
							<?	
								$fechaEstvto = $row ['fecha_est_vto'];
								$fechaEstvto2 = date ( "d-m-Y", strtotime ( $fechaEstvto ) );
							?>
									<input type="hidden" name="buff_vto_estudio"  value="<? print $fechaEstvto; ?>" />
									<input type="text" name="" size="11" readonly="readonly" value="<? print $fechaEstvto2; ?>" />
									</td>
							</tr>
						<tr align="center">
									<td height="15" valign=middle class="txt">Estudio Vencimiento p/ modif.:</td>
										<td height="15" valign=middle>
										<input type="date" name="f_est_vencimiento" id="f_est_vencimiento">
									</td>
						</tr>
						
						<tr align="center">
						<td height="15" valign=middle class="txt">Nivel de estudio:</td>
									<td height="15" valign=middle>
							<input type="text" name="nivel_est"  size="20" value="<? print $row['nivel_est']; ?>" /></td>
						</tr>
						
						<tr align="center">
							<td height="15" valign=middle class="txt">Descripción Sobre estudio:</td>
							<td height="15" valign=middle>
							<textarea rows="6" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="descrpcion_est" style="text-transform: uppercase;">
										<? utf8_decode(print $row['des_est']); ?>
							</textarea>
						</tr>
						
				<?}

				
				if (($segun_paren=="08") OR ($segun_paren=="10")) {
					?>
										
										<tr align="center">
											<td height="15" valign=middle class="txt2">DISCAPACIDAD emitido:</td>
											<td height="15" valign=middle>
												<?	
													$fechadiscEm = $row ['fecha_disc_ini'];
													$fechadiscEm2 = date ( "d-m-Y", strtotime ( $fechadiscEm ) );
												?>
														<input type="hidden" name="buff_fdisem" value="<? print $fechadiscEm; ?>" />
														<input type="text" name="" size="11" readonly="readonly" maxlength="10" value="<? print $fechadiscEm2; ?>" />
														</td>
												</tr>
												
											<tr align="center">
														<td height="15" valign=middle class="txt">Discapacidad Emitido p/ modif.:</td>
															<td height="15" valign=middle>
															<input type="date" name="f_disc_emitido" id="f_disc_emitido">
														</td>
											</tr>
										<tr align="center">	
											<td height="15" valign=middle class="txt2">Discapacidad Vencimiento:</td>
											<td height="15" valign=middle>
												<?	
													$fechaDvto = $row ['fecha_disc_vto'];
													$fechaDvto2 = date ( "d-m-Y", strtotime ( $fechaDvto ) );
												?>
														<input type="hidden" name="buff_Dvto"  value="<? print $fechaDvto; ?>" />
														<input type="text" name="" size="11" readonly="readonly" value="<? print $fechaDvto2; ?>" />
														</td>
												</tr>
											<tr align="center">
														<td height="15" valign=middle class="txt">Discapacidad Vencimiento p/ modif.:</td>
															<td height="15" valign=middle>
															<input type="date" name="f_disc_vencimiento" id="f_disc_vencimiento">
														</td>
											</tr>
											
											<tr align="center">
												<td height="15" valign=middle class="txt">Descripción sobre Discapacidad:</td>
												<td height="15" valign=middle>
												<textarea rows="6" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="descrpcion_disc" style="text-transform: uppercase;">
															<? print utf8_decode($row['desc_disc']); ?>
												</textarea>
											</tr>
											
									<?}
				/***************************************************************************************************************/?>
			
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">Tipo parentesco p/ modif.:</td>
				<td height="15" valign=middle>
				<input type="checkbox" name="modif_par" value="si">Check para modificar el tipo de parentesco<br>
  				
  				<select size="1" name="tparen_modif" style="width:300px"  OnChange="activar(this.form);">
					<? $resultados = mysql_query("select cod_paren, desc_paren from parentesco order by cod_paren asc");
					 while ($myrow=mysql_fetch_array($resultados))
						{ ?>
							<option value="<? echo $myrow['cod_paren']; ?>"><? echo utf8_decode($myrow['desc_paren']); ?> </option>
						<? } ?>
				</select>
				<!-- Cajas desplegables -->
				<div id="Caja_estudio" style="display:none;" class='txt'><h2> E S T U D I O </h2>
						<p>Emitido: <input type="date" name="f_est_emitido_modif" id="f_est_emitido"></p>
						<p>Vencimiento: <input type="date" name="f_est_vencimiento_modif" id="f_est_vencimiento"></p>

						<select name="nivel_est_m" id="nivel_est_m">
                                 			<option value="null">Seleccionar Estudio</option>
                                 			<option value="PRIMARIO">PRIMARIO</option>
                                 			<option value="SECUNDARIO">SECUNDARIO</option>
                                 			<option value="TERCIARIO">TERCIARIO</option>
                                 			<option value="OTROS">OTROS</option>
						</select>
						<p>Descripci&oacute;n: <input type="text" name="descripcion_estudio" size="50" maxlength="150" style="text-transform:uppercase;" /></p>

				</div>

				<div id="Caja_discapacidad" style="display:none;" class='txt'><h2> D I S C A P A C I D A D </h2>
						<p>Emitido: <input type="date" name="f_disc_emitido_modif" id="f_disc_emitido"></p>
						<p>Vencimiento: <input type="date" name="f_disc_vencimiento_modif" id="f_disc_vencimiento"></p>
						<p>Descripci&oacute;n: <input type="text" name="descripcion_disc" size="50" maxlength="150" style="text-transform:uppercase;" /></p>

				</div>

				<!-- Terminan las cajas desplegables -->
				
				</td>
			</tr>
					
				
			<tr align="center">
					<td height="15" valign=middle class="txt">Documentación Pendiente:</td>
					<td height="15" valign=middle>
					<textarea rows="9" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="doc_pend" style="text-transform: uppercase;">
						<? print utf8_decode($row['docu_pendiente']); ?>
					</textarea>
			</tr>		
				
				<!-- 			?> -->
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
		
			<tr align="center">
				<td height="15" valign=middle class="txt">Nacionalidad:</td>
				<td height="15" valign=middle><input type="text" name="nacio" size="40" maxlength="50" style="text-transform: uppercase;" value="<? print $row['nacionalidad']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br>····················· RESIDENCIA Y LOCALIZACIÓN DEL FAMILIAR ·····················</td>
				 <td height="15" valign=middle colspan="2" class="txt"><br></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">¿El familiar posee otro domicilio?:</td>
				<td height="15" valign=middle><input type="text" name="otro_domi" size="2"	style="text-transform: uppercase;"	value="<? print $row['otro_domi']; ?>" /></td>
			</tr>
						
			<tr ALIGN="center">
				<td height="15" valign=middle class="txt">Provincia del familiar:</td><td height="15" valign=middle class="txt">
				<input type="text" name="pcia" size="30" style="text-transform:uppercase;" value="<? print utf8_decode($row['pcia_fami']); ?>"/>
				</td>
			</tr>	
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Departamento del familiar:</td>
				<td height="15" valign=middle><input type="text" name="dpto" size="40"	style="text-transform: uppercase;"	value="<? print utf8_decode($row['dpto_fami']); ?>" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Localidad del familiar:</td><td height="15" valign=middle class="txt">
				<input type="text" name="localidad" size="30" style="text-transform:uppercase;" value="<? print utf8_decode($row['localidad_fami']); ?>"/>
				</td>
			</tr>	
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Domicilio:</td>
				<td height="15" valign=middle><input type="text" name="domi" size="40" style="text-transform: uppercase;" value="<? print utf8_decode($row['domicilio_fami']); ?>" /></td>
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
				<td height="15" valign=middle class="txt2">Fecha de carga:<? print "  ".$row["cargado"]; ?></td>
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

<? include("includes/footer.php");
}
?>