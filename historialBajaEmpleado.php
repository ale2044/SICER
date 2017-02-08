<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION["user"];
$cuil_titu = $_POST["cuiltitu"];

//$sqlBusca="select CUIL from historial_titu where CUIL='$cuil_titu'";
//$resultBusca=mysql_query($sqlBusca, $link);

?>

<?include("includes/header.php");?>

<script type="text/javascript" src="cargarDptos.js"></script>

<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>

<div id="contenedor">

<div id="cajachicasup"></div>

<!--'document.getElementById(fecha).disabled = true;-->

<div id="cajappal" class='centraTabla'>

<h1 align="center" class="emple">
Panel de HISTORIAL DE BAJA DEL EMPLEADO || Usuario: <b><? echo $user; ?></b>
</h1>

<div id="CajaEmple">

<table>
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· HISTORIAL DE BAJAS ····················· </td>
			</tr>
			<? $cont = 0;
					$pcias=mysql_query("SELECT * from historial_titu WHERE CUIL='$cuil_titu' ");
								while($row = mysql_fetch_array($pcias)){
			 ?>
			  
				
			  <tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· DATOS PERSONALES ····················· </td>
			</tr>
			
			<tr ALIGN="center">
			   <td height="15" valign=middle class="txt" >Número de Afiliado: </td>
 			   <td height="15" valign=middle class='txt1'><? print $row['TNAFI']; ?></td>
			</tr>
			
			<tr ALIGN="center" class="color">
			   <td height="15" valign=middle class="txt"> CUIL TITULAR:</td>
			   <td height="15" valign=middle class="txt1"><? print $row['CUIL']; ?></td>
			   <td height="15" valign=middle>
			   		<input type="hidden" name="cuiltitu" size="40" value="<? print $row['CUIL']; ?>"/>
			    </td>
			</tr>
		
			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> Apellido:</td>
			   <td height="15" valign=middle class='txt1'><? print utf8_decode($row['TAPEL']); ?></td>
			</tr>

			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class='txt'> Nombres:</td>
			    <td height="15" valign=middle class='txt1'><? print utf8_decode($row['TNOMB']); ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Tipo y Nro de documento:</td>
 			    <td height="15" valign=middle class='txt1'><? print $row['TTDOC']." ".$row['TNDOC']; ?>
			</tr>
			
			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class='txt'> Sexo:</td>
			   <td height="15" valign=middle class='txt1'><? print $row['TSEXO']; ?></td>
			</tr>
						
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de nacimiento:</td>
					<td height="15" valign=middle class="txt1">
						<?
							$naci1 = $row ['TFNAC'];
							if ( $naci1 == null ){ $naci1='0000-00-00'; }
							if ( $naci1 != '0000-00-00' ){
							print $naci2 = date ( "d-m-Y", strtotime($naci1) );
							}
						?>
					</td>
			</tr>
			
			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class="txt">Estado Civil:</td>
 			    <td height="15" valign=middle class="txt1"><? print $row['TESCI']; ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Nacionalidad:</td>
			    <td height="15" valign=middle class="txt1"><? print utf8_decode(print $row['TNACI']); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· RESIDENCIA Y LOCALIZACIÓN ····················· </td>
			</tr>
			
			<tr ALIGN="center" class="color">
				<td height="15" valign=middle class="txt">Zona y Provincia:</td>
				<td height="15" valign=middle class="txt1"><? print  $row['TZONA']." - ".$row['PCIA']; ?></td>
			</tr>	

			<tr ALIGN="center">
			     <td height="15" valign=middle class="txt"> Departamento: </td>
			  	 <td height="15" valign=middle class="txt1"><? print utf8_decode($row['DPTO']); ?></td>
			</tr>

			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class="txt">C.P. y Localidad:</td>
			    <td height="15" valign=middle class="txt1"><? print utf8_decode($row['TCPOS']." - ".$row['TLOCA']); ?></td>
			</tr>				
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Domicilio: </td>
			    <td height="15" valign=middle class="txt1"><?  print utf8_decode($row['TDOMI']);?></td>
			</tr>

			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class="txt"> Tel. Fijo:</td>
			    <td height="15" valign=middle class="txt1"><? print $row['TTELE']; ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Tel. Celu.</td>
			    <td height="15" valign=middle class="txt1"><? print $row['TTELE2']; ?></td>
			</tr>
			
			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class="txt"> E-mail:</td>
			    <td height="15" valign=middle class="txt1"><? print utf8_decode($row['MAIL']); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· DATOS LABORALES ····················· </td>
			</tr>
			
			<tr ALIGN="center">
				<td height="15" valign=middle  class="txt">CUIT EMPRESA:</td>
					<?
						// Muestra según el empleado, si es desempleado, jubilado o está en una empresa.
 			   			switch ($row['CUITEMPRESA']){
			   				case '9999':?><td height="15" valign=middle class="txt1">DESEMPLEADO</td><?
			   					break;
							case '8888':?><td height="15" valign=middle class="txt1">CAJA DE JUBILACIONES</td><?
								break;
			   				default: ?><td height="15" valign=middle class="txt1"><? print $row['CUITEMPRESA']; ?></td><?
			   }  ?>
			</tr>
						
			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Fecha de Ingreso a la empresa:</td>
					<td height="15" valign=middle class="txt1">
						<?
							$fing1 = $row ['TFING'];
							if ( $fing1 == null ){ $fing1='0000-00-00'; }
								if ( $fing2 != '0000-00-00' ){
								print $fing2 = date ( "d-m-Y", strtotime($fing1) );
							}
						?>
					</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Categoría Laboral:</td>
				<td height="15" valign=middle class="txt1">
					<?
						$act = $row ['TIPOACT'];
						$act = mysql_query ( "SELECT DESCRIPCION from tipoactividad WHERE TIPOACT='$act'" );
						$row1 = mysql_fetch_assoc ( $act );
						print utf8_decode($row['TIPOACT'].' - '.$row1['DESCRIPCION']); 
					?>
				</td>
			</tr>

			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Inicio de Actividad:</td>
					<td height="15" valign=middle class="txt1">
						<?
							$fechaini = $row ['INIACT'];
							if ( $fechaini == null ){ $fechaini='0000-00-00'; }
								if ( $fechaini != '0000-00-00' ){
									print $fechaini2 = date ( "d-m-Y", strtotime($fechaini) );
						}
						?>
					</td>
			</tr>
			
			<tr align="center" class="color">
				<td height="15" valign=middle class="txt">Tipo afiliado:</td>
				<td height="15" valign=middle class="txt1"><? print $row['TLETT']; ?></td>
			</tr>
						
			<tr align="center">
				<td height="15" valign=middle class="txt">Sueldo B&aacute;sico:</td>
				<td height="15" valign=middle class="txt1"><? print $row['SueldoBasico']; ?></td>
			</tr>
			
			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Fecha de desempleo desde:</td>
					<td height="15" valign=middle class="txt1">
				<?
					$fecha1 = $row ['DESEMDESDE'];					
					if ( $fecha1 == null ){ $fecha1='0000-00-00'; }
					if ( $fecha1 != '0000-00-00' ){
						print $fecha2 = date ( "d-m-Y", strtotime($fecha1) );
					}
				?>
					</td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de desempleo hasta:</td>
					<td height="15" valign=middle class="txt1">
						<?
							$des1 = $row ['DESEMHASTA'];
							if ( $des1 == null ){ $des1='0000-00-00'; }
							if ( $des1 != '0000-00-00' ){
								print $des2 = date ( "d-m-Y", strtotime($des1) );
								}
						?>
					</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS OBRA SOCIAL ····················· </td>
			</tr>
			
			<tr ALIGN="center" class="color">
			   <td height="15" valign=middle class='txt'> OBRA SOCIAL:</td>
			   <td height="15" valign=middle class="txt1"><? print $row['TOSOC']; ?></td>
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> Tipo de Obra Social:</td>
			   <td height="15" valign=middle class="txt1"><? print $row['ORIGENOS']; ?></td>
			</tr>

			<tr ALIGN="center" class="color">
			   <td height="15" valign=middle class='txt'> Habilitación Padrón Dec. Jur. O.S.:</td>
			   <td height="15" valign=middle class="txt1"><? print $row['HaPaDjObSo']; ?></td>
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> Motivo Habilitaci&oacute;n:</td>
			   <td height="15" valign=middle class="txt1"><? print $row['MotivoHab']; ?></td>
			</tr>

			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Fecha de ALTA de Obra Social:</td>
					<td height="15" valign=middle class="txt1">
						<?
						$faltaos = $row ['FeAltaObSoc'];
						if ( $faltaos == null ){ $faltaos='0000-00-00'; }
						if ( $faltaos != '0000-00-00' ){
							print $faltaos2 = date ( "d-m-Y", strtotime($faltaos) );
						}
						?>
					</td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de BAJA de Obra Social:</td>
					<td height="15" valign=middle class="txt1">
						<?
						$fbaja1 = $row ['TFECBAJAOS'];
						if ( $fbaja1 == null ){ $fbaja1='0000-00-00'; }
						if ( $fbaja1 != '0000-00-00' ){
							print $fbaja2 = date ( "d-m-Y", strtotime($fbaja1) );
						}
						?>
					</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS SINDICAL ····················· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">SINDICATO:</td>
				<td height="15" valign=middle class="txt1"><? print $row['TSINDI'];/*antes tenia tsindi*/ ?></td>
			</tr>
			
			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Alta Sindicato:</td>
					<td height="15" valign=middle class="txt1">
						<?
							$alt1 = $row ['TFINS'];
							if ( $alt1 == null ){ $alt1='0000-00-00'; }
							if ( $alt1 != '0000-00-00' ){
							print $alt2 = date ( "d-m-Y", strtotime($alt1));
							}
						?>
					</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Nro. Sindical:</td>
			    <td height="15" valign=middle class="txt1"><? print $row['TNSIN']; ?></td>
			</tr>
			
			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Fecha de BAJA de Sindicato:</td>
					<td height="15" valign=middle class="txt1">
						<?
							$fbaja1 = $row ['TFECBAJS'];
							if ( $fbaja1 == null ){ $fbaja1='0000-00-00'; }
							if ( $fbaja1 != '0000-00-00' ){
								print $fbaja2 = date ( "d-m-Y", strtotime($fbaja1) );
							}
						?>
					</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS MUTUAL ····················· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">AMUTCAER:</td>
				<td height="15" valign=middle class="txt1"><? print $row['TMUT'];/*ANTES TMUTUAL*/ ?></td>
			</tr>
			
			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class="txt"> Nro. Mutual:</td>
			    <td height="15" valign=middle class="txt1"><? print $row['NMUTUAL']; ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Ult. Pag. Mutual:</td>
			    <td height="15" valign=middle class="txt1"><? print $row['UltPagMutual']; ?></td>
			</tr>
			
			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Alta MUTUAL:</td>
					<td height="15" valign=middle class="txt1">
						<?
							$altm1 = $row ['TFINMUTUAL'];
						if ( $altm1 == null ){ $altm1='0000-00-00'; }
						if ( $altm1 != '0000-00-00' ){
							print $altm2 = date ( "d-m-Y", strtotime($altm1) );
						}
						?>
					</td>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de BAJA en Mutual:</td>
					<td height="15" valign=middle class="txt1">
						<?
						$fbmutual1 = $row ['TFECBAJM'];
						if ( $fbmutual1 == null ){ $fbmutual1='0000-00-00'; }
						if ( $fbmutual1 != '0000-00-00' ){
							print $fbmutual2 = date ( "d-m-Y", strtotime($fbmutual1) );
						}
						?>
					</td>
			</tr>
						
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS FAMILIARES	 ····················· </td>
			</tr>

			<tr ALIGN="center" class="color">
			   <td height="15" valign=middle class="txt" colspan="2" >Cant. de Familiares: <? print $row['TFAMI']."    "; ?>
						Flia a cargo: <? print $row['TFAMCAR']; ?>
			   </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha Plan Materno Infantil:</td>
					<td height="15" valign=middle class="txt1">
						<?
							$fpm1 = $row ['TFPMI'];
							if ( $fpm1 == null ){ $fpm1='0000-00-00'; }
							if ( $fpm1 != '0000-00-00' ){
								print $fpm2 = date ( "d-m-Y", strtotime($fpm1) );
							}
						?>
				</td>
				
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· DATOS SOBRE DISCAPACIDAD	 ····················· </td>
			</tr>
			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class='txt'> Tipo de discapacidad:</td>
			    <td height="15" valign=middle class="txt1"><? print $row['TDISC']; ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Tipo de patología:</td>
			    <td height="15" valign=middle class='txt1'><? print $row['TPATO']; ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class="txt"><br></br> ····················· MOTIVO DE BAJA (MUTUAL/SINDICAL/O.S.): ····················· </td>
			</tr>			

<!-- modificando el codigo de baja-->
			<tr ALIGN="center" class="color">
			    <td height="15" valign=middle class='txt'>MOTIVO DE BAJA: </td>
				<td height="15" valign=middle>
			<? $act = $row['MOTBAJA'] ;$act=mysql_query("SELECT CTDES from bajas_determ WHERE CTCOD='$act' ");
					$row1=mysql_fetch_assoc($act);
					
					print $row['MOTBAJA'].' - '.$row1['CTDES']; ?></td>
			</tr>
			
			<tr ALIGN="center"><td height="15" valign=middle class="txt">Observaciones por Modificación: </td>
			<td height="15" valign=middle>
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obnserva01" style="text-transform: uppercase;">
						<? print utf8_decode($row['MOTIVOMODIFICA']); ?>
					</textarea>
			</tr>
		
			<tr align="center" class="color">
					<td height="15" valign=middle class="txt">Observaciones:</td>
					<td height="15" valign=middle>
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obser" style="text-transform: uppercase;">
						<? print utf8_decode($row['OBSERV']); ?>
					</textarea>
			</tr>	
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2"><span class="req">::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::<br>
			    ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::</span></td>
			</tr>
										
									
			<?}?>
				
		</table>
		
</div> <!-- CajaEmpre -->

			<table>
				<tr>

					<td width="" height="23" align="center" valign="middle">
						<button onclick="window.location.href='menu.php'" class="inicio">Inicio</button>
					</td>
				</tr>
			</table>


<div id="cajapie"></div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->

<? include("includes/footer.php");
}
?>