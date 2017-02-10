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

<?php include("includes/alertas.php");?>
<script type='text/javascript' src='js/menu.js'></script>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/vanadium.js"></script>
<?php include("includes/footer.php");}?>