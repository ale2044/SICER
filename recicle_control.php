<? php;
session_start();

include('conexion.inc.php');

global $i;

$i=0;

//print "Usuario: ".$_POST["usuario"]."<br><br>";

//print "Pass: ".$_POST["contrasena"]."<br><br>";

//var_dump($POST);

$sql = " SELECT usuario, clave FROM usuarios "; 

$result = mysql_query($sql) or die ('La siguiente consulta contiene alg�n error:<br>nSQL: <b>$sql</b>');

//$myrow=mysql_fetch_array($result);


//vemos si el usuario y contrase�a es v�ildo 

while ($myrow=mysql_fetch_array($result))
{

	if ($_POST["usuario"]== $myrow[usuario] && $_POST["contrasena"]== $myrow[clave])
		{
	

    //usuario y contrase�a v�lidos 
    //defino una sesion y guardo datos 
   $_SESSION["autentificado"]= "SI";
   $_SESSION["user"]=$_POST["usuario"];
   //$_SESSION["user"]=mysql_result($result, $i, "usuario");
   header ("Location: menu.php"); 
    
 	} else {

print "Usuario: ".$_POST["usuario"]."<br><br>";
  
print "Pass: ".$_POST["contrasena"]."<br><br>";
	
    //si no existe le mando otra vez a la portada 
//  header("Location: index.php?errorusuario=si"); 
		}

}


?> 


<html>

<head>

</head>

<body>

<!--FORM ACTION="Formularios/form.php" METHOD="POST"-->


</body>
</html>
