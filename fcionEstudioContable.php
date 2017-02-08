<?
function mostrarEstudioContable()
{

$resultados = mysql_query("select C_ESTUDIO, D_ESTUDIO, N_CUIT from estconta order by D_ESTUDIO asc");

?>
<select size="1" name="agregarEstudioContable" style="width:250px">
 
<option value="2">Selecciona un Estudio Contable</option>
<option value="1">>> Agregar estudio contable [...]</option>
<option value="100">>> Misma Empresa []</option>
<option value="101">>> Modificar luego --</option>

<? while ($myrow=mysql_fetch_array($resultados))
	{
?>
				
				<option value="<?print utf8_decode($myrow[C_ESTUDIO]); ?>">
				       <? print utf8_decode($myrow[D_ESTUDIO]); ?>
		</option>

	<?}
?></select>
<?

}

?>