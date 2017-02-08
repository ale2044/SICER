<?
session_start();
require_once("includes/connection.php");

function tipopariente()
{

$resultados = mysql_query("select cod_paren, desc_paren from parentesco order by cod_paren asc");

?>

<select size="1" name="tipoparen" style="width:250px">

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>


		<option value="<? echo $myrow[cod_paren]; ?>" OnChange="activar(this.form)">
				<? echo $myrow[desc_paren]; ?>
		</option>

<?}
 
?>    </select>

<?
return $tipoparen;
}
?>