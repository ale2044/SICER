<?

function tipoactividadafip()
{

$resultados = mysql_query("select ID, ACTIVIDAD, DESCRIPCION from actividades_afip order by ACTIVIDAD asc");

?>
<select size="1" name="act_afipP" style="width:250px">
<option value="null">Selecciona una actividad</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
		
?>
				<option value="<? echo $myrow[ACTIVIDAD]; ?>">
				       <? print utf8_decode($myrow[ACTIVIDAD]." - ".$myrow[DESCRIPCION]); ?>
				</option>

<?}
 
?>    </select>

<?
//return $desc_afip;
}
?>