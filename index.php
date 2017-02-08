<?
session_start();
require_once("includes/connection.php");
if(isset($_SESSION["user"])){
// echo "Session is set"; // for testing purposes
header("Location: menu.php");
}

if(isset($_POST["login"])){

if(!empty($_POST['usuario']) && !empty($_POST['clave'])) {
    $username=$_POST['usuario'];
    $password=$_POST['clave'];

    $query =mysql_query("SELECT * FROM usuarios WHERE usuario='".$username."' AND clave='".$password."'");

    $numrows=mysql_num_rows($query);
    if($numrows!=0)

    {
    while($row=mysql_fetch_assoc($query))
    {
    $dbusername=$row['usuario'];
    $dbpassword=$row['clave'];
    }

    if($username == $dbusername && $password == $dbpassword)

    {


    $_SESSION['user']=$username;

    /* Redirect browser */
    header("Location: menu.php");
    }
    } else {

 $message =  "<b>Nombre de usuario o contrase&ntilde;a incorrecta!</b>";
    }

} else {
    $message = "Todos los campos son requeridos!";
}
}

include("includes/header.php");?>

<div id="contenedor">
<form name="loginform" id="loginform" action="" method="POST">

<div id="cajachicasup"></div>

<div id="cajappal">

<h1 align="center">
Bienvenido al Panel de Validaci&oacute;n de Usuarios
</h1>

<table width="50%" align="center" >
            <tr ALIGN="center"><td height="20" valign=middle, bgcolor=#E8E8E8>    
            Nombre de Usuario</td><tr align="center"><td>
            <input type="text" name="usuario" id="username" class="input" value="" size="10" />
            </td></tr>
            </tr>

            <tr ALIGN="center"><td height="20" valign=middle, bgcolor=#E8E8E8>
            Contrase&ntilde;a</td><tr align="center"><td>
            <input type="password" name="clave" id="password" class="input" value="" size="10" />
            </td></tr>
            </tr>

            <tr ALIGN="center"><td height="20" valign=middle>
            <input type="submit" name="login" class="button" value="Entrar" /></td>
            </tr>

</table>

    
</form>

    </div>

    </div>
	
	<?php include("includes/footer.php"); ?>
	
    <table width="50%" align="center" >
    <tr ALIGN="center"><td height="20" valign=middle, bgcolor=#E8E8E8>
	<?php if (!empty($message)) {echo "<p class=\"error\">" . "Atenci&oacute;n: ". $message . "</p>";} ?>
	</tr>
    </table>