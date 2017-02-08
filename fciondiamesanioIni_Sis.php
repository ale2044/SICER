<?
function diaIng ()
{
?>
				<select size="1" name="diaIng">
				<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<? for ($i=1; $i<=31; $i++) {
		   					echo "<option value='$i' selected>".$i."</option>";
									 } ?>
					</select>
					
<?
}

function mesIng ()
{
?>
			<select size="1" name="mesIng">
			<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<? for ($i=1; $i<=12; $i++) {
		   					echo "<option value='$i' selected>".$i."</option>";
									 } ?>
			</select>
<?
}

function anioIng ()
{
?>
					<select size="1" name="anioIng">
					<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?  
					for ($i=1998; $i<=date("Y"); $i++) {
		   					echo "<option value='$i' selected>".$i."</option>";
							}
					?>
				</select>
<?
}
?>