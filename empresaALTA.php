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
include ("fciondiamesanioIni_Sis.php");
include ("fcionactividadafip.php");
include ("fcionSubactividadafip.php");
include ("fcionbajaEmpre.php");
include ("fcion_dptos_er.php");
include ("fcionEstudioContable.php");
include("includes/header_m.php");

$user = $_SESSION["user"];
$cuit_emp = $_POST["cuit_empre"];

$sqlBusca = "select SUSS from empresas where SUSS = '$cuit_emp'";
$resultBusca = mysql_query($sqlBusca);

if (mysql_num_rows($resultBusca)==1){	
	$alerta='empreExiste';
	header("Location: menu.php?alerta=$alerta&cuit_emp=$cuit_emp");
}

?>


<script type="text/javascript" src="cargarDptos.js"></script>
<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>

<script type="text/javascript">

	var IE = navigator.appName.toLowerCase().indexOf("microsoft") > -1;
	var Mozilla = navigator.appName.toLowerCase().indexOf("netscape") > -1;

	var textoAnt = "";
	var posicionListaFilling = 0;

	var datos = new Array();
	

	function ajaxobj() {
		try {
			_ajaxobj = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				_ajaxobj = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				_ajaxobj = false;
			}
		}
	   
		if (!_ajaxobj && typeof XMLHttpRequest!='undefined') {
			_ajaxobj = new XMLHttpRequest();
		}
		
		return _ajaxobj;
	}
	
	function cargaLista(evt, obj, txt) {
		ajax = ajaxobj();
		ajax.open("GET", "listaAfip.php?texto="+txt, true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				var datos = ajax.responseXML;
				var listaAfip = datos.getElementsByTagName("actividad");
				
				var listalistaAfip = new Array();
				if (listaAfip) {
					for (var i=0; i<listaAfip.length; i++) {
						listalistaAfip[listalistaAfip.length] = listaAfip[i].firstChild.data;
					}
				}
				escribeLista(obj, listalistaAfip);
			}
		}
		ajax.send(null);
	}
	
	function escribeLista(obj, lista) {
		var html = "";
		var fill = document.getElementById('lista');
		
		if (lista.length == 0) {
			// Si la lista es vacia no la mostramos
			fill.style.display = "none";
		} else {
			// Creamos una tabla con 
			// todos los elementos encontrados
			fill.style.display = "block";
			var html='<table cellspacing="0" '+
				'cellpadding="0" border="0" width="100%">';
			for (var i=0; i<lista.length; i++) {
				html += '<tr id="tr'+obj.id+i+
					'" '+(posicionListaFilling == i? 
						' class="fill" ': '')+
					' onmouseover="seleccionaFilling(\'tr'+
					obj.id+'\', '+i+
					')" onmousedown="seleccionaTextoFilling(\'tr'+
					obj.id+'\', '+i+')">';
				html += '<td>'+lista[i]+'</td></tr>';
			}
			html += '</table>';
		}

		// Escribimos la lista
		fill.innerHTML = html;
	}

	// Muestra las coincidencias en la lista
	function inputFilling(evt, obj) {
		var fill = document.getElementById('lista');

		var elems = datos;
		
		var tecla = "";
		var lista = new Array();
		var res = obj.value;
		var borrar = false;
		
		// Almaceno la tecla pulsada
		if (!IE) {
		  tecla = evt.which;
		} else {
		  tecla = evt.keyCode;
		}
		
		var texto;
		// Si la tecla que pulso es una
		// letra o un espacio, o el intro
		// o la tecla borrar, almaceno lo 
		// que debo buscar
		if (!String.fromCharCode(tecla).match(/(\w|\s)/) && 
				tecla != 8 && 
				tecla != 13) {
			texto = textoAnt;
		} else {
			texto = obj.value;
		}
		
		textoAnt = texto;
		
		// Si el texto es distinto de vacio
		// o se pulsa ARRIBA o ABAJO
		// hago llamada AJAX para que 
		// me devuelva la lista de palabras
		// que coinciden con lo que hay
		// escrito en la caja
		if ((texto != null && texto != "") 
			|| (tecla == 40 || tecla == 38)) {
			cargaLista(evt, obj, texto);
		}
		
		
		// Según la letra que se pulse
		if (tecla == 37) { // Izquierda
			// No hago nada
		} else if (tecla == 38) { // Arriba
			// Subo la posicion en la
			// lista desplegable una posición
			if (posicionListaFilling > 0) {
				posicionListaFilling--;
			}
			// Corrijo la posición del scroll
			fill.scrollTop = posicionListaFilling*14;
		} else if (tecla == 39) { // Derecha
			// No hago nada
		} else if (tecla == 40) { // Abajo
			if (obj.value != "") {
				// Si no es la última palabra
				// de la lista
				if (posicionListaFilling < lista.length-1) { 
					// Corrijo el scroll
					fill.scrollTop = posicionListaFilling*14;
					// Bajo la posición de la lista
					posicionListaFilling++;
				} 
			}
		} else if (tecla == 8) { // Borrar <-
			// Se sube la lista del todo
			posicionListaFilling = 0;
			// Se permite borrar
			borrar = true;
		} else if (tecla == 13) { // Intro
			// Deseleccionamos el texto
			if (obj.createTextRange) {
				var r = obj.createTextRange();
				r.moveStart("character", 
					obj.value.length+1);
				r.moveEnd("character", 
					obj.value.length+1);
				r.select();
			} else if (obj.setSelectionRange) {
				obj.setSelectionRange(
					obj.value.length+1, 
					obj.value.length+1);
			}
			// Ocultamos la lista
			fill.style.display = "none";
			// Ponemos el puntero de 
			// la lista arriba del todo
			posicionListaFilling = 0;
			// Controlamos el scroll
			fill.scrollTop = 0;
			return true;
		} else {
			// En otro caso que siga
			// escribiendo
			posicionListaFilling = 0;
			fill.scrollTop = 0;
		}	
		
		// Si no se ha borrado
		if (!borrar) {
			if (lista.length != 0) {
				// Seleccionamos la parte del texto
				// que corresponde a lo que aparece
				// en la primera posición de la lista
				// menos el texto que realmente hemos
				// escrito
				obj.value = lista[posicionListaFilling];
				if (obj.createTextRange) {
					var r = obj.createTextRange();
					r.moveStart("character", 
						texto.length);
					r.moveEnd("character", 
						lista[posicionListaFilling].length);
					r.select();
				} else if (obj.setSelectionRange) {
					obj.setSelectionRange(
						texto.length, 
						lista[posicionListaFilling].length);
				}
			}
		}
		return true;
	}
  
  
	// Introduce el texto seleccionado
	function setInput(obj, fill) {
		obj.value = textoAnt;
		fill.style.display = "none";
		posicionListaFilling = 0;
	}

  
	// Cambia el estilo de
	// la palabra seleccionada
	// de la lista
	function seleccionaFilling(id, n) {
		document.getElementById(id + 
			n).className = "fill";
		document.getElementById(id + 
			posicionListaFilling).className = "";  	
		posicionListaFilling = n;
	}
  
	// Pasa el texto del filling a la caja
	function seleccionaTextoFilling (id, n) {
		textoAnt = document.getElementById(id + 
			n).firstChild.innerHTML;
		posicionListaFilling = 0;
	}
  	
 
	// Cambia la imagen cuando se pone 
	// encima el raton (nombre.ext 
	// por _nombre.ext)
	function cambiarImagen(obj, ok) {
		var marcada = obj.src.indexOf("/_") > 0;
		
		if (ok) {
			if (!marcada) {
			  var ruta = obj.src.substring(
				0, 
				obj.src.lastIndexOf("/")+1)+
				"_"+obj.src.substring(
					obj.src.lastIndexOf("/")+1);
			  obj.src = ruta;
			}
		} else {
			if (marcada) {
				var ruta = ""+obj.src.substring(
					0, obj.src.lastIndexOf("_"))+
					obj.src.substring(
						obj.src.lastIndexOf("/")+2);
				obj.src = ruta;
			}
		}
	
	}
  

</script>
<!-- ---------------------------------TERMINA PRUEBA IV---------------------------- -->

<script>
function esconde(form)
{
if ((form.cuitempre.value != "") && (form.nomempre.value != "") && (form.domicilio.value != "") && (form.tel1.value != ""))
{ form.graba.style.visibility = "visible"; document.getElementById("Caja_graba").style.display = 'block'; } else { form.graba.style.visibility = "hidden"; }
}

function muestra_dpto(form)
{
if (form.pcia.value == "ENTRE RIOS") { document.getElementById("Cajadptoer").style.display = 'block'; }
					 else { document.getElementById("Cajadptoer").style.display = 'none'; }
}

function checklistas(){
	var tipo1 = document.formulario.desc_afip.value;
	var tipo2 = document.formulario.desc_sub_afip.value;
	
	if (tipo1 == tipo2){
		var tipo2 = document.formulario.desc_sub_afip.value="";
		alert("ATENCI\u00d3N: Las actividades deben ser diferentes!");
		/*formulario.desc_afip.disabled='true'*/;
		}
	}

function checkfechasIngSis(){//Chequea que la fecha de ingreso al sistema no sea menor al de la actividad.
	var dia = document.formulario.diaIni.value; //Inicio de Actividades
	var mia = document.formulario.mesIni.value;
	var aia = document.formulario.anioIni.value;
		
	var dis = document.formulario.diaIng.value;//ingreso al sistema
	var mis = document.formulario.mesIng.value;
	var ais = document.formulario.anioIng.value;
	
	if (aia > ais){
		alert("ATENCI\u00d3N: El a\u00f1o de ingreso al sistema debe ser mayor al de inicio de actividades.");
	}else if (aia == ais){
		if (mia > mis ){alert("ATENCI\u00d3N: El mes de ingreso al sistema debe ser mayor al de inicio de actividades");
		}else if (dia == dis){
			if (dia <= dis){alert("ATENCI\u00d3N: El d\u00eda de ingreso al sistema debe ser mayor al de inicio de actividades");
			}
		}
	}
}//fin function checkfechasIngSis

function checkcuitl(){
	var nCuix = document.formulario.cuitempre.value;// numero de cuil ingresado
	tamanio = nCuix.length;//tiene el tam del cuil tamanio=11
	nVerif = '5432765432';
	
	if (tamanio == 11)
	{
		aMult = nVerif.split('');//Separa el numero para validar 5,4,3,2,7,6,5,4,3,2
		aCUIx = nCuix.split(''); //Separa el cuil en 2,0,3,2,1,9,2,3,6,7,5
	
		var iResult = 0;
		for(i = 0; i < 10; i++)
		{
		iResult += aCUIx[i] * aMult[i];
		}
		iResult = (iResult % 11); //suma 124 y el modulo es 3
		iResult = 11 - iResult;
	
		if (iResult == 11) iResult = 0;
		if (iResult == 10) iResult = 9;

		if (iResult == aCUIx[10])
		{
		//alert ('CUIT ' + nCuix + ' VÁLIDO');
		return true;
		}
		else
		alert ('CUIT ' + nCuix + ' inválido');
		document.getElementById("idcuitempre").focus();
	}
	else alert ('CUIT ' + nCuix + ' inválido');
	document.getElementById("idcuitempre").focus();
	return false;
}
		
function agregarEstudio()
{
	var cont = document.formulario.agregarEstudioContable.value;
	
	if (cont == "1"){
		var lugar='alta'; var cuitmos="<? print $_POST['cuit_empre']; ?>";
		window.location = "estudiocontableALTA.php?lugar=" + lugar + "&cuit_empre="+cuitmos;
	} else {
		formulario.cuitempre.disabled=false;
		formulario.nomempre.disabled=false;	
			}
}

function ControlarEstudio()
{
	var cont = document.formulario.agregarEstudioContable.value;
	
	if (cont == "2"){
		
		//alert("ATENCION: Debe seleccionar un estudio contable!"); 
		formulario.cuitempre.disabled="true";
		formulario.nomempre.disabled="true";	
	}
}

function maximo(campo,limite)
{
	if(campo.value.length>=limite){
		campo.value=campo.value.substring(0,limite);
	}
}	
</script>

<script type="text/javascript">

function mas_activ(form)
{
if(document.getElementById('mas_act').checked) { document.getElementById("Caja_mas_act").style.display = 'block'; } else {
						   document.getElementById("Caja_mas_act").style.display = 'none'; }

}

</script>

<!-- body onload="ControlarEstudio()" -->

<div id="contenedor" class="centraTabla">

<div id="cajachicasup"></div>
<div id="cajappal">
<div id="txt1">
(<span class="req">*</span>)  TODOS los campos que son OBLIGATORIOS deben estar completos para que se guarden.</div>
<h1 align="center">
Panel de ALTA de EMPRESAS || Usuario: <b><? echo $user; ?></b>
</h1>

<? if ($_GET["falto"]=="falta") { ?>
				<span style="letter-spacing:7px; color: #ffff99; background-color:red"><b> ::: Complete TODOS los Campos Obligatorios ::: </b></span>
			<? } ?>	

<form action="graba_empre.php" name="formulario" id="formulario" method="POST"> 
<!-- "graba_empre.php" -->
<div id="CajaEmpre" >

<table>

			<tr ALIGN="center">
			<td colspan= "2" height="20" valign=middle bgcolor="#EFEEDA"> Complete los Datos de la Empresa</td>
			</tr>
						
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Estudio contable:</td>
				<td height="15" valign=middle onChange=agregarEstudio();>
				<? mostrarEstudioContable();?>
				<HR width=50% align="center">			
			</td>
			</tr>
						
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> CUIT:</td>
		 		    <td height="15" valign=middle class="txt" >
					<input type="text" name="cuitempre" id="idcuitempre" size="40" maxlength="11" onchange=checkcuitl();
					 value="<? import_request_variables("pg","f_"); echo $f_cuit_empre?>" 
					 class=":integer :required"  onFocus="if (this.value=='SIN guiones') this.value='';"/></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Nombre de la empresa:</td>
			
			   <td height="15" valign=middle><input type="text" name="nomempre" style="text-transform:uppercase;" size="40" maxlength="50" class=":required" /></td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Provincia: </td>

			   <td height="15" valign=middle class="txt">
				<? $pcias=mysql_query("SELECT * from zona ORDER BY NOMZON ASC"); ?>
				<select name="pcia" id="pcia"  onchange="cargarDptos(); muestra_dpto(this.form);">
                                 	<option value="null">Selecciona una Provincia!</option>
           	 				<? while($row=mysql_fetch_assoc($pcias)){
					print '<option value="'.strtolower($row['NOMZON']).'" >'.$row['NOMZON']." - ".$row['ZONA'].'</option>';
											}?>
				</select><? print $row['NOMZON']; ?>
			</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Localidad / C.P.</td>

			   	<td height="15" valign=middle class="txt">
					<select name="departamento" id="departamento">
                                		<option value="null">Selecciona una localidad</option>
                    </select>
				<a href="agregar_localidad.php" title="Agregar una localidad">+Agregar</a></td>
			</tr>

			<tr ALIGN="center">
			    	<td height="15" valign=middle colspan="2"> 
					      <div id="Cajadptoer" style="display:none;">Dpto. Entre R&iacute;os <? dpto_er(); ?></div>
				</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Domicilio:</td>
				<td height="15" valign=middle><input type="text" name="domicilio" size="40" maxlength="50" class=":required"  style="text-transform:uppercase;" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"></td>
				<td height="15" valign=middle class="txt"></td>
			</tr>

			<!--Función que muestra el tipo de actividad según afip -->
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req"><br>En caso de no encontrar la actividad<br> ingresar 0 antes del n&uacute;mero.</span></td>
				<td height="15" valign=middle class="txt"> Actividad principal: <br>
			 
				<?// tipoactividadafip(); ?>
				<!-- <input id="buscarAfip" name="act_afipP" size="35"> -->
				<!-- <div> -->
				<input type="text" id="input-fill" autocomplete="off" name="act_afipP" size="35"
					onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
				<div class="contenedorlista"><div id="lista" class="fill"></div></div>
				<!-- </div> -->
				
				<p>M&aacute;s Actividades: <input type="checkbox" name="mas_act" id="mas_act" onclick="mas_activ(this.form)" /></p>
					<div id="Caja_mas_act" style="display:none;" class='txt'>
						<p>2ª Actividad:</p> <input type="text" id="input-fill" autocomplete="off" name="act_afipS" size="35"
								onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
							<div class="contenedorlista"><div id="lista" class="fill"></div></div>
						<p>3ª Actividad:</p> <input type="text" id="input-fill" autocomplete="off" name="act_afipT" size="35"
								onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
							<div class="contenedorlista"><div id="lista" class="fill"></div></div>
						<p>4ª Actividad:</p><input type="text" id="input-fill" autocomplete="off" name="act_afipC" size="35"
								onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
							<div class="contenedorlista"><div id="lista" class="fill"></div></div>
						<p>5ª Actividad:</p><input type="text" id="input-fill" autocomplete="off" name="act_afipQ" size="35"
								onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
							<div class="contenedorlista"><div id="lista" class="fill"></div></div>
					</div>
				</td>
			</tr>
			
			
			
			<!--Muestra el tipo de actividad secundaria según afip -->
<!-- 			<tr ALIGN="center"> -->
<!-- 			    <td height="15" valign=middle class="txt"></td> -->
<!-- 				<td height="15" valign=middle onchange=checklistas(); class="txt"> Actividad secundaria:<br> -->
				<?// tipoSubActividadAfip();?>
				<!-- <input id="buscarAfipS" name="act_afipS" size="35"> -->
				<!-- <div> -->
<!-- 				<input type="text" id="input-fill" autocomplete="off" name="act_afipS" size="35" onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
<!-- 				<div class="contenedorlista"><div id="lista" class="fill"></div></div> -->
				<!-- </div> -->
<!-- 			</td> -->
<!-- 			</tr> -->
			
<!-- 			<tr ALIGN="center"> -->
<!-- 			    <td height="15" valign=middle class="txt"></td> -->
<!-- 				<td height="15" valign=middle class="txt">3ª Actividad:<br> -->
				<? //tipoSubIIActividadAfip();?>
				<!-- <input id="buscarAfipT" name="act_afipT" size="35"> -->
				<!-- <div> -->
<!-- 				<input type="text" id="input-fill" autocomplete="off" name="act_afipT" size="35" onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
<!-- 				<div class="contenedorlista"><div id="lista" class="fill"></div></div> -->
				<!-- </div> -->			
<!-- 			</td> -->
<!-- 			</tr> -->
			
<!-- 			<tr ALIGN="center"> -->
<!-- 			    <td height="15" valign=middle class="txt"></td> -->
<!-- 				<td height="15" valign=middle class="txt">4ª Actividad:<br> -->
				<? //tipoSubIIIActividadAfip();?>
				<!-- <input id="buscarAfipC" name="act_afipC" size="35"> -->
				<!-- <div> -->
<!-- 				<input type="text" id="input-fill" autocomplete="off" name="act_afipC" size="35" onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
<!-- 				<div class="contenedorlista"><div id="lista" class="fill"></div></div> -->
				<!-- </div> -->		
<!-- 			</td> -->
<!-- 			</tr> -->
			
<!-- 			<tr ALIGN="center"> -->
<!-- 			    <td height="15" valign=middle class="txt"></td> -->
<!-- 				<td height="15" valign=middle class="txt">5ª Actividad:<br> -->
				<? //tipoSubIVActividadAfip();?>
			<!-- <input id="buscarAfipQ" name="act_afipQ" size="35"> -->
				<!-- <div> -->
<!-- 				<input type="text" id="input-fill" autocomplete="off" name="act_afipQ" size="35" onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
<!-- 				<div class="contenedorlista"><div id="lista" class="fill"></div></div> -->
				<!-- </div> -->	
<!-- 			</td> -->
<!-- 			</tr> -->
			
			<!-- Para ingresar una fecha de inicio de actividades-->
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Inicio Activ.</td>
			
			<td height="15" valign=middle>
			 <input type="date" name="f_iniact" id="f_iniact">
				<?// diaIni(); mesIni(); anioIni(); ?>
			</td>
			</tr>
			
			<!-- Para ingresar la fecha de ingreso al sistema
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Fecha de ingreso a nuestro sistema:</td>
			
			<td height="15" valign=middle onchange=checkfechasIngSis();> -->
				<? //diaIng(); mesIng(); anioIng(); ?>
			<!--</td>
			</tr>-->
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"><span class="req">*</span> Tel&eacute;fono #1:</td>
				<td height="15" valign=middle><input type="text" name="tel1" size="40" maxlength="50" class=":required" onkeyup="esconde(this.form)" />
                         </td>
			</tr>


			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Tel&eacute;fono #2:</td>

					      
			<td height="15" valign=middle><input type="text" name="tel2" size="40" maxlength="50" />
                         </td>
			</tr>


			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt"> Mail contacto: </td>

					      
			<td height="15" valign=middle><input type="email" name="mail" size="40" maxlength="50" />
			</td>
			</tr>
			
			<tr ALIGN="center"><td height="15" valign=middle class="txt"> Observaci&oacute;n: </td>
			<td height="15" valign=middle><TEXTAREA rows="4" cols="36" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obser" style="text-transform:uppercase">...</TEXTAREA>
			</td>
			</tr>
	
			<!-- CheckBox que me indica si el empleado hay que cargarlo-->
			<tr ALIGN="center"><td height="15" valign=middle></td>
			<td height="15" valign=middle>
			<br/> <input name="carga_titu" type="checkbox" checked="checked" value="carga_titu"/> Cargar empleado <br/>
			
			</td>
			</tr>
			
</table>

</div> <!-- CajaEmpre -->

<div id="Caja_graba" style="display:none;" class="centraTabla">
<table>
	<tr ALIGN="center">
			    <td height="15" valign=middle> 
				<input type="submit" name ="graba" value="Grabar" size="10" class="grabar" style="visibility: hidden" />
				</td>
	</tr>
</table>
</div>
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

<div id="cajapie" class="centraTabla"></div>

</div> <!-- CajaPrincipal-->

</div><!-- Contenedor -->

<?
include("includes/footer.php");
}
?>