<?
session_start();
require_once("includes/connection.php");

function tipoactividad()
{

$resultados = mysql_query("select TIPOACT, DESCRIPCION from tipoactividad order by TIPOACT asc");

?>

<select size="1" name="tipoact" style="width:250px">
<option value="null">Selecciona una actividad</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
		<option value="<? echo utf8_decode($myrow[TIPOACT]); ?>">
		<? echo utf8_decode($myrow[DESCRIPCION]); ?>
		</option>

<?}
 
?>    </select>

<?
//return $tipoact;
}
?>