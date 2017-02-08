<?
session_start();
require_once("includes/connection.php");

function bajaE()
{

$resultados = mysql_query("select CODBAJA,NOMBAJ from bajaempresa");

?>

<select size="1" name="bajaE" style="width:250px">
<option value="null">Selecciona un motivo</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
	

		<option value="<? echo $myrow[CODBAJA]; ?>">
				<? echo $myrow[NOMBAJ]; ?>
		</option>

<?}
 
?>    </select>

<?
//return $bajaE;//
}
?>