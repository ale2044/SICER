<?
/*día, mes y año estandar*/
function dia ()
{
	?>

				<select size="1" name="dia">
					<? for ($i=1; $i<=31; $i++) {
		   					echo "<option value=".$i.">".$i."</option>";
									 } ?>

					</select>

<?
return $dia;
}
function mes ()
{
?>
			<select size="1" name="mes">
					<? for ($i=1; $i<=12; $i++) {
		   					echo "<option value=".$i.">".$i."</option>";
									 } ?>
			</select>
<?

return $mes;

}

function anio ()
{

?>
					<select size="1" name="anio">
					<? for ($i=1950; $i<=date("Y"); $i++) {
		   					echo "<option value=".$i.">".$i."</option>";
									 } ?>

				</select>



<?

return $anio;

}

function diaBe() {
	?>

<select size="1" name="diaBe">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
	
for($i = 1; $i <= 31; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>

					</select>

<?
	
	// return $dia;
}
function mesBe() {
	?>

<select size="1" name="mesBe">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
	
for($i = 1; $i <= 12; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>
			</select>



<?
	
	// return $mes;
}
function anioBe() {
	?>
<select size="1" name="anioBe">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
	
for($i = 1950; $i <= date ( "Y" ); $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>

				</select>



<?
	
	// return $anio;
}
function diaIngs() {
	?>

<select size="1" name="diaIngs">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
	
for($i = 1; $i <= 31; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>

					</select>

<?
	
	// return $dia;
}
function mesIngs() {
	?>

<select size="1" name="mesIngs">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
	
for($i = 1; $i <= 12; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>
			</select>



<?
	
	// return $mes;
}
function anioIngs() {
	?>
<select size="1" name="anioIngs">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
	
for($i = 1950; $i <= date ( "Y" ); $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>
</select>

<?
}
function diaMo() {
?>
<select size="1" name="diaMo">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
<?
for($i = 1; $i <= 31; $i ++) {
			echo "<option value=" . $i . ">" . $i . "</option>";
		}
?>
</select>
<?
// return $dia;
				}
function mesMo() {
		?>

<select size="1" name="mesMo">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
		
for($i = 1; $i <= 12; $i ++) {
			echo "<option value=" . $i . ">" . $i . "</option>";
		}
		?>
			</select>
<?
}
	function anioMo() {
		?>
<select size="1" name="anioMo">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
		
for($i = 1950; $i <= date ( "Y" ); $i ++) {
			echo "<option value=" . $i . ">" . $i . "</option>";
		}
		?>
</select>
<?
	// return $anio;
	}

function diaInic() {
	?>

<select size="1" name="diaInic">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
	
for($i = 1; $i <= 31; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>

					</select>

<?
	
	// return $dia;
}
function mesInic() {
	?>

<select size="1" name="mesInic">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
	
for($i = 1; $i <= 12; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>
			</select>



<?
	
	// return $mes;
}
function anioInic() {
	?>
<select size="1" name="anioInic">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
	
for($i = 1950; $i <= date ( "Y" ); $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>

				</select>



<?
	
	// return $anio;
}
function diaCNT() {
	?>

<select size="1" name="diaCNT">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
	
for($i = 1; $i <= 31; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>

					</select>

<?
	
	// return $dia;
}
function mesCNT() {
	?>

<select size="1" name="mesCNT">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
	
for($i = 1; $i <= 12; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>
			</select>



<?
	
	// return $mes;
}
function anioCNT() {
	?>
<select size="1" name="anioCNT">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
	
for($i = 1950; $i <= date ( "Y" ); $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>
				</select>
<?
}
function diaRcp() {
	?>

<select size="1" name="diaRcp">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
	
for($i = 1; $i <= 31; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>

					</select>

<?
}
function mesRcp() {
	?>

<select size="1" name="mesRcp">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
	
for($i = 1; $i <= 12; $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>
			</select>



<?
}
function anioRcp() {
	?>
<select size="1" name="anioRcp">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
	
for($i = 1950; $i <= date ( "Y" ); $i ++) {
		echo "<option value=" . $i . ">" . $i . "</option>";
	}
	?>

				</select>
<?
}			/* -------------------------Ultimo pago OS------------------------------- */
function diapos() {
	?>

<select size="1" name="diapos">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
					for($i = 1; $i <= 31; $i ++) {
						echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}
function mespos() {
	?>

<select size="1" name="mespos">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
					for($i = 1; $i <= 12; $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
				  }
	?>
	</select>
	<?
}
function aniopos() {
	?>
<select size="1" name="aniopos">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
					for($i = 1950; $i <= date ( "Y" ); $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}

/* -------------------------Ultimo periodo sindical------------------------------- */

function diapes() {
	?>

<select size="1" name="diapes">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
					for($i = 1; $i <= 31; $i ++) {
						echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}
function mespes() {
	?>

<select size="1" name="mespes">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
					for($i = 1; $i <= 12; $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
				  }
	?>
	</select>
	<?
}
function aniopes() {
	?>
<select size="1" name="aniopes">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
					for($i = 1950; $i <= date ( "Y" ); $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}

/* -------------------------Ultimo pago SINDICAL------------------------------- */

function diapsi() {
	?>

<select size="1" name="diapsi">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
					for($i = 1; $i <= 31; $i ++) {
						echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}
function mespsi() {
	?>

<select size="1" name="mespsi">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
					for($i = 1; $i <= 12; $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
				  }
	?>
	</select>
	<?
}
function aniopsi() {
	?>
<select size="1" name="aniopsi">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
					for($i = 1950; $i <= date ( "Y" ); $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}

/* -------------------------Ultimo pago MUTUAL------------------------------- */

function diapm() {
	?>

<select size="1" name="diapm">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
					for($i = 1; $i <= 31; $i ++) {
						echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}
function mespm() {
	?>

<select size="1" name="mespm">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
					for($i = 1; $i <= 12; $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
				  }
	?>
	</select>
	<?
}
function aniopm() {
	?>
<select size="1" name="aniopm">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
					for($i = 1950; $i <= date ( "Y" ); $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}

/* -------------------------ingreso a la empresa------------------------------- */

function diaIe() {
	?>

<select size="1" name="diaIe">
	<option value="<? print Date('d'); ?>"><? print Date("d"); ?></option>
					<?
					for($i = 1; $i <= 31; $i ++) {
						echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}
function mesIe() {
	?>

<select size="1" name="mesIe">
	<option value="<? print Date('m'); ?>"><? print Date("m"); ?></option>
					<?
					for($i = 1; $i <= 12; $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
				  }
	?>
	</select>
	<?
}
function anioIe() {
	?>
<select size="1" name="anioIe">
	<option value="<? print Date('Y'); ?>"><? print Date("Y"); ?></option>
					<?
					for($i = 1950; $i <= date ( "Y" ); $i ++) {
							echo "<option value=" . $i . ">" . $i . "</option>";
					}
	?>
	</select>
	<?
}?>