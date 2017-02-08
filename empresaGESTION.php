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
include ("fcionbajaEmpre.php");
include ("fcionEstudioContable.php");

if ($_SESSION ["autentificado"] != "SI") { header ( "Location: index.php" ); }

$user = $_SESSION ["user"];
$cuit_emp = $_GET ["empresa"];
$cuit_buffer = $_GET ["empresa"];

$sqlBusca="select cuit from empredesdefilial where cuit='$cuit_buffer'";
$resultBusca=mysql_query($sqlBusca, $link);

if (mysql_num_rows($resultBusca)==1){
		$pcias = mysql_query ( "SELECT * from empredesdefilial WHERE cuit='$cuit_buffer'" );
		$row = mysql_fetch_assoc ( $pcias );
}else
{
	$alerta='seleccionar';
	header("Location: gestionar_empresa.php?alerta=$alerta");	
}
?>

<?include("includes/header.php");?>

<script  type="text/javascript">
function agregarEstudio()
{
	var cont = document.formulario.agregarEstudioContable.value;
	
	if (cont == "1"){
		var lugar='gestion';
		var misVariablesGet = getVarsUrl();
		var a=misVariablesGet.empresa;// devuelve "cuil"

		window.location = "estudiocontableALTA.php?lugar=" + lugar+"&cuit_empre="+a;
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

<!-- SCRIPT PARA BUSCAR ACTIVIDAD DE AFIP -->
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
<!-- TERMINA SCRIPT PARA BUSCAR ACTIVIDAD AFIP -->

</head>

<body>
	<div id="contenedor" class="centraTabla">
	<div id="cajachicasup"></div>
		<div id="cajappal">
			<h1 align="center">
				Panel de GESTI&Oacute;N de Datos: EMPRESAS || Usuario: <b><? echo $user; ?></b>
			</h1>
		
		<!-- grabar_act_empre.php -->
	<form action="grabar_act_empre.php" name="formulario" id="formulario" method="POST">
	
	<div id="CajaEmpre" class="centraTabla">
		<!-- Guarda en Buffer el CUIT -->
		<input type="hidden" name="cuit_buffer" size="40" maxlength="11" value="<? print $cuit_buffer; ?>" class=":integer :max_length;11" />
		<!-- Guarda en la fecha real de cargado al sistema sindi desde filial -->
		<input type="hidden" name="fcarga" size="40" maxlength="11" value="<? print $row["fecha_de_carga"]; ?>" />
				
		<table>
			<tr align="center">
				<td colspan="2" height="20" valign=middle bgcolor="#EFEEDA">Modifique los Datos de la Empresa que desee</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt"><span class="req">*</span> CUIT EMPRESA</td>
				<td height="15" valign=middle><input type="text" name="cuit_empre" size="40" maxlength="11"	value="<? print $row['cuit']; ?>" class=":integer :max_length;11 :required" />
				</td>
			</tr>	
			
			<tr align="center">
				<td height="15" valign=middle class="txt"><span class="req">*</span> Nombre:</td>
				<td height="15" valign=middle><input type="text" name="nombre" size="40" maxlength="50" class=":required" style="text-transform: uppercase;" value="<? print $row['nombre']; ?>" /></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Nom. Fantasia:</td>
				<td height="15" valign=middle><input type="text" name="fantasii" size="40" maxlength="30" style="text-transform: uppercase;" value="" /></td>
			</tr>
			
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Provincia:</td>
				<td height="15" valign=middle><input type="text" name="pcia" size="40" maxlength="50" style="text-transform: uppercase;" value="<? print $row['pcia']; ?>" /></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Zona:</td>
				<td height="15" valign=middle><input type="text" name="zna" size="40" maxlength="50" value="<? print $row['zona']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle class="txt">Localidad:</td><td height="15" valign=middle class="txt">
				<input type="text" name="local" size="22.7" maxlength="30" style="text-transform:uppercase;" value="<? print $row['localidad']; ?>"/>
				C.P.:<input type="text" name="cp" size="4" maxlength="4" value="<? print $row['CODPOST']; ?>" /></td>
			</tr>
						
			<tr align="center">
				<td height="15" valign=middle class="txt">Domicilio:</td>
				<td height="15" valign=middle><input type="text" name="domi" size="40" style="text-transform: uppercase;" value="<? print $row['domi']; ?>" /></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Tel. #1:</td>
				<td height="15" valign=middle><input type="tel" name="tel1" size="40" value="<? print $row['tel1']; ?>" /></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Tel. #2:</td>
				<td height="15" valign=middle><input type="tel" name="tel2" size="40" value="<? print $row['tel2']; ?>" /></td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">E-mail:</td>
				<td height="15" valign=middle><input type="email" name="email" size="40" maxlength="50" value="<? print $row['mail']; ?>" /></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ---------------- TIPO ACTIVIDAD ------------------ -->
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>Actividad principal:</i></td>
				<td height="15" valign=middle>
					<?
						$act = $row ['tipo_actividad'];
						$act = mysql_query ( "SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act'" );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					<input type="hidden" name="bufferactppal" value="<? print $row['tipo_actividad']; ?>" />
					
					<textarea rows="4" cols="34" readonly="readonly" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" 
						name="" style="text-transform: uppercase;">
						<?if ($row['tipo_actividad']=='null'){print "No posee actividad";}else {print utf8_decode($row['tipo_actividad'].' - '.$row1['DESCRIPCION']);} ?>
					</textarea>
				</td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Actividad principal p/ modif.:</td>
				<td height="15" valign=middle><?// tipoactividadafip(); ?>
					
				<!-- <div> -->
				<p>Escriba el c&oacute;digo para modificar:</p> <input type="text" id="input-fill" autocomplete="off" name="act_afipP" size="35"
					onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
				<div class="contenedorlista"><div id="lista" class="fill"></div></div>
				<!-- </div> -->
				
				</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- SUB actividad --------------------- -->
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>Actividad secundaria:</i></td>
				<td height="15" valign=middle>
					<?
						$act = $row ['sub_actividad'];
						$act = mysql_query ( "SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act'" );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					
					<input type="hidden" name="bufferactsec" value="<? print $row['sub_actividad']; ?>" /> 
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" 
					readonly="readonly" name="" style="text-transform: uppercase;">
						<? if ($row['sub_actividad']=='null'){print "No posee actividad";}else { print utf8_decode($row['sub_actividad'].' - '.$row1['DESCRIPCION']); }?>
					</textarea>
				</td>
			</tr>

			<!-- recordar: name="desc_sub_afip" -->
			<tr align="center">
				<td height="15" valign=middle class="txt">Actividad secundaria p/ modif.:</td>
				<td height="15" valign=middle><? //tipoSubActividadAfip(); ?>
					
						<p>Escriba el c&oacute;digo para modificar:</p> <input type="text" id="input-fill" autocomplete="off" name="act_afipS" size="35"
								onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
						<div class="contenedorlista"><div id="lista" class="fill"></div></div>

				</td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- Tercera actividad --------------------- -->
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>3era Actividad:</i></td>
				<td height="15" valign=middle>
					<?
						$act = $row ['subII_actividad'];
						$act = mysql_query ( "SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' " );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					
					<input type="hidden" name="bufferactter" value="<? print $row['subII_actividad']; ?>" /> 
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" 
					readonly="readonly" name="" style="text-transform: uppercase;">
						<? if ($row['subII_actividad']=='null'){print "No posee actividad";}else {print utf8_decode($row['subII_actividad'].' - '.$row1['DESCRIPCION']);} ?>
					</textarea>
				</td>
			</tr>

			<!-- recordar: name="subII_act_afip" -->
			<tr align="center">
				<td height="15" valign=middle class="txt">3era Actividad p/ modif.:</td>
				<td height="15" valign=middle><?// tipoSubIIActividadAfip(); ?>
					
						<p>3ª Actividad:</p> <input type="text" id="input-fill" autocomplete="off" name="act_afipT" size="35"
								onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
							<div class="contenedorlista"><div id="lista" class="fill"></div></div>
				</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- Cuarta actividad --------------------- -->
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>4ta Actividad:</i></td>
				<td height="15" valign=middle>
					<?
						$act = $row ['subIII_actividad'];
						$act = mysql_query ( "SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' " );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					
					<input type="hidden" name="bufferactcuar" value="<? print $row['subIII_actividad']; ?>" /> 
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="" style="text-transform: uppercase;">
						<? if ($row['subIII_actividad']=='null'){print "No posee actividad";}else {print utf8_decode($row['subIII_actividad'].' - '.$row1['DESCRIPCION']);} ?>
					</textarea>
				</td>
			</tr>

			<!-- recordar: name="subIII_act_afip" -->
			<tr align="center">
				<td height="15" valign=middle class="txt">4ta Actividad p/ modif.:</td>
				<td height="15" valign=middle><?// tipoSubIIIActividadAfip(); ?>
					
					<p>4ª Actividad:</p><input type="text" id="input-fill" autocomplete="off" name="act_afipC" size="35" onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
					<div class="contenedorlista"><div id="lista" class="fill"></div></div>

				</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- Quinta actividad --------------------- -->
			<tr align="center">
				<td height="15" valign=middle class="txt"><i>5ta Actividad:</i></td>
				<td height="15" valign=middle>
					<?
						$act = $row ['subIV_actividad'];
						$act = mysql_query ( "SELECT DESCRIPCION from actividades_afip WHERE ACTIVIDAD='$act' " );
						$row1 = mysql_fetch_assoc ( $act );
					?>
					
					<input type="hidden" name="bufferactquin" value="<? print $row['subIV_actividad']; ?>" /> 
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="" style="text-transform: uppercase;">
						<?if ($row['subIV_actividad']=='null'){print "No posee actividad";}else {print utf8_decode($row['subIV_actividad'].' - '.$row1['DESCRIPCION']);} ?>
					</textarea>
				</td>
			</tr>

			<!-- recordar: name="subIV_act_afip" -->
			<tr align="center">
				<td height="15" valign=middle class="txt">5ta Actividad p/ modif.:</td>
				<td height="15" valign=middle><? //tipoSubIVActividadAfip(); ?>
					
						<p>5ª Actividad:</p><input type="text" id="input-fill" autocomplete="off" name="act_afipQ" size="35"
								onkeyup="inputFilling(event, this)" onblur="setInput(this, document.getElementById('lista'))">&nbsp;
							<div class="contenedorlista"><div id="lista" class="fill"></div></div>

				</td>
			</tr>

			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- -------------------- INICIO DE ACTIVIDADES --------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Inicio de Actividad:</i></td>
					<td height="15" valign=middle>
						<?
							$fechaini = $row ['inicio_actividad'];
							$fechaini2 = date ( "d-m-Y", strtotime ( $fechaini ) );
						?>
						<input type="hidden" name="fIniActBuffer" value="<? print $fechaini; ?>" />
						<input type="text" name="" size="11" maxlength="10" value="<? print $fechaini2; ?>" />
						
												
					</td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de Inicio de Act. p/ modif.:</td>
								<td height="15" valign=middle>
						<? diaInic(); mesInic(); anioInic(); ?>
					</td>
			</tr>
			<!-- --------------------------------------------------------------	 -->
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- ----------------- FECHA DE INGRESO AL SISTEMA -------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Fecha de Ingreso al sistema:</i></td>
					<td height="15" valign=middle>
				<?
					$fecha1 = $row ['fecha_ingreso_sistema'];
					$fecha2 = date ( "d-m-Y", strtotime ( $fecha1 ) );
				?>
					<input type="hidden" name="fechaIngBuffer" value="<? print $fecha1; ?>" /> 
					<input type="text" name="" size="11" maxlength="10"	value="<? print $fecha2; ?>" />
					</td>
			</tr>
			<tr align="center">
					<td height="15" valign=middle class="txt">Fecha de Ingreso al sis. p/ modif.:</td>
					<td height="15" valign=middle><? diaIngs(); mesIngs(); anioIngs(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<!-- -------------------- ESTUDIO CONTABLE --------------------- -->
			<tr align="center">
					<td height="15" valign=middle class="txt"><i>Estudio Contable:</i></td>
					<td height="15" valign=middle>
						<?
							$act = $row ['id_estudio'];
							$act = mysql_query ( "SELECT D_ESTUDIO from estconta WHERE C_ESTUDIO='$act'" );
							$row1 = mysql_fetch_assoc ( $act );
						?>
						<input type="hidden" name="bufferestudio" value="<? print $row['id_estudio']; ?>" />
						<textarea rows="2" cols="34" readonly="readonly" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="est_conta" style="text-transform: uppercase;"><? print $row['id_estudio'].' - '.$row1['D_ESTUDIO']; ?>
					</textarea>
				</td>
			</tr>
			<!-- recordar: name="agregarEstudioContable" -->
			<tr align="center">
				<td height="15" valign=middle class="txt">Estudio Contable p/ modif.:</td>
				<td height="15" valign=middle onChange=agregarEstudio();><? mostrarEstudioContable(); ?></td>
			</tr>
			
			<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Cantidad de personal:</td>
				<td height="15" valign=middle><input type="text" name="cantprs" size="11" maxlength="4"	value="" /></td>
			</tr>
		
			<tr align="center">
				<td height="15" valign=middle class="txt">Personal en OS:</td>
				<td height="15" valign=middle><input type="text" name="canmpos" size="11" maxlength="4"	value="" /></td>
			</tr>

			<tr align="center">
				<td height="15" valign=middle class="txt">Personal en SINDICATO:</td>
				<td height="15" valign=middle><input type="text" name="cemps" size="11" maxlength="4" value="" /></td>
			</tr>
			<!-- --------------------------------------------------------------	 -->
			<!-- ---------------- FECHA DE Ultimo periodo MUTUAL AMUTCAER -------------------- -->
			<!--
			<tr align="center">
				<td height="15" valign=middle class="txt">Ult. Período Mutual (AMUTCAER):</td>
				<td height="15" valign=middle>
				 <input type="date" name="fecha_pm" id="fecha_pm">
				<?// diapm(); mespm(); aniopm(); ?>
				</td>
			</tr>
			
			<tr align="center">
				<td height="15" valign=middle class="txt">Ult. Período Obra Social:</td>
				<td height="15" valign=middle>
				<input type="date" name="fecha_pos" id="fecha_pos">
				<?// diapos(); mespos(); aniopos(); ?>
				</td>
			</tr>
		
			<tr align="center">
				<td height="15" valign=middle class="txt">Ult. Período Sindical:</td>
				<td height="15" valign=middle>
				<input type="date" name="fecha_pes" id="fecha_pes">
				<? //diapes(); mespes(); aniopes(); ?>
				</td>
			</tr>
		 --------------------------------------------------------------	 -->			
		
			<tr align="center">
					<td height="15" valign=middle class="txt">Observaciones:</td>
					<td height="15" valign=middle>
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obser" style="text-transform: uppercase;">
						<? print $row['observacion']; ?>
					</textarea>
			</tr>
			
			<tr align="center">
					<td height="15" valign=middle class="txt">Observaciones de Fiscalización/Cobranzas:</td>
					<td height="15" valign=middle>
					<textarea rows="4" cols="34" onKeyUp="maximo(this,255);" onKeyDown="maximo(this,255);" name="obserfc" style="text-transform: uppercase;">
					...</textarea>
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
				<td height="15" valign=middle class="txt2">Fecha de carga:<? print "  ".$row["fecha_de_carga"]; ?></td>
		</tr>
		
		<tr ALIGN="center">
			    <td height="15" valign=middle colspan="2">···················································································· </td>
		</tr>
		</table>	
			
	</div>
	<!-- CajaEmpre -->

		<table>
			<tr align="center">
				<td height="15" align="center" valign="middle"><input type="submit" name="graba" value="Grabar" size="10" class="grabar" /></td>
			</tr>
		</table>

	</form>

			<div id="cajapie" class="centraTabla">
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
			</div>

		</div>
		<!-- CajaPrincipal-->

	</div>
	<!-- contenedor -->

<script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="vanadium.js"></script>

<?php include("includes/footer.php");
}
?>