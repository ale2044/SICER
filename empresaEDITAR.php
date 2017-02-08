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
include ("fcionactividadafip.php");
include ("fcionSubactividadafip.php");
include ("fcionEstudioContable.php");
include ("fcionbajaEmpre.php");
include ("fcion_dptos_er.php");

$user = $_SESSION["user"];
$cuit_emp = $_POST["cuit_empre"];
$cuit_buffer = $_POST["cuit_empre"];

$sqlBusca="select SUSS from empresas where SUSS='$cuit_emp'";
$resultBusca=mysql_query($sqlBusca, $link);

if (mysql_num_rows($resultBusca)==1){	

$pcias = mysql_query("SELECT * from empresas WHERE SUSS='$cuit_emp'");
$row=mysql_fetch_assoc($pcias);
?>


<?include("includes/header.php");?>

<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>

<!--  Scripts propios del sistema empresaEditar  -->
<script>
function esconde(form)
{
if(document.getElementById('dar_alta').checked){
	formulario.graba.style.visibility = "visible";
}
else {
formulario.graba.style.visibility = "hidden"; }
}

function informarcuit()
{
	alert("ATENCI\u00d3N: Recuerde que al modificar el CUIT cambiará también el de sus empleados asociados a su empresa!");
}

function agregarEstudio()
{
	var cont = document.formulario.agregarEstudioContable.value;
	
	if (cont == "1"){
		var lugar='editar'; var cuitmos="<? print $_POST['cuit_empre']; ?>";
		
		window.location = "estudiocontableALTA.php?lugar=" + lugar+"&cuit_empre="+cuitmos;
	}
}

/*para obtener la variable _GET*/
function getVarsUrl(){
    var url= location.search.replace("?", "");
    var arrUrl = url.split("&");
    var urlObj={};   
    for(var i=0; i<arrUrl.length; i++){
        var x= arrUrl[i].split("=");
        urlObj[x[0]]=x[1]
    }
    return urlObj;
}
</script>

<script>
function activar_campo(form)
{
	formulario.cuit_empre.disabled=true;
	formulario.clave.disabled=true;
	formulario.prov.disabled=true;
	formulario.nombr.disabled=true;
	formulario.domici.disabled=true;
	formulario.tele1.disabled=true;
	formulario.tele2.disabled=true;
	formulario.locali.disabled=true;
	formulario.cp.disabled=true;
	formulario.zna.disabled=true;
	formulario.sz.disabled=true;
	formulario.cantprs.disabled=true;
	formulario.canmpos.disabled=true;
	formulario.cemps.disabled=true;
	formulario.obser.disabled=true;
	formulario.observb.disabled=true;
	formulario.fantasii.disabled=true;
	formulario.email.disabled=true;
	formulario.obserfc.disabled=true;//observación de fisacalización y finanzas
	formulario.tipoact1.disabled=true;
	formulario.tipoact2.disabled=true;
	if(document.getElementById('dar_alta').checked){ 
	formulario.cuit_empre.disabled=false;
	formulario.clave.disabled=false;
	formulario.prov.disabled=false;
	formulario.nombr.disabled=false;
	formulario.domici.disabled=false;
	formulario.tele1.disabled=false;
	formulario.tele2.disabled=false;
	formulario.locali.disabled=false;
	formulario.cp.disabled=false;
	formulario.zna.disabled=false;
	formulario.obserfc.disabled=false;//observación de fisacalización y finanzas
	formulario.sz.disabled=false;
		
	formulario.cantprs.disabled=false;
	
	formulario.canmpos.disabled=false;
	formulario.cemps.disabled=false;
	formulario.obser.disabled=false;
	formulario.observb.disabled=false;
	formulario.fantasii.disabled=false;
	formulario.email.disabled=false;
	formulario.tipoact1.disabled=false;
	formulario.tipoact2.disabled=false;
	}
}

</script>
</head>

<body>
<div id="contenedor">
<div id="cajachicasup">
</div>
<div id="cajappal" class='centraTabla'>
<h1 align="center">
Panel de EDICI&Oacute;N de Datos: EMPRESAS || Usuario: <b><? echo $user; ?></b>
</h1>

<? if ($_GET["falto"]=="falta"){ ?>
				<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Complete TODOS los Campos Obligatorios ::: </b></span>
			<? } ?>
			
<?
	$a=$row['BAJA'];
		if($a == '*')
		{
			?>
			<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Esta empresa fue dada de BAJA ::: </b></span>
			<input type="hidden"/>
<? } ?>

<!-- style="background:#80BFFF" -->
<div id="cajacuadro">
<table>
<tr>
<td align="center"  class="txt" >

				<p>¿Desea modificar los datos?:
				<input type="checkbox" name="dar_alta" id="dar_alta" onclick="activar_campo(this.form), esconde(this.form)" />Si	</p>		
</td>
</tr>
</table>
</div>


<form action="actualiza_empre.php" name="formulario" id="formulario" method="POST">

<div id="CajaEmpre" class='centraTabla'>

<table>

			<tr><td>
			<input type="hidden" name="cuit_buffer" size="40" maxlength="11"    
			value="<? print $cuit_buffer; ?>" class=":integer :max_length;11" /></td></tr>
			<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA"> Modifique los Datos de la Empresa que desee </td>
			</tr>

						
			<? $a=$row['BAJA'];
				if($a == '*')
			{ ?>
			<tr ALIGN="center">
			<td height="15" valign=middle style="background:#ffff99">Dar de alta?:<br/></td>
			<td height="15" valign=middle><select id="alta" name="alta">
  				<option value="si">Si</option>
  				<option value="no" selected="selected">No</option> 
			</select></td></tr>
			<? } ?>
			
<!-- 			<td height="10" valign=middle><input type="checkbox" name="solo_empre" id="solo_empre" value="si" />Modificar solo la empresa</td> -->
			
			<tr ALIGN="center">
				<td height="15" valign=middle class='txt'>Nro de Empresa:</td>
				<td height="15" valign=middle>
				<input type="text" class="txt" disabled name="emp" size="10" value="<? 
				
				$nroEmpre = $row['EMPRESA'];
				
				$cuenta = strlen ( $nroEmpre );
				
				switch ($cuenta) {
					case 1:
						$muestra = '000'.$nroEmpre;
						break;
					case 2:
						$muestra = '00'.$nroEmpre;
						break;
					case 3:
						$muestra = '0'.$nroEmpre;
						break;
					case 4:
						$muestra = $nroEmpre;
						break;
				}
				
				print $muestra; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>CUIT EMPRESA</td>
			    <td height="15" valign=middle class="txt" onChange=informarcuit();>
 			   		<input type="text" disabled name="cuit_empre" size="40" maxlength="11" value="<? print $row['SUSS']; ?>" class=":integer :max_length;11"/>
 			   		<!-- <br><input type="checkbox" name="solo_empre" id="solo_empre" value="si" />
 			   		<sup>modificar CUIT solo para la empresa.</sup> -->
				</td> 
			</tr>

			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> Nombre: </td>
			   <td height="15" valign=middle><input type="text" disabled name="nombr" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" 
			   value="<? print $row['NOMBRE']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Nom. Fantasia:</td>
				<td height="15" valign=middle>
				<input type="text" disabled name="fantasii" size="11" maxlength="30" style="text-transform:uppercase;" value="<? print $row['FANTASI']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			   <td height="15" valign=middle class='txt'> CLAVE: </td>
			   <td height="15" valign=middle><input type="text" disabled name="clave" size="40" maxlength="50" class=":required" style="text-transform:uppercase;" 
			   value="<? print $row['CLAVE']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Domicilio: </td>
			    <td height="15" valign=middle><input disabled type="text" name="domici" size="40" style="text-transform:uppercase;" value="<? print $row['DOMICILIO']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Provincia:</td>
			   	<td height="15" valign=middle class="txt">
				<input type="text" disabled name="prov" size="40" style="text-transform:uppercase;" value="<? print $row['PROVINCIA']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Localidad:</td>
			   	<td height="15" valign=middle class="txt">
				<input type="text" disabled name="locali" size="40" style="text-transform:uppercase;" value="<? print $row['LOCALIDAD']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Cód. Postal:</td>
			    <td height="15" valign=middle><input type="text" disabled name="cp" size="11" value="<? print $row['CODPOST']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Tel. #1:</td>
			    <td height="15" valign=middle><input type="text" disabled name="tele1" size="40" value="<? print $row['Telefono1']; ?>" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Tel. #2:</td>
			    <td height="15" valign=middle><input type="text" disabled name="tele2" size="40" value="<? print $row['Telefono2']; ?>"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>E-mail:</td>
				<td height="15" valign=middle>
				<input type="email" disabled name="email" size="40" maxlength="30" value="<? print $row['E_MAIL']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Zona:</td>
				<td height="15" valign=middle>
				<input type="text" disabled name="zna" size="11" maxlength="2" value="<? print $row['ZONA']; ?>" /></td>
			</tr>			

			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Sub Zona:</td>
				<td height="15" valign=middle>
				<input type="text" disabled name="sz" size="11" maxlength="2" value="<? print $row['SZONA']; ?>" /></td>
			</tr>
						
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- -------------------- ESTUDIO CONTABLE --------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Estudio Contable:</i></td>
					<td height="15" valign=middle>
						<?
							$act = $row ['ESTCONTA'];
							$act = mysql_query ( "SELECT D_ESTUDIO from estconta WHERE C_ESTUDIO='$act'" );
							$row1 = mysql_fetch_assoc ( $act );
						?>
						<input type="hidden" name="bufferestudio" value="<? print $row['ESTCONTA']; ?>" />
						<textarea rows="2" cols="34" readonly="readonly" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="est_conta" style="text-transform: uppercase;"><? print $row['ESTCONTA'].' - '.$row1['D_ESTUDIO']; ?>
					</textarea>
				</td>
			</tr>
			<!-- recordar: name="agregarEstudioContable" -->
			<tr align="center">
				<td height="15" valign=middle class="txt2">Estudio Contable p/ modif.:</td>
				<td height="15" valign=middle onChange=agregarEstudio();><? mostrarEstudioContable(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			<!-- -----------------FECHA DE INGRESO-------------------- -->
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Fecha de Ingreso al sistema:</td>
				<td height="15" valign=middle>
				<? 
				$fecha1 = $row['FINGRESO'];
				$fecha2 = date("d-m-Y",strtotime($fecha1));
				?>
				<input type="hidden" name="fechaIngBuffer" value="<? print $fecha1; ?>" />
				<input type="text" disabled name="" size="11" maxlength="10" value="<? print $fecha2;/*$row['FINGRESO'];*/ ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt2'>Fecha de Ingreso al sistema p/ modif.:</td>
				<td height="15" valign=middle>
				<? diaIngs(); mesIngs(); anioIngs(); ?>
				</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
						
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Actividad principal:</td> 
				<td height="15" valign=middle>
			<? $act = $row['TIPACT'] ;$act=mysql_query("SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' ");
					$row1=mysql_fetch_assoc($act); ?>
					
					<input type="hidden" name="bufferactppal" value="<? print $row['TIPACT']; ?>"/>
								
					<textarea disabled rows="4" cols="34" readonly="readonly"  onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="tipoact1" style="text-transform:uppercase;">
					<? print $row['TIPACT'].' - '.$row1['DESCRIPCION']; ?>
					</textarea> 
				</td>
			</tr>
					
								<!-- recordar: name="desc_afip" -->
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt2'> Actividad principal p/ modif.:</td>
				<td height="15" valign=middle>
				<? tipoactividadafip(); ?>
			</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>												
			
			<!-- 			-------SUB actividad subactividad-------         -->
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> Actividad secundaria:</td>
				<td height="15" valign=middle>
			<? $act = $row['SUBACT'] ;$act=mysql_query("SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' ");
					$row1=mysql_fetch_assoc($act); ?>
					
					<input type="hidden" name="bufferactsec" value="<? print $row['SUBACT']; ?>"/>
								
					<textarea disabled rows="4" cols="34" readonly="readonly"  onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="tipoact2" style="text-transform:uppercase;">
					<? print $row['SUBACT'].' - '.$row1['DESCRIPCION'];?>
					</textarea>  
				</td>
			</tr>
					
								<!-- recordar: name="desc_sub_afip" -->
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt2'> Actividad secundaria p/ modif.:</td>
				<td height="15" valign=middle>
				<? tipoSubActividadAfip(); ?>
			</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- Tercera actividad --------------------- -->
			<tr align="center">
				<td height="15" valign=middle class="txt">3era Actividad:</td>
				<td height="15" valign=middle>
					<?
						$act = $row ['SUBACTII'];
						$act = mysql_query ( "SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' " );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					
					<input type="hidden" name="bufferactter" value="<? print $row['SUBACTII']; ?>" /> 
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" 
					readonly="readonly" name="" style="text-transform: uppercase;">
						<? print $row['SUBACTII'].' - '.$row1['DESCRIPCION']; ?>
					</textarea>
				</td>
			</tr>

			<!-- recordar: name="subII_act_afip" -->
			<tr align="center">
				<td height="15" valign=middle class="txt2">3era Actividad p/ modif.:</td>
				<td height="15" valign=middle><? tipoSubIIActividadAfip(); ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- Cuarta actividad --------------------- -->
			<tr align="center">
				<td height="15" valign=middle class="txt">4ta Actividad:</td>
				<td height="15" valign=middle>
					<?
						$act = $row ['SUBACTIII'];
						$act = mysql_query ( "SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' " );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					
					<input type="hidden" name="bufferactcuar" value="<? print $row['SUBACTIII']; ?>" /> 
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="" style="text-transform: uppercase;">
						<? print $row['SUBACTIII'].' - '.$row1['DESCRIPCION']; ?>
					</textarea>
				</td>
			</tr>

			<!-- recordar: name="subIII_act_afip" -->
			<tr align="center">
				<td height="15" valign=middle class="txt2">4ta Actividad p/ modif.:</td>
				<td height="15" valign=middle><? tipoSubIIIActividadAfip(); ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- Quinta actividad --------------------- -->
			<tr align="center">
				<td height="15" valign=middle class="txt">5ta Actividad:</td>
				<td height="15" valign=middle>
					<?
						$act = $row ['SUBACTIV'];
						$act = mysql_query ( "SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' " );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					
					<input type="hidden" name="bufferactquin" value="<? print $row['SUBACTIV']; ?>" /> 
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="" style="text-transform: uppercase;">
						<? print $row['SUBACTIV'].' - '.$row1['DESCRIPCION']; ?>
					</textarea>
				</td>
			</tr>

			<!-- recordar: name="subIV_act_afip" -->
			<tr align="center">
				<td height="15" valign=middle class="txt2">5ta Actividad p/ modif.:</td>
				<td height="15" valign=middle><? tipoSubIVActividadAfip(); ?></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			<!-- --------------------------------------------------------------	 -->
			<!-- -------------------- INICIO DE ACTIVIDADES --------------------- -->			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Inicio de Actividad:</td>
				<td height="15" valign=middle>
			<? 
				$fechaini= $row['FINIACT'];
			?>
				<input type="hidden" name="fIniActBuffer" value="<? print $fechaini; ?>" />
				<input type="text" disabled name="" size="11" maxlength="10" value="<?
				if($row['FINIACT']!="0000-00-00"){
					echo date('d-m-Y',strtotime($fechaini));
				}
				?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt2'>Fecha de Inicio de Act. p/ modif.:</td>
				<td height="15" valign=middle>
				<? diaInic(); mesInic(); anioInic(); ?>
					</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Cantidad de personal:</td>
				<td height="15" valign=middle>
				<input type="text" disabled name="cantprs" size="11" maxlength="4" value="<? print $row['CANTPERS']; ?>" /></td>
			</tr>
			<!-- --------------------------------------------------------------	 -->			
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'> ····················· DATOS SOBRE BAJA DE LA EMPRESA ····················· </td>
			</tr>
			
			<!-- modificando el codigo de baja-->
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'> C&oacute;digo de Baja actual: </td>
				<td height="15" valign=middle>
					<? $act = $row['CODBAJA'] ;$act=mysql_query("SELECT NOMBAJ from bajaempresa WHERE CODBAJA='$act' ");
					$row1=mysql_fetch_assoc($act); ?>
			<input type="text" name="bajaEbuffer" size="40" maxlength="40"  readonly="readonly" style="text-transform:uppercase;" value="<? print $row['CODBAJA'].' - '.$row1['NOMBAJ']; ?>"/></td>
			</tr>
			
			<tr ALIGN="left">
			    <td height="15" valign=middle class='txt2'> Código de Baja p/ modificar: </td> 
			    <td height="15" valign=middle class="txt">
				<? bajaE(); ?></td>
			<!-- recordar name="bajaE" -->
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- FECHA DE BAJA ----------------------- -->
			
			<tr ALIGN="center">
				<td height="15" valign=middle class='txt'>Fecha de Baja:</td>
				<td height="15" valign=middle>
				<? 
				$fechab= $row['FBAJA'];
				?>
				<input type="hidden" name="fechaBajaBuffer" value="<? print $fechab; ?>" />
				<input type="text" disabled name="" size="11" maxlength="10" value="<? 
				if($row['FBAJA']!="0000-00-00"){
					echo date('d-m-Y',strtotime($fechab));
				}
				?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt2'>Fecha de Baja p/ modif.:</td>
				<td height="15" valign=middle>
				<? diaBe(); mesBe(); anioBe(); ?>
					</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Observaciones por baja:</td>
				<td height="15" valign=middle>
				<textarea disabled rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="observb" style="text-transform:uppercase;">
					<? print $row['OBSERV_BAJA']; ?>
				</textarea> 			
			</tr>
		
			<!-- ------------------------------------------------------	 -->
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'> ····················· DATOS SOBRE LA OBRA SOCIAL ····················· </td>
			</tr>
						
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Personal en OS:</td>
				<td height="15" valign=middle>
				<input type="text" disabled name="canmpos" size="11" maxlength="4" value="<? print $row['CANEMPOS']; ?>" /></td>
			</tr>
			
			<!-- ----------------- ÚLTIMO PAGO OBRA SOCIAL -------------------- -->
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Ult. Período Obra Social:</td>
				<td height="15" valign=middle>
				<? 
				$fecha1 = $row['ULTPEROS'];
				?>
				<input type="hidden" name="fechaUPOSBuffer" value="<? print $fecha1; ?>" />
				<input type="text" disabled name="" size="11" maxlength="10" value="<? 
				if($row['ULTPEROS']!="0000-00-00"){
					echo date('d-m-Y',strtotime($fecha1)); } ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt2'>Ult. Período Obra Social p/ modif.:</td>
				<td height="15" valign=middle>
				<? diapos(); mespos(); aniopos(); ?>
				</td>
			</tr>
			<!-- ------------------------------------------------------	 -->
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'> ····················· DATOS SOBRE EL SINDICATO ····················· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Personal en SINDICATO:</td>
				<td height="15" valign=middle>
				<input type="text" disabled name="cemps" size="11" maxlength="4" value="<? print $row['CANEMPSI']; ?>" /></td>
			</tr>
			
			<!-- ----------------- ÚLTIMO PERIODO SINDICALL -------------------- -->
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Ult. Período Sindical:</td>
				<td height="15" valign=middle>
				<? 
				$fecha1 = $row['ULTPERSI'];
				?>
				<input type="hidden" name="fechaUPESBuffer" value="<? print $fecha1; ?>" />
				<input type="text" disabled name="" size="11" maxlength="10" value="<?
				if($row['ULTPERSI']!="0000-00-00"){
					echo date('d-m-Y',strtotime($fecha1)); }
				?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt2'>Ult. Periodo Sindical p/ modif.:</td>
				<td height="15" valign=middle>
				<? diapes(); mespes(); aniopes(); ?>
				</td>
			</tr>
						
			<!-- ------------------------------------------------------	 -->
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2"  class='txt'> ····················· DATOS SOBRE AMUTCAER ····················· </td>
			</tr>
			<!-- ----------------- ÚLTIMO Periodo MUTUAL AMUTCAER  -------------------- -->
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Ult. Período Mutual (AMUTCAER):</td>
				<td height="15" valign=middle>
				<? 
				$fecha1 = $row['ULTPERMUT'];
				?>
				<input type="hidden" name="fechaUPMBuffer" value="<? print $fecha1; ?>" />
				<input type="text" disabled name="" size="11" maxlength="10" value="<? 
					if($row['ULTPERMUT']!="0000-00-00"){
					echo date('d-m-Y',strtotime($fecha1)); }
				?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt2'>Ult. Período Mutual (AMUTCAER) p/ modif.:</td>
				<td height="15" valign=middle>
				<? diapm(); mespm(); aniopm(); ?>
				</td>
			</tr>
			<!-- ------------------------------------------------------	 -->	
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2" class='txt'> ····················· OTROS DATOS ····················· </td>
			<!-- ----------------- FECHA DE MODIFICACIÓN ----------------------- -->
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Observaciones:</td>
				<td height="15" valign=middle>
				<textarea disabled rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obser" style="text-transform:uppercase;">
					<? print $row['OBSERV']; ?>
				</textarea> 			
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class='txt'>Observaciones de Fiscalización/Cobranzas:</td>
				<td height="15" valign=middle>
				<textarea disabled rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obserfc" style="text-transform:uppercase;">
					<? print $row['OBSERVFC']; ?>
				</textarea> 			
			</tr>
			<!-- --------------------------------------------------------------	 -->
			
			   
 			
								
</table>

<table>
		<tr ALIGN="center">
				 <td height="15" valign=middle colspan="2"><br>···················································································· </td>
		</tr>
		<tr ALIGN="center">
				<td height="15" valign=middle class="txt2">Último usuario en modificar:<? print "  ".$row["USUARIO"]; ?>
				</td>
		</tr>
		
		<tr align="center">
				<td height="15" valign=middle class="txt2">Última modificación:<? $date = new DateTime($row['FECHMODIF']);
																				  echo $date->format('d-m-Y H:i:s'); ?></td>
		</tr>
		
		<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
		</tr>
</table>	

</div> <!-- CajaEmpre -->

<table>
	<tr align="center">
			    <td height="15" align="center" valign="middle"> 
				<input type="submit" name ="graba" value="Grabar" class='grabar' size="10" style="visibility: hidden"/>
				
			    </td>
	</tr>
</table>

</form>
<table>
		<tr>

			<td width="" height="23" align="center" valign="middle">
				<button onclick="window.location.href='menu.php'"  class='inicio'>Menú inicio</button>
			</td>

			<td width="" height="23" align="center" valign="middle">
				<form action="empresaBUSCAR.php" method="POST">
				<input type="submit" name ="busca_empre" value="Editar otro" class='salir' size="10"/>
				</form>
			</td>
		</tr>
</table>

<div id="cajapie">

</div>

</div> <!-- CajaPrincipal-->

</div><!-- contenedor -->

<?
}else //Si no encontro la empresa ...
	{
	$alerta=407; //empresa no encontrada
	header("Location: menu.php?alerta=$alerta");	
	}

 include("includes/footer.php");
}
?>