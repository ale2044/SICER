
function cargarDptos(){
	$('#departamento').html('<option selected>Cargando</option>');
            
 	var idPcia= $('#pcia').val();

	var toLoad= 'cargar_provincias.php?pcia='+ idPcia ;
	$.post(toLoad,function (responseText){
							
	$('#departamento').html(responseText);
	
							});

}