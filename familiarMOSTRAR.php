<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

include ("fcioncalcularedad.php");

$user = $_SESSION["user"];
$dni_flia = $_POST["dni_fami"];

$sqlBusca="select FNDOC from famiba where FNDOC='$dni_flia'";
$resultBusca=mysql_query($sqlBusca, $link);

if(mysql_num_rows($resultBusca)==1){
	$pcias=mysql_query("SELECT * from famiba WHERE FNDOC='$dni_flia'");
	$row=mysql_fetch_assoc($pcias);
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

<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
	<div id="contenedor">
	<div id="cajachicasup"></div>
		<div id="cajappal" class='centraTabla'>
			<h1 align="center">
				Panel de Mostrar Datos del FAMILIAR || Usuario: <b><? echo $user; ?></b>
			</h1>

	<?

	$cuit_titu = $row['CUILTITU'];
	$sqlBuscaTitu="select * from titulares where CUIL='$cuit_titu'";
	$resultBuscaTitu=mysql_query($sqlBuscaTitu, $link);
	if(mysql_num_rows($resultBuscaTitu)==1){
		$row2=mysql_fetch_assoc($resultBuscaTitu);
		$a= $row2['TBMUT'];
		$b= $row2['TBOSOC'];
		$c= $row2['TBSINDI'];

	}
		if(($a == 'SI')||($b == 'SI')||($c == 'SI'))
		{
			?>
			<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: El TITULAR de este familiar fue dado de BAJA ::: </b></span>			
	 <? } ?>

	 <? if($row['FMARC']=='*'){?>
	 <span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: El Familiar fue dado de BAJA el <? print $row['FFBAJ'];?> ::: </b></span>
	 <? } ?>
	 
<div id="CajaNotificacion"><div class="txt">CUIL y NOMBRE del FAMILIAR:<strong> 
<? print $row['CUILFAMI']; print  utf8_decode(" || ".$row["APELFAMI"]." ".$row["NOMFAMI"]); ?></strong></div></div>
		
<div id="CajaFami" class="centraTabla">
	<table>			
			<tr align="center"  class="color">
				<td height="15" valign=middle class="txt">CUIL TITULAR:</td>
				<td height="15" valign=middle class="txt"><? print $row['CUILTITU']; ?></td>
			</tr>			

			<tr align="center">
				<td height="15" valign=middle class="txt">Tipo de Afiliado (familiar):</td>
				<td height="15" valign=middle class="txt"><? 

				switch ($row['FLETF']){
						case 'D': print 'ADHERENTE';
						break;
						case 'J': print 'JUBILADO';
						break;
						case 'B': print 'PENSIONADO';
						break;
						case 'N': print 'NO AFILIADO';
						break;
						case 'U': print 'UNIFICACION DE APORTE';
						break;
						case 'O': print 'SERVICIO DOMENTICO';
						break;
						default: print 'NO FUE ASIGNADO';
						break;
				};

			 ?></td>
			</tr>			
			
			<tr align="center"  class="color">
				<td height="15" valign=middle class="txt">ORDEN:</td>
				<td height="15" valign=middle class="txt"><?
												$str = $row['FORDE'];
												if (strlen($str)=='1'){
													echo '0'.$str;
												}else echo $str;

			?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br> ····················· DATOS PERSONALES	 ····················· </td>
			</tr>


			
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">CUIL FAMILIAR:</td>
				<td height="15" valign=middle class="txt"><? print $row['CUILFAMI']; ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Tipo y número de DNI:</td>
			    <td height="15" valign=middle class="txt"><? print $row['FTDOC']." ".$row['FNDOC']; ?></td>
			</tr>
			
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">Apellido:</td>
				<td height="15" valign=middle class="txt"><? print  utf8_decode($row['APELFAMI']); ?></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Nombres:</td>
				<td height="15" valign=middle class="txt"><? print  utf8_decode($row['NOMFAMI']); ?></td>
			</tr>
			
			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Fecha de nacimiento:</td>
					<td height="15" valign=middle class="txt">
						<?
							$naci1 = $row ['FFNAC'];
							if ( $naci1 == null ){ $naci1='0000-00-00'; }
							if ( $naci1 != '0000-00-00' ){
							print $naci2 = date ( "d-m-Y", strtotime($naci1) );
							}
						?>
					</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Edad:</td>
			    <td height="15" valign=middle class="txt"><? calcular_edad($row['FFNAC']); ?></td>
			</tr>
			
			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class="txt">Sexo:</td>
			    <td height="15" valign=middle class="txt"><? print $row['FSEXO']; ?></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Nacionalidad:</td>
				<td height="15" valign=middle class="txt"><? print  utf8_decode($row['NACIONALIDAD']); ?></td>
			</tr>
			
			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class="txt">P.M.I.:</td>
			    <td height="15" valign=middle class="txt"><? print $row['PMI']; ?></td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha venc. P.M.I.:</td>
					<td height="15" valign=middle class="txt">
						<?
							$fpmi1 = $row ['F_PMIVTO'];
							if ( $fpmi1 == null ){ $fpmi1='0000-00-00'; }
							if ( $fpmi1 != '0000-00-00' ){
							print $fpmi2 = date ( "d-m-Y", strtotime($fpmi1) );
							}
						?>
					</td>
			</tr>
			
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">Tipo de Parentesco</td>
				<td height="15" valign=middle class="txt">
					<?
						$act = $row ['FPARE'];
						$act = mysql_query ( "SELECT cod_paren, desc_paren from parentesco WHERE cod_paren='$act'" );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					<? print utf8_decode($row['FPARE'].' - '.$row1['desc_paren']); ?>
				</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">ESTUDIO Emitido:</td>
				<td height="15" valign=middle class="txt">
					<? 		
							$feemi1 = $row ['F_ESTADOINI'];
							if ( $feemi1 == null ){ $feemi1='0000-00-00'; }
							if ( $feemi1 != '0000-00-00' ){
							print $feemi2 = date ( "d-m-Y", strtotime($feemi1) );
							}
					?>
				</td>
			</tr>
			
			<tr align="center" class="color">	
				<td height="15" valign=middle class="txt">ESTUDIO Vencimiento:</td>
				<td height="15" valign=middle class="txt">
						<?
							$esv1 = $row ['F_ESTADOVTO'];
							if ( $esv1 == null ){ $esv1='0000-00-00'; }
							if ( $esv1 != '0000-00-00' ){
							print $esv2 = date ( "d-m-Y", strtotime($esv1) );
							}
						?>
				</td>
			</tr>
								
			<tr align="center">
				<td height="15" valign=middle class="txt">Nivel de estudio:</td>
				<td height="15" valign=middle class="txt"><? print $row['NIVELEST']; ?></td>
			</tr>
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">Descripción Sobre estudio:</td>
				<td height="15" valign=middle class="txt">
							<textarea rows="6" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="descrpcion_est" style="text-transform: uppercase;">
										<? print  utf8_decode($row['DESEST']); ?>
							</textarea>
			</tr>
				
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Discapacidad:</td>
			    <td height="15" valign=middle class="txt"><? print  utf8_decode($row['DISC']); ?></td>
			</tr>
						
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt2">DISCAPACIDAD emitido:</td>
				<td height="15" valign=middle class="txt">
					<?	
							$demi1 = $row ['F_DISCVTO'];
							if ( $demi1 == null ){ $demi1='0000-00-00'; }
							if ( $demi1 != '0000-00-00' ){
							print $demi2 = date ( "d-m-Y", strtotime($demi1) );
							}
					?>
				</td>
			</tr>
												
			<tr align="center">	
			<td height="15" valign=middle class="txt2">Discapacidad Vencimiento:</td>
			<td height="15" valign=middle class="txt">
						<? 
							$dv1 = $row ['F_DISCVTO'];
							if ( $dv1 == null ){ $dv1='0000-00-00'; }
							if ( $dv1 != '0000-00-00' ){
							print $dv2 = date ( "d-m-Y", strtotime($dv1) );
							}
						?>
			</td>
			</tr>
			
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">Descripción sobre Discapacidad:</td>
					<td height="15" valign=middle class="txt">
							<textarea rows="6" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="descrpcion_disc" style="text-transform: uppercase;">
							<? print  utf8_decode($row['DESCDISC']); ?>
							</textarea>
							</tr>
		
			<tr align="center">
					<td height="15" valign=middle class="txt">Documentación Pendiente:</td>
					<td height="15" valign=middle class="txt">
					<textarea rows="9" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="doc_pend" style="text-transform: uppercase;">
						<? print utf8_decode($row['DOCPEND']); ?>
					</textarea>
			</tr>


			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br>····················· DATOS AFILIATORIOS ·····················</td>
				 <td height="15" valign=middle colspan="2" class="txt"><br></td>
			</tr>
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">Fecha de Ingreso O.S.:</td>
				<td height="15" valign=middle class="txt"><?
							$fos1 = $row ['FechaIngOS'];
							if ( $fos1 == null ){ $fos1='0000-00-00'; }
							if ( $fos1 != '0000-00-00' ){
							print $fos2 = date ( "d-m-Y", strtotime($fos1) );
							}
				?></td>
			</tr>
			<tr align="center">
				<td height="15" valign=middle class="txt">Fecha de Ingreso Sindicato:</td>
				<td height="15" valign=middle class="txt"><?
							$fsi1 = $row ['FechaIngSI'];
							if ( $fsi1 == null ){ $fsi1='0000-00-00'; }
							if ( $fsi1 != '0000-00-00' ){
							print $fsi2 = date ( "d-m-Y", strtotime($fsi1) );
							}
				?></td>
			</tr>
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">Fecha de Ingreso AMUTCAER.:</td>
				<td height="15" valign=middle class="txt"><? 
							$fmu1 = $row ['FechaIngMU'];
							if ( $fmu1 == null ){ $fmu1='0000-00-00'; }
							if ( $fmu1 != '0000-00-00' ){
							print $fmu2 = date ( "d-m-Y", strtotime($fmu1) );
							}
				?></td>
			</tr>
							
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br>····················· RESIDENCIA Y LOCALIZACIÓN DEL FAMILIAR ·····················</td>
				 <td height="15" valign=middle colspan="2" class="txt"><br></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">¿El familiar posee otro domicilio?:</td>
				<td height="15" valign=middle class="txt"><? print  utf8_decode($row['OTRODOMI']); ?></td>
			</tr>
						
			<tr ALIGN="center" class="color">
				<td height="15" valign=middle class="txt">Provincia del familiar:</td>
				<td height="15" valign=middle class="txt">
				<? print  utf8_decode($row['PCIFAMI']); ?>
				</td>
			</tr>	
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Departamento del familiar:</td>
				<td height="15" valign=middle class="txt"><? print  utf8_decode($row['DPTOFAMI']); ?></td>
			</tr>

			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class="txt">Localidad del familiar:</td><td height="15" valign=middle class="txt">
				<? print  utf8_decode($row['LOCALFAMI']); ?>
				</td>
			</tr>	
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Domicilio:</td>
				<td height="15" valign=middle class="txt"><? print  utf8_decode($row['DOMIFAMI']); ?></td>
			</tr>

			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Motivo de modificaci&oacute;n:</td>
					<td height="15" valign=middle class="txt">
					<textarea rows="9" cols="40" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="doc_pend" style="text-transform: uppercase;">
						<? print utf8_decode($row['MotivoModifica']); ?>
					</textarea>
			</tr>
	</table>
	
	<table>
		<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2"><br>···················································································· </td>
		</tr>
		<tr ALIGN="center">
				<td height="15" valign=middle class="txt2">Modificado por:<? print "  ".$row["USUARIO"]; ?></td>
		</tr>
		
		<tr align="center">
				<td height="15" valign=middle class="txt2">Última modificación:<? print "  ".$row["CARGADO"]; ?></td>
		</tr>
		
		<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
		</tr>
		</table>
		
</div> <!-- Cajaempre -->


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
</body>
</html>
<? } 
include("includes/footer.php");
}
?>