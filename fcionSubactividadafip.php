<?
session_start();
require_once("includes/connection.php");

function tipoSubActividadAfip()
{

$resultados = mysql_query("select ID, ACTIVIDAD, DESCRIPCION from actividades_afip order by ACTIVIDAD asc");

?>

<select size="1" name="act_afipS" style="width:250px">
<option value="null">Selecciona otra actividad</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
				<option value="<? echo $myrow[ACTIVIDAD]; ?>">
				       <? print utf8_decode($myrow[ACTIVIDAD]." - ".$myrow[DESCRIPCION]); ?>
				</option>

<?}
 
?>    </select>

<?
}

function tipoSubIIActividadAfip()
{

	$resultados = mysql_query("select ID, ACTIVIDAD, DESCRIPCION from actividades_afip order by ACTIVIDAD asc");

	?>

<select size="1" name="act_afipT" style="width:250px">
<option value="null">Selecciona otra actividad</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
				<option value="<? echo $myrow[ACTIVIDAD]; ?>">
				       <? print utf8_decode($myrow[ACTIVIDAD]." - ".$myrow[DESCRIPCION]); ?>
				</option>

<?}
 
?>    </select>

<?
}

function tipoSubIIIActividadAfip()
{

	$resultados = mysql_query("select ID, ACTIVIDAD, DESCRIPCION from actividades_afip order by ACTIVIDAD asc");

	?>

<select size="1" name="act_afipC" style="width:250px">
<option value="null">Selecciona otra actividad</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
				<option value="<? echo $myrow[ACTIVIDAD]; ?>">
				       <? print utf8_decode($myrow[ACTIVIDAD]." - ".$myrow[DESCRIPCION]); ?>
				</option>

<?}
 
?>    </select>

<?
}

function tipoSubIVActividadAfip()
{

	$resultados = mysql_query("select ID, ACTIVIDAD, DESCRIPCION from actividades_afip order by ACTIVIDAD asc");

	?>

<select size="1" name="act_afipQ" style="width:250px">
<option value="null">Selecciona otra actividad</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
				<option value="<? echo $myrow[ACTIVIDAD]; ?>">
				       <? print utf8_decode($myrow[ACTIVIDAD]." - ".$myrow[DESCRIPCION]); ?>
				</option>

<?}
 
?>    </select>

<?
}
?>