<?
session_start();
require_once("includes/connection.php");

function localidad()
{

$resu = mysql_query("select nombre from localidades ORDER By nombre ASC");

?>

<select size="1" name="localidad" style="width:250px">

<? while ($myrow=mysql_fetch_array($resu))
	{
		
?>
	

		<option value="<? echo $myrow[nombre]; ?>">
				<? echo $myrow[nombre]; ?>
		</option>

<?}
 
?>    </select>

<?
return $localidad;
}
?>