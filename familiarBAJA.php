<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION["user"];
$dni_flia = $_POST["dni_fliar"];

$sqlBusca="select FNDOC from famiba where FNDOC='$dni_flia'";
$resultBusca=mysql_query($sqlBusca, $link);

if (mysql_num_rows($resultBusca)==1){
	$pcias=mysql_query("select * from famiba where FNDOC='$dni_flia'");	
	$row=mysql_fetch_assoc($pcias);
	
	$a=$row['BAJASI'];
	if ( $a == '*' ){
	$alerta='famiBaja';
	header("Location: menu.php?alerta=$alerta");
	}// Fin if buscar '*'
?>


<?include("includes/header.php");?>
		
	<script type="text/javascript" src="jquery-1.5.1.min.js"></script>

	

<script type="text/javascript">
    function showContent_a() {
        element = document.getElementById("content_fsindi");
        check = document.getElementById("checksindi");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }

    function showContent_b() {
        element = document.getElementById("content_fos");
        check = document.getElementById("checkob");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }

     function showContent_c() {
        element = document.getElementById("content_fmutual");
        check = document.getElementById("checkmutual");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }

    function showContent_d() {
        element = document.getElementById("content_ftodo");
        check = document.getElementById("checktodo");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>

    <div id="contenedor">
    <div id="cajachicasup"></div>
    
    <div id="cajappal" class='centraTabla'>
    
    <h1 align="center" class="emple">
		Panel de BAJA de FAMILIAR || Usuario: <b><? echo $user; ?></b>
	</h1>
	
	<!-- baja_fami.php -->
	<form action="baja_fami.php" name="formulario" id="formulario" method="POST">

	<input type="hidden" name="hfletf" value="<? print $row['FLETF']; ?>"/>
<input type="hidden" name="hfdele" value="<? print $row['FDELE']; ?>"/>
<input type="hidden" name="hfempr" value="<? print $row['FEMPR']; ?>"/>
<input type="hidden" name="hzona" value="<? print $row['FZONA']; ?>"/>
<input type="hidden" name="hnafi" value="<? print $row['FNAFI']; ?>"/>
<input type="hidden" name="hclaveempresa" value="<? print $row['ClaveEmpresa']; ?>"/>
<input type="hidden" name="hcuiltitu" value="<? print $row['CUILTITU']; ?>"/>
<input type="hidden" name="hcuitempresa" value="<? print $row['CUITEmpresa']; ?>"/>
<input type="hidden" name="hunificamutual" value="<? print $row['UnificaMutual']; ?>"/>
<input type="hidden" name="hforde" value="<? print $row['FORDE']; ?>"/>
<input type="hidden" name="hapelfami" value="<? print $row['APELFAMI']; ?>"/>
<input type="hidden" name="hftdoc" value="<? print $row['FTDOC']; ?>"/>
<input type="hidden" name="hsexo" value="<? print $row['FSEXO']; ?>"/>
<input type="hidden" name="hfechaingos" value="<? print $row['FechaIngOS']; ?>"/>
<input type="hidden" name="hfechabajasi" value="<? print $row['FechaBajaSI']; ?>"/>
<input type="hidden" name="hfpare" value="<? print $row['FPARE']; ?>"/>
<input type="hidden" name="hfvenc" value="<? print $row['FVENC']; ?>"/>
<input type="hidden" name="hnivelest" value="<? print $row['NIVELEST']; ?>"/>
<input type="hidden" name="haniolectivo" value="<? print $row['AñoLectivo']; ?>"/>
<input type="hidden" name="hvenfamcargo" value="<? print $row['VenFamCargo']; ?>"/>
<input type="hidden" name="hvencertdesemp" value="<? print $row['VenCertDesemp']; ?>"/>
<input type="hidden" name="hfcbaj" value="<? print $row['FCBAJ']; ?>"/>
<input type="hidden" name="hbajasi" value="<? print $row['BAJASI']; ?>"/>
<input type="hidden" name="hfzafi" value="<? print $row['FZAFI']; ?>"/>
<input type="hidden" name="hffnac" value="<? print $row['FFNAC']; ?>"/>
<input type="hidden" name="hfndoc" value="<? print $row['FNDOC']; ?>"/>
<input type="hidden" name="hfmcre" value="<? print $row['FMCRE']; ?>"/>
<input type="hidden" name="hfmcon" value="<? print $row['FMCON']; ?>"/>
<input type="hidden" name="hfmpra" value="<? print $row['FMPRA']; ?>"/>
<input type="hidden" name="hcargado" value="<? print $row['CARGADO']; ?>"/>
<input type="hidden" name="hretafi" value="<? print $row['RETAFI']; ?>"/>
<input type="hidden" name="hretdel" value="<? print $row['RETDEL']; ?>"/>
<input type="hidden" name="hsecdel" value="<? print $row['SECDEL']; ?>"/>
<input type="hidden" name="hftdis" value="<? print $row['FTDIS']; ?>"/>
<input type="hidden" name="hftpat" value="<? print $row['FTPAT']; ?>"/>
<input type="hidden" name="hffvenpat" value="<? print $row['FFVENPAT']; ?>"/>
<input type="hidden" name="hf_pmivto" value="<? print $row['F_PMIVTO']; ?>"/>
<input type="hidden" name="hffentcre" value="<? print $row['FFENTCRE']; ?>"/>
<input type="hidden" name="hfapno" value="<? print $row['FAPNO']; ?>"/>
<input type="hidden" name="husuario" value="<? print $row['USUARIO']; ?>"/>
<input type="hidden" name="hhapadjobso" value="<? print $row['HaPaDjObSo']; ?>"/>
<input type="hidden" name="hmotivohab" value="<? print $row['MotivoHab']; ?>"/>
<input type="hidden" name="hinhrefvenobsoc" value="<? print $row['InhRefVenObSoc']; ?>"/>
<input type="hidden" name="hultpagmutual" value="<? print $row['UltPagMutual']; ?>"/>
<input type="hidden" name="hips" value="<? print $row['IPS']; ?>"/>
<input type="hidden" name="hmotivomodifica" value="<? print $row['MotivoModifica']; ?>"/>
<input type="hidden" name="hfmutual" value="<? print $row['FMUTUAL']; ?>"/>
<input type="hidden" name="hestciv" value="<? print $row['EstCiv']; ?>"/>
<input type="hidden" name="hnacional" value="<? print $row['NACIONALIDAD']; ?>"/>
<input type="hidden" name="hcuilfami" value="<? print $row['CUILFAMI']; ?>"/>
<input type="hidden" name="hnomfami" value="<? print $row['NOMFAMI']; ?>"/>

	<div id="CajaNotificacion"><div class="txt">CUIL y FAMILIAR PARA DAR DE BAJA:<strong> 
	<? print utf8_decode($dni_flia); print utf8_decode(" || ".$row["APELFAMI"]." ".$row["NOMFAMI"]); 
	   print "<br>AMUTCAER: ";  if(($row['TMUT']) == "*"){ print "NO"." || "; } else { print "SI || "; };
   	   print " Obra Social: "; if(($row['TOSOC']) == "*"){ print "NO"." || "; } else { print "SI || "; };
       print " Sindicato: "; if(($row['TSINDI']) == "*"){ print "NO"; } else { print "SI"; }
	?>
	</strong></div>	
	</div>
	
		<div id="CajaFami">
		
		
		<table>
		
		<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA"> Datos del Familiar a dar de baja </td>
		</tr>
		
		<tr ALIGN="left">
			<td height="15" valign=middle class="txt">CUIT del Titular:</td>
   			<td height="15" valign=middle ><input type="text" name="cuitE" size="30" maxlength="11" readonly="readonly"
   				style="text-transform: uppercase;" value="<?php print $row['CUILTITU'];?>" /></td>			    
		</tr>
		
		<tr ALIGN="left">
			<td height="15" valign=middle class="txt">DNI:</td>
   			<td height="15" valign=middle ><input type="text" name="dniE" size="30" maxlength="11" readonly="readonly"
   			style="text-transform: uppercase;" value="<?php print $row['FNDOC'];?>" /></td>			    
		</tr>
		
		<tr ALIGN="left">
		    <td height="15" valign=middle class="txt"></td>
			<td height="15" valign=middle><input type="checkbox" name="todo" id="checktodo" value="todo" onchange="javascript:showContent_d()" /> <b><i>Dar de baja a todo?</i></b> <br/>
			<div id="content_ftodo" style="display: none;">
   						<p>Fecha Baja: <input type="date" name="fechatodo"/></p>
 			</div>
		</tr>

		<tr ALIGN="left">
			<td height="15" valign=middle class="txt"></td>
   			<td height="15" valign=middle ></td>			    
		</tr>

		<tr ALIGN="left">
		<td height="15" valign=middle class="txt"></td>
		<td height="15" valign=middle>
		<fieldset>
                <legend>Bajas parciales</legend>
                        
                       	<input type="checkbox" name="sindi" id="checksindi" value="sindi" onchange="javascript:showContent_a()" />Sindicato <br/>
						<div id="content_fsindi" style="display: none;">
   						<p>Fecha Baja: <input type="date" name="fechasin"/></p>
 						</div>

 						<input type="checkbox" name="os"  id="checkob" value="os" onchange="javascript:showContent_b()" />Obra Social <br/>
 						<div id="content_fos" style="display: none;">
   						<p>Fecha Baja: <input type="date" name="fechaos"/></p>
 						</div>

                        <input type="checkbox" name="mutual"  id="checkmutual" value="mutual" onchange="javascript:showContent_c()" />AMUTCAER <br/>
                        <div id="content_fmutual" style="display: none;">
   						<p>Fecha Baja: <input type="date" name="fechamutual"/></p>
 						</div>
        </fieldset>
        </td>
        </tr>
</table>
	</div> <!-- CajaFami -->

	<table>
	<tr ALIGN="center">
	    <td height="15" valign=middle> 
			<input type="submit" name ="graba" class="grabar" value="Dar de baja" size="10"/>
	    </td>
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
	</div> <!-- cajappal --> 
    </div> <!-- contenedor -->

    </body>
</html>
<?php 
}else
{
	$alerta=416; //FAMILIAR NO ENCONTRADO;
	header("Location: menu.php?alerta=$alerta");	
}
}

include("includes/footer.php");
?>