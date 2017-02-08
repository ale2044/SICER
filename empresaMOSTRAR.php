<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
include ("fciondiamesanio.php");
include ("fcionzona.php");
include ("fciontipoactividad.php");
include ("fcionbajaEmpre.php");

$user = $_SESSION["user"];
$cuit_empre = $_POST["cuit_empre"];

$sqlBusca="select SUSS from empresas where SUSS='$cuit_empre'";
$resultBusca=mysql_query($sqlBusca, $link);

if (mysql_num_rows($resultBusca)==1){
	$pcias = mysql_query("SELECT * from empresas WHERE SUSS='$cuit_empre'");
	$row=mysql_fetch_assoc($pcias);	
?>

<?include("includes/header.php");?>

<div id="contenedor">
<div id="cajachicasup">
</div>
<div id="cajappal" class='centraTabla'>
<h1 align="center">
 Panel de busqueda de Datos: EMPRESAS || Usuario: <b><? echo $user; ?></b>
</h1>

<? if ($_GET["falto"]=="falta"){ ?>
				<span style="letter-spacing:7px; color: #ffff99; background-color:red" class='txt'><b> ::: Complete TODOS los Campos Obligatorios ::: </b></span>
			<? } ?>
<?
	$a=$row['BAJA'];
		if($a == '*')
		{ ?>
			<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Esta empresa fue dada de BAJA ::: </b></span>
		<? }
?>
			
<form action="empresaBUSCAR.php" name="Buscar..." id="formulario" method="POST">
<div id="CajaEmpre">

<table>
			<tr ALIGN="center" >
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA" class='txt'> Datos encontrados de la Empresa</td>
			</tr>
			
			<tr ALIGN="left">
			<td height="15" valign=middle class='txt'><b>CUIT de Empresa:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['SUSS'];?></td>			    
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b>Nro de EMPRESA:</b> </td>
			    <td height="15" valign=middle class='txt1'>
			    <?	print $row['EMPRESA']; ?></td>			    
			</tr>
						
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b>Clave:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['CLAVE'];?></td>
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Nombre:</b> </td>
			    <td height="15" valign=middle class='txt1'><? print utf8_decode($row['NOMBRE']);?></td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b>Nom. Fantasia: </b></td>
			    <td height="15" valign=middle class='txt1'> <?php print utf8_decode($row['FANTASI']);?></td>
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Domicilio:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print utf8_decode($row['DOMICILIO']);?></td>
			</tr>

			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Telefono #1:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['Telefono1'];?></td>
			</tr>

			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Telefono #2:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['Telefono2'];?></td>
			</tr>

			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Localidad:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['LOCALIDAD'];?></td>
			</tr>
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Provincia:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['PROVINCIA'];?></td>
			</tr>			

			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Cód. Postal:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['CODPOST'];?></td>
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Zona: </b></td>
			    <td height="15" valign=middle class='txt1'><?php print $row['ZONA'];?></td>
			</tr>

			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Sub Zona:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['SZONA'];?></td>			    
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Fecha de Ingr. al sistema:</b></td>
			    <td height="15" valign=middle class='txt1'><?php print $row['FINGRESO'];?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· ACTIVIDAD(ES) ····················· </td>
			</tr>

			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Tipo Actividad principal:</b></td>
			    <td height="15" valign=middle class='txt1'> 
					<? $act = $row['TIPACT'] ;$act=mysql_query("SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' ");
					$row1=mysql_fetch_assoc($act); 
					if ($row['TIPACT']=="null") {print "No tiene actividad";} else {print utf8_decode($row['TIPACT'].' - '.$row1['DESCRIPCION']);} ?>
				</td>
			</tr>
			    			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Sub Actividad: </b></td>
			    <td height="15" valign=middle class='txt1'> 
					<? $act = $row['SUBACT'] ;$act=mysql_query("SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' ");
					$row1=mysql_fetch_assoc($act); 
					if ($row['SUBACT']=="null") {print "No tiene actividad";} else {print utf8_decode($row['SUBACT'].' - '.$row1['DESCRIPCION']);} ?>
				</td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> 3ra Actividad: </b></td>
			    <td height="15" valign=middle class='txt1'> 
					<? $act = $row['SUBACTII'] ;$act=mysql_query("SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' ");
					$row1=mysql_fetch_assoc($act); 
					if ($row['SUBACTII']=="null") {print "No tiene actividad";} else {print utf8_decode($row['SUBACTII'].' - '.$row1['DESCRIPCION']);} ?>
				</td>
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> 4ta Actividad: </b></td>
			    <td height="15" valign=middle class='txt1'> 
					<? $act = $row['SUBACTIII'] ;$act=mysql_query("SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' ");
					$row1=mysql_fetch_assoc($act); 
					if ($row['SUBACTIII']=="null") {print "No tiene actividad";} else {print utf8_decode($row['SUBACTIII'].' - '.$row1['DESCRIPCION']);} ?>
				</td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> 5ta Actividad: </b></td>
			    <td height="15" valign=middle class='txt1'> 
					<? $act = $row['SUBACTIV'] ;$act=mysql_query("SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' ");
					$row1=mysql_fetch_assoc($act); 
					if ($row['SUBACTIV']=="null") {print "No tiene actividad";} else {print utf8_decode($row['SUBACTIV'].' - '.$row1['DESCRIPCION']);} ?>
				</td>
			</tr>

			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Inicio Activ.:</b></td>
			    <td height="15" valign=middle class='txt1'> <?php print $row['FINIACT'];?></td>			    
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ············································································ </td>
			</tr>

			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'> <b>Ult. Período OS:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['ULTPEROS'];?><br/>
			    <small>"Ultimo período de OS(AAAAmm)"</small><br/></td>		    
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'> <b>Ult. Período Sindical:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['ULTPERSI'];?><br/>
			    <small>"Ultimo período de Sindical(AAAAmm)"</small><br/></td>		    
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'> <b>Ult. Período Mutual:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['ULTPERMUT'];?><br/>
			    <small>"Ultimo período Mutual(AAAAmm)"</small><br/></td>		    
			</tr>

			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'> <b>Cant. Personal:</b></td>
			    <td height="15" valign=middle class='txt1'> <?php print $row['CANTPERS'];?></td>
			</tr>

			<tr ALIGN="left">
				<td height="15" valign=middle class='txt'> <b>Personal en OS: </b></td>
			    <td height="15" valign=middle class='txt1'><?php print $row['CANEMPOS'];?></td>
			</tr>

			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Personal en SINDICATO:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['CANEMPSI'];?></td>
			</tr>

			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> E-mail: </b></td>
			    <td height="15" valign=middle class='txt1'><?php print $row['E_MAIL'];?></td>
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class="txt"><b>Estudio Contable:</b></td>
					<td height="15" valign=middle class="txt1">
						<?
							$act = $row ['ESTCONTA'];
							$act = mysql_query ( "SELECT D_ESTUDIO from estconta WHERE C_ESTUDIO='$act'" );
							$row1 = mysql_fetch_assoc ( $act );
							print $row['ESTCONTA'].' - '.$row1['D_ESTUDIO']; 
						?>
					</td>
			</tr>
						
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Observaciones:</b></td>
			    <td height="15" valign=middle class='txt1'> <?php print utf8_decode($row['OBSERV']);?></td>
			</tr>
			
			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Observaciones de Fiscalización/Cobranzas:</b></td>
			    <td height="15" valign=middle class='txt1'> <?php print utf8_decode($row['OBSERVFC']);?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ····················· DATOS SOBRE BAJAS ····················· </td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b> Fecha de Baja.:</b></td>
			    <td height="15" valign=middle class='txt1'> <?php print $row['FBAJA'];?></td>			    
			</tr>

			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'><b> Observaciones por baja: </b></td>
			    <td height="15" valign=middle class='txt1'><?php print $row['OBSERV_BAJA'];?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'><br> ············································································ </td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'> <b>Último usuario en modificar: </b></td>
			    <td height="15" valign=middle class='txt1'> <?php print $row['USUARIO'];?></td>
			</tr>

			<tr ALIGN="left" class="color">
			    <td height="15" valign=middle class='txt'> <b>Fecha de carga en la Filial: </b></td>
			    <td height="15" valign=middle class='txt1'> <?php print $row['FECHACARGA_FIL'];?></td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt'><b>Última modificación:</b> </td>
			    <td height="15" valign=middle class='txt1'><?php print $row['FECHMODIF'];?></td>
			</tr>

					
</table>	
</div> <!-- CajaEmpre -->


<table>
		<tr>

			<td width="" height="23" align="center" valign="middle" class="mn">
				<a href="menu.php" class="cancelar">Menú</a>
				<input type="submit" size="8" name="busca_empre" class = 'inicio' value="Volver a buscar">
			</td>
		</tr>
</table>
</form>
<div id="cajapie">

</div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->


<?

include("includes/footer.php");

}else

{
	$alerta=407; //CUIT NO ENCONTRADO;
	header("Location: menu.php?alerta=$alerta");	
}}
?>