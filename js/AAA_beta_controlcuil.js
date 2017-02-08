<script type="text/javascript">
function checkcuitl() {
	//Controla la longitud del cuil
	var tipo1 = document.formulario.cuilemple.value;
	numCarac = tipo1.length;
	if (numCarac < 11 )
	{alert("ATENCI\u00d3N: El nro de CUIL debe tener 11 d\u00edgitos.");}

	//Controla que el cuil este correctamente escrito
	var nCuix = document.formulario.cuilemple.value;// numero de cuil ingresado
	tamanio = nCuix.length;//tiene el tam del cuil tamanio=11
	nVerif = '5432765432';
	
	if (tamanio == 11)
	{
		aMult = nVerif.split('');//Separa el numero para validar 5,4,3,2,7,6,5,4,3,2
		aCUIx = nCuix.split(''); //Separa el cuil en 2,0,3,2,1,9,2,3,6,7,5
	
		var iResult = 0;
		for(i = 0; i < 10; i++)
		{
		iResult += aCUIx[i] * aMult[i];
		}
		iResult = (iResult % 11); //suma 124 y el modulo es 3
		iResult = 11 - iResult;
	
		if (iResult == 11) iResult = 0;
		if (iResult == 10) iResult = 9;

		if (iResult == aCUIx[10])
		{
		//alert ('CUIL ' + nCuix + ' VÁLIDO');
		return true;
		}
		else
		alert ('CUIL ' + nCuix + ' inválido');
	}
	else alert ('CUIL ' + nCuix + ' inválido');
	return false;

}
</script>