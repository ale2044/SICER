<?

function diaIni ()
{
?>

				<select size="1" name="diaIni">
					<? for ($i=1; $i<=31; $i++) {
		   					echo "<option value='$i'>".$i."</option>";
									 } ?>

					</select>

<?

//return $diaIni;

}

function mesIni ()
{
?>

			<select size="1" name="mesIni">
					<? for ($i=1; $i<=12; $i++) {
		   					echo "<option value='$i'>".$i."</option>";
									 } ?>
			</select>



<?

//return $mesIni;

}


function anioIni ()
{

?>
					<select size="1" name="anioIni">
					<? for ($i=1950; $i<=date("Y"); $i++) {
		   					echo "<option value='$i'>".$i."</option>";
									 } ?>

				</select>



<?

//return $anioIni;

}

///////////////////////////// FECHA NACIMIENTO ///////////////////////////

function diaNac ()
{
?>

				<select size="1" name="diaNac">
					<? for ($i=1; $i<=31; $i++) {
		   					echo "<option value='$i'>".$i."</option>";
									 } ?>

					</select>

<?

//return $diaNac;

}

function mesNac ()
{
?>

			<select size="1" name="mesNac">
					<? for ($i=1; $i<=12; $i++) {
		   					echo "<option value='$i'>".$i."</option>";
									 } ?>
			</select>



<?

//return $mesNac;

}


function anioNac ()
{

?>
					<select size="1" name="anioNac">
					<? for ($i=1945; $i<=date("Y"); $i++) {
		   					echo "<option value='$i'>".$i."</option>";
									 } ?>

				</select>



<?

//return $anioNac;

}

?>