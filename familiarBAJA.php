<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{

$user = $_SESSION["user"];
$dni_flia = $_POST["dni_fliar"];

$sqlBusca = "select FNDOC from famiba where FNDOC='$dni_flia'";
$resultBusca = mysql_query( $sqlBusca, $link );

if ( mysql_num_rows($resultBusca) == 1 ) {
	$pcias=mysql_query("select * from famiba where FNDOC='$dni_flia'");	
	$row=mysql_fetch_assoc($pcias);
	
	$a = $row['TSINDI'];
	$b = $row['TOSOC'];
	$c = $row['TMUT'];

	if ( ( $a == '*' ) && ( $b == '*' ) && ( $c == '*') ){
		$alerta='famiBaja';
		header("Location: menu.php?alerta=$alerta");
		}
	} else {
		$alerta=416; //FAMILIAR NO ENCONTRADO;
			header("Location: menu.php?alerta=$alerta");	
		   }
?>


<?include("includes/header.php");?>
		
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>

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
<input type="hidden" name="haniolectivo" value="<? print $row['AnioLectivo']; ?>"/>
<input type="hidden" name="hvenfamcargo" value="<? print $row['VenFamCargo']; ?>"/>
<input type="hidden" name="hvencertdesemp" value="<? print $row['VenCertDesemp']; ?>"/>
<input type="hidden" name="hfcbaj" value="<? print $row['FCBAJ']; ?>"/>
<input type="hidden" name="htsindi" value="<? print $row['TSINDI']; ?>"/>
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

<input type="hidden" name="hfechabajaos" value="<? print $row['FechaBajaOS']; ?>"/>
<input type="hidden" name="hfechabajamu" value="<? print $row['FechaBajaMU']; ?>"/>
<input type="hidden" name="htosoc" value="<? print $row['TOSOC']; ?>"/>
<input type="hidden" name="htmut" value="<? print $row['TMUT']; ?>"/>
<input type="hidden" name="hfechaingsi" value="<? print $row['FechaIngSI']; ?>"/>
<input type="hidden" name="hfechaingmu" value="<? print $row['FechaIngMU']; ?>"/>
<input type="hidden" name="hf_estadoini" value="<? print $row['F_ESTADOINI']; ?>"/>
<input type="hidden" name="hf_estadovto" value="<? print $row['F_ESTADOVTO']; ?>"/>
<input type="hidden" name="hdescest" value="<? print $row['DESCEST']; ?>"/>
<input type="hidden" name="hf_discini" value="<? print $row['F_DISCINI']; ?>"/>
<input type="hidden" name="hdisc" value="<? print $row['DISC']; ?>"/>
<input type="hidden" name="hf_discvto" value="<? print $row['F_DISCVTO']; ?>"/>
<input type="hidden" name="hdescdisc" value="<? print $row['DESCDISC']; ?>"/>
<input type="hidden" name="hdocpend" value="<? print $row['DOCPEND']; ?>"/>
<input type="hidden" name="hotrodomi" value="<? print $row['OTRODOMI']; ?>"/>
<input type="hidden" name="hpcifami" value="<? print $row['PCIFAMI']; ?>"/>
<input type="hidden" name="hdtofami" value="<? print $row['DPTOFAMI']; ?>"/>
<input type="hidden" name="hlocalfami" value="<? print $row['LOCALFAMI']; ?>"/>
<input type="hidden" name="hdomifami" value="<? print $row['DOMIFAMI']; ?>"/>
<input type="hidden" name="hpmi" value="<? print $row['PMI']; ?>"/>

	<div id="CajaNotificacion"><div class="txt">CUIL y FAMILIAR PARA DAR DE BAJA:<strong> 
	<? print utf8_decode($dni_flia); print utf8_decode(" || ".$row["APELFAMI"]." ".$row["NOMFAMI"]."<br>"); 
	   print "AMUTCAER: ";  if(($row['TMUT']) == "*"){ print "NO"." || "; } else { print $row['TMUT']." || "; };
   	   print " Obra Social: "; if(($row['TOSOC']) == "*"){ print "NO"." || "; } else { print $row['TOSOC']." || "; };
       print " Sindicato: "; if(($row['TSINDI']) == "*"){ print "NO"; } else { print $row['TSINDI']; }
	?>
	</strong><br><br><span style="color:#B4045F"><i>Ayuda: Anteriormente al estar dado de baja en el SINDICATO estaba dado de baja en TODO.<br>
	<?php if ( $row['SICER'] == 'SI' ){ echo "La &uacuteltima actualizaci&oacuten fue en SICER"; } else { echo "La &uacuteltima actualizaci&oacuten fue en SINDI"; } ?>
	</i></span></div>	
	</div>

	<div id="CajaNotificacion_2"><div class="txt">TITULAR DEL FAMILIAR:<strong> 
	<? print "<br>CUIL: ".$row['CUILTITU'];

	/* BUSQUEDA DEL TITULAR DEL FAMILIAR */
	$cuit_titu = $row['CUILTITU'];
	$sqlT = " select TAPEL, TNOMB, TMUT, TOSOC, TSINDI, TNSIN, TFBAJ from titulares where CUIL='$cuit_titu' ";
	 $resT = mysql_query( $sqlT, $link );
		
		if( mysql_num_rows( $resT ) == 1){
			$rowTitu = mysql_fetch_assoc ( $resT );
			echo "<br>".$rowTitu['TAPEL']." ".$rowTitu['TNOMB'];

			 print "<br>AMUTCAER: ";  print $rowTitu['TMUT']." || ";
   	   		 print " Obra Social: "; print $rowTitu['TOSOC']." || ";
       		 print " Sindicato: "; print $rowTitu['TSINDI'];
		} else { 
					$alerta = "tituenfamibaja";
					header("Location: menu.php?alerta=$alerta");
				}
	?>
	</strong>
	<br><br><span style="color:#B4045F"><i><?php print "Datos a observar para saber el estado sindical:<br>Fecha de Baja: ".$rowTitu['TFBAJS']." || Nro Sindical: ".$rowTitu['TNSIN']; ?></i></span>
	</div>	
	</div>
	
		<div id="CajaFami">
				
		<table>
		
		<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA">.:: Opciones de baja de familiar ::.</td>
		</tr>
		
		<input type="hidden" name="cuitE" style="text-transform: uppercase;" value="<?php print $row['CUILTITU'];?>" />
		<input type="hidden" name="dniE" style="text-transform: uppercase;" value="<?php print $row['FNDOC'];?>" />
		
		<tr ALIGN="left">
		    <td height="15" valign=middle class="txt"></td>
			<td height="15" valign=middle><input type="checkbox" name="todo" id="checktodo" value="todo" onchange="javascript:showContent_d()" /> <b><i>Dar de baja a todo?</i></b><br/>
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

}

include("includes/footer.php");
?>