<?
session_start();
require_once("includes/connection.php");

function zona()
{

$resultados = mysql_query("select ZONA,NOMZON from zona");

?>

<select size="1" name="zon" style="width:250px">

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
	

		<option value="<? echo $myrow[ZONA]; ?>">
				<? echo $myrow[NOMZON]; ?>
		</option>

<?}
 
?>    </select>

<?
return $zon;
}
?>