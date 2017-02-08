<?
session_start();
require_once("includes/connection.php");

if(!isset($_SESSION["user"])) {
	header("location:index.php");
}
else{
$user = $_SESSION ["user"];

//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";


//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

	//Selecciona todo de la tabla mmv001
	//donde el nombre sea igual a $consultaBusqueda,
	//o el apellido sea igual a $consultaBusqueda,
	//o $consultaBusqueda sea igual a nombre + (espacio) + apellido	
	
	$consulta = mysql_query("SELECT * FROM actividades_afip	WHERE ACTIVIDAD COLLATE utf8_general_ci LIKE '%$consultaBusqueda%'
			OR DESCRIPCION COLLATE utf8_general_ci LIKE '%$consultaBusqueda%'
			OR CONCAT(ACTIVIDAD,' ',DESCRIPCION) COLLATE utf8_general_ci LIKE '%$consultaBusqueda%'");// COLLATE utf8_general_ci

	//Obtiene la cantidad de filas que hay en la consulta
	$filas = mysql_num_rows($consulta);

	
	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {
		$mensaje = "<p>No hay ningún usuario con ese nombre y/o apellido</p>";
	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';

		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		while($resultados = mysql_fetch_array($consulta)) {
			$actividad = $resultados['ACTIVIDAD'];
			$descripcion = $resultados['DESCRIPCION'];

			//Output
			$mensaje .= '
			<p>
			<strong> ' . $actividad . '</strong> ' . $descripcion . '<br>
			</p>';

		};//Fin while $resultados

	}; //Fin else $filas

};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje; }
?>