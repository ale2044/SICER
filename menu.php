<?php 
session_start();
if(!isset($_SESSION["user"])) {
	header("location:index.php");
} 

else {
$user = $_SESSION["user"];
$reci = $_GET["recibio"];
$alerta = $_GET["alerta"];
$cuit_emp = $_GET["cuit_emp"];

?>

<? include("includes/header.php"); ?>

<script type="text/javascript">
function chequea(campo,boton)
{
	var tipo1 = campo.value;
	numCarac = tipo1.length;

	if (numCarac == 11) 
	{
		boton.disabled=false;
	} else 
		{
			boton.disabled=true;
		}
}

function chequeaDNI(campo,boton)
{

	var tipo1 = campo.value;
	numCarac = tipo1.length;
		if /*(campo.value != "") && */(numCarac == 8) 
			{
				boton.disabled=false;
			} else 
				{
					boton.disabled=true;
				}
}

</script>

<script type="text/JavaScript1.2">
var message="Sistema de Gestión Camioneros de Entre Ríos" 
var message=message+" " 
i="0" 
var temptitle=""
var speed="150"

function titler(){
if (!document.all&&!document.getElementById)
return
document.title=temptitle+message.charAt(i)
temptitle=temptitle+message.charAt(i)
i++ 
if(i==message.length)
{
i="0"
temptitle=""
}
setTimeout("titler()",speed)
}

window.onload=titler

</script>

<div id="contenedor">
<div id="cajachicasup">
</div>
<!-- Recuerde que tanto el DNI como el nro de CUIT no deben llevar puntos. Ejemplo de CUIT 20302332309 -->
<h1 align="center"> Bienvenido <b> <? echo $user; ?></b> al Menú de Usuarios</h1>
<div id="cajappal">
<!-- nav corresponde a los menues Empresa, Titulares y Familiares en el formas.css -->
<ul id="nav">
    <li><a href="#">EMPRESAS</a>
      <ul>
          <!-- Botón dar de alta -->
          <li>
            <form action="empresaALTA.php" name="formulario" id="formulario" method="POST">
            	<input type="text" name="cuit_empre" size="17" maxlength="11" value="CUIT (11 caracteres)" onkeyup="chequea(this,this.form.alta_empre)" 
            		onFocus="if (this.value=='CUIT (11 caracteres)') this.value='';"/>
               	<input type="submit" name="alta_empre" disabled  value="Dar de Alta..." size="11"/>
            </form>
          </li>
          <!-- Botón dar de baja -->
          <li>
          	<form action="empresaBAJA.php" name="formulario" id="formulario" method="POST">
            	<input type="text" name="cuit_empre" size="17" maxlength="11" value="CUIT (11 caracteres)" onkeyup="chequea(this,this.form.baja_empre)" 
            		onFocus="if (this.value=='CUIT (11 caracteres)') this.value='';"/>
               	<input type="submit" name="baja_empre" disabled value="Dar de Baja..." size="11" />
            </form>
         </li>
         <!-- Botón editar -->
         <li>
         	<form action="empresaBUSCAR.php" name="formulario" id="formulario" method="POST">
            	<input type="text" name="dato_empre" size="17" value="CUIT o Nombre" 
            		onFocus="if (this.value=='CUIT o Nombre') this.value='';"/>
                <input type="submit" name="busca_empre" value="Editar..." size="11" />
            </form>
        </li>
        <!-- Botón buscar -->
 		<li>
 			<form action="empresaBUSCAR.php" name="formulario" id="formulario" method="POST">
            	<input type="text" name="dato_empre" size="17" value="CUIT o Nombre" 
            		onFocus="if (this.value=='CUIT o Nombre') this.value='';"/>
                <input type="submit" name="busca_empre" value="Buscar..." size="11" />
            </form>
        </li>
     </ul>
    </li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    <li><a href="#">TITULARES</a>
      	<ul>
        <!-- Botón dar de alta empleado -->
        <li>
        	<form action="empleadoALTA.php" name="formulario" id="formulario" method="POST">
   	        	<input type="text" name="cuil_titu" size="17" maxlength="11" value="CUIL (11 caracteres)" onkeyup="chequea(this,this.form.alta_titu)" 
            		onFocus="if (this.value=='CUIL (11 caracteres)') this.value='';"/>
                <input type="submit" name="alta_titu" disabled value="Dar de Alta..." size="11" />
            </form>
        </li>
        <!-- Botón baja empleado -->        	    
        <li>
        	<form action="empleadoBAJA.php" name="formulario" id="formulario" method="POST">
	            <input type="text" name="cuil_titu" size="17" maxlength="11" value="CUIL (11 caracteres)" onkeyup="chequea(this,this.form.baja_titu)"
    	    	    onFocus="if (this.value=='CUIL (11 caracteres)') this.value='';" />
        	    <input type="submit" name ="baja_titu" disabled value="Dar de Baja..." size="11"/>
        	</form>
        </li>
        <!-- Botón editar empleado -->
        <!-- para editar esta en empleadoEDICION.php // dato_titu antes era cuil_titu-->
        <li>
        	<form action="titularBUSCAR.php" name="formulario" id="formulario" method="POST">
	            <input type="text" name="dato_titu" size="17" value="CUIL, APELLIDO o NOMBRE"
	               onFocus="if (this.value=='CUIL, APELLIDO o NOMBRE') this.value='';" />
        	    <input type="submit" name ="busca_titu" value="Editar..." size="11"/>
        	</form>
        </li>
        <li>
        	<form action="titularBUSCAR.php" name="formulario" id="formulario" method="POST">
	            <input type="text" name="dato_titu" size="17" value="CUIL, APELLIDO o NOMBRE"
	               onFocus="if (this.value=='CUIL, APELLIDO o NOMBRE') this.value='';" />
        	    <input type="submit" name ="busca_titu" value="Buscar..." size="11"/>
        	</form>
        </li>
        <li>
        	<form action="titularBUSCARNafiliado.php" name="formulario" id="formulario" method="POST">
	            <input type="text" name="dato_titu" size="17" value="NRO AFILIADO"
	               onFocus="if (this.value=='NRO AFILIADO') this.value='';" />
        	    <input type="submit" name ="busca_titu" value="Buscar..." size="11"/>
        	</form>
        </li>
    	</ul>
    </li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    <li><a href="#">FAMILIARES</a>
      	<ul>
      <!-- Botón dar de alta familiar -->
            <li><a href="familiarPANEL_ALTA.php">Alta desde filial</a>
            <li>
        	<form action="titularBUSCAR.php" name="formulario" id="formulario" method="POST">
	            <input type="text" name="dato_titu" size="17" maxlength="11" value="DNI, APELLIDO o NOMBRE"
	               onFocus="if (this.value=='DNI, APELLIDO o NOMBRE') this.value='';" />
        	    <input type="submit" name ="busca_titu" value="Agregar Familiar..." size="11"/>
        	</form>
       		</li>

            <li>
            	<form action="familiarBAJA.php" name="formulario" id="formulario" method="POST">
            		<input type="text" name="dni_fliar" size="17" maxlength="8" value="DNI del familiar" onkeyup="chequeaDNI(this,this.form.bajar_flia)" 
            			onFocus="if (this.value=='DNI del familiar') this.value='';"/>
                	<input type="submit" name="bajar_flia" disabled value="Dar de Baja..." size="8" />
            	</form>
            </li>

            <li>
            	<form action="familiarBUSCAR.php" name="formulario" id="formulario" method="POST">
            		<input type="text" name="dato_flia" size="17" maxlength="8" value="DNI o Nombre"
            			onFocus="if (this.value=='DNI o Nombre') this.value='';"/>
            		<input type="submit" name="busca_fliar" value="Editar..." size="11" />
           	 	</form>
            </li>
            <li>
        		<form action="familiarBUSCAR.php" name="formulario" id="formulario" method="POST">
            		<input type="text" name="dato_flia" size="17" maxlength="11" value="DNI o Nombre" 
            			onFocus="if (this.value=='DNI o Nombre') this.value='';"/>
                	<input type="submit" name="busca_fliar" value="Buscar..." size="11" />
            	</form>
        	</li>
		</ul>
    </li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    <li><a href="#">Sede Central</a>
    	<ul>
    		<li><a href="gestionar_empresa.php">Empresas</a></li>
            <li><a href="gestionar_titu.php">Titulares</a></li>
            <li><a href="gestionar_familia.php">Familiares</a></li>
    	</ul>
	</li>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    	<li><a href="cerro.php">SALIR</a></li>
	</ul> 

</div> <!-- cajappal -->
</div> <!-- contenedor -->

<?
/*verificar el tipo de alerta y notificar*/
switch ($alerta) {
	case 407:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: La empresa NO existe!");
			</script>
		<?; break;
    case 408:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: Los datos fueron GRABADOS correctamente.");
			</script>
		<?; break;
	case 409:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: La empresa fue dada de BAJA correctamente.");
			</script>
		<?; break;
	case 410:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El empleado fue dado de ALTA correctamente.");
			</script>
    	<?; break;
	case 411:
    	?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El empleado NO existe!");
			</script>
      	<?; break;
    case 412:
      	?>
			<script type="text/JavaScript1.2">
      			alert("ATENCI\u00d3N: El empleado fue actualizado correctamente!");
      	 	</script>
      	<?; break;
    case 413:
   		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El empleado fue dado de baja!");
			</script>
      	<?; break;
    case 414:
      	?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: No se realizaron los cambios.");
			</script>
		<?; break;
	case 415:
      	?>
			<script type="text/JavaScript1.2">
				alert("El familiar fue grabado correctamente.");
			</script>
		<?; break;
	case 416:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El familiar no existe!");
			</script>
		<?; break;
	case 417:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El familiar fue dado de baja con \u00c9xito!");
			</script>
		<?; break;
	case 'empbaja':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: ESTA EMPRESA YA FUE DADA DE BAJA!");
			</script>
		<?; break;
	case 'empreExiste':
		?>
			<script type="text/JavaScript1.2">
				var cuit_empreJS="<?php echo $cuit_emp;?>";
				if (confirm("La empresa existe ¿Desea editarla?") == true) { 
					window.open("empresaEDITAR.php?cuit_empre="+cuit_empreJS,'_parent');} 
	    	</script>
		<?; break;
	case 'tituBaja':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El titular fue dado de baja comuniquese con Sede Central.");
    		</script>
		<?; break;
	case 'tituBaja_B':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El titular ya fue dado de baja.");
    		</script>
		<?; break;
	case 'empleExiste':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El titular ya existe!");
			</script>
		<?; break;
	case 'famiBaja':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El familiar ya fue dado de baja!");
			</script>
		<?; break;
	case 209:
			?>
						<script type="text/JavaScript1.2">
							alert("Ya se GUARDARON todos los Familiares");
						</script>
			<?; break;
	case 'nroafilnoen':
			?>
						<script type="text/JavaScript1.2">
							alert("El n\u00FAmero de afiliado no se encuentra");
						</script>
			<?; break;
}
?>

<script type='text/javascript' src='js/menu.js'></script>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/vanadium.js"></script>

<?php include("includes/footer.php");
}
?>