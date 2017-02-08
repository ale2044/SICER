<?
session_start();
require_once("includes/connection.php");

function listbajaEmple()
{

$resultados = mysql_query("select CTCOD,CTDES from bajas_determ");

?>

<select size="1" name="listabajaEmple" style="width:250px">
<option value="null">Selecciona un motivo</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
	

		<option value="<?echo utf8_decode(  $myrow[CTCOD] ); ?>">
				<? echo utf8_decode(  $myrow[CTDES] ); ?>
		</option>

<?}
 
?>    </select>

<?
//return $bajaE;//
}
?>