<?
session_start();
require_once("includes/connection.php");

function mostrarCuitEmpresa()
{
$resultados = mysql_query("select NOMBRE, SUSS from empresas order by NOMBRE asc");

?>
<select size="1" name="cuitempreAgre" style="width:250px">

<option value="2">Selecciona una empresa</option>
<option value="1">>> Agregar empresa [...]</option>
<option value="9999">>> Desempleado </option>
<option value="8888">>> Caja de Jubilaciones</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
?>
				
				<option value="<? echo $myrow[SUSS]; ?>">
				       <? echo $myrow[NOMBRE]." - ".$myrow[SUSS]; ?>
		</option>

	<?}
?></select>

<?

}

function nombrarEmpresa()
{
$resultados = mysql_query("select NOMBRE, SUSS from empresas order by NOMBRE asc");

?>
<select size="1" name="cuitempre" style="width:250px">

<option value="2">Selecciona una empresa</option>
<option value="9999">>> Desempleado </option>
<option value="8888">>> Caja de Jubilaciones</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
?>
				
				<option value="<? echo $myrow[SUSS]; ?>">
				       <? echo $myrow[NOMBRE]." - ".$myrow[SUSS]; ?>
		</option>

	<?}
?></select>

<?

}
?>