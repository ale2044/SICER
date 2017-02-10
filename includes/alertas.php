<?php
/*verificar el tipo de alerta y notificar*/
switch ($alerta) {
	case 407:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: La empresa NO existe!");
			</script>
		<?; break;
    case 408:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: Los datos fueron GRABADOS correctamente.");
			</script>
		<?; break;
	case 409:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: La empresa fue dada de BAJA correctamente.");
			</script>
		<?; break;
	case 410:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El empleado fue dado de ALTA correctamente.");
			</script>
    	<?; break;
	case 411:
    	?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El empleado NO existe!");
			</script>
      	<?; break;
    case 412:
      	?>
			<script type="text/JavaScript1.2">
      			alert("ATENCI\u00d3N: El empleado fue actualizado correctamente!");
      	 	</script>
      	<?; break;
    case 413:
   		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El empleado fue dado de baja!");
			</script>
      	<?; break;
    case 414:
      	?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: No se realizaron los cambios.");
			</script>
		<?; break;
	case 415:
      	?>
			<script type="text/JavaScript1.2">
				alert("El familiar fue grabado correctamente.");
			</script>
		<?; break;
	case 416:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El familiar no existe!");
			</script>
		<?; break;
	case 417:
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El familiar fue dado de baja con \u00c9xito!");
			</script>
		<?; break;
	case 'empbaja':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: ESTA EMPRESA YA FUE DADA DE BAJA!");
			</script>
		<?; break;
	case 'empreExiste':
		?>
			<script type="text/JavaScript1.2">
				var cuit_empreJS="<?php echo $cuit_emp;?>";
				if (confirm("La empresa existe ¿Desea editarla?") == true) { 
					window.open("empresaEDITAR.php?cuit_empre="+cuit_empreJS,'_parent');} 
	    	</script>
		<?; break;
	case 'tituBaja':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El titular fue dado de baja comuniquese con Sede Central.");
    		</script>
		<?; break;
	case 'tituBaja_B':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El titular ya fue dado de baja.");
    		</script>
		<?; break;
	case 'empleExiste':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El titular ya existe!");
			</script>
		<?; break;
	case 'famiBaja':
		?>
			<script type="text/JavaScript1.2">
				alert("ATENCI\u00d3N: El familiar fue dado de baja de SINDICATO, AMUTCAER y O.S.!");
			</script>
		<?; break;
	case 209:
			?>
						<script type="text/JavaScript1.2">
							alert("Ya se GUARDARON todos los Familiares");
						</script>
			<?; break;
	case 'nroafilnoen':
			?>
						<script type="text/JavaScript1.2">
							alert("El n\u00FAmero de afiliado no se encuentra");
						</script>
			<?; break;
	case 'tituenfamibaja':
			?>
						<script type="text/JavaScript1.2">
							alert("2201: Error al buscar titular en familiarBAJA.php");
						</script>
			<?; break;
}
/*
2201: Este error es cuando en familiarBAJA.php busca el titular para mostrar sus datos.
*/
?>