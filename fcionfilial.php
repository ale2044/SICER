<?

function filiales()
{
?>
<select name="lugar" id="lugar">
<option value="null">Selecciona lugar/ubicaci&oacute;n</option>
<optgroup label="Filial">
            							<option value="01">Chajar&iacute;</option>        
                						<option value="02">La Paz</option>        
                						<option value="03">Federal</option>        
                						<option value="04">Concordia</option>        
                						<option value="05">San Salvador</option>        
                						<option value="06">Col&oacute;n</option>
                						<option value="07">Villaguay</option>        
                						<option value="08">Villa Elisa</option>
                						<option value="09">Crespo</option>        
                						<option value="10">Hasenkamp</option>
                						<option value="11">C. del Uruguay</option>        
                						<option value="12">Gualeguaychu</option>
                						<option value="13">Gualeguay</option>        
                						<option value="14">Victoria</option>
            						</optgroup>
           								<optgroup label="SEP">      
            							<option value="15">SEP Paran&aacute;</option>
            							<option value="16">SEP Concordia</option>
            						</optgroup>
            							<optgroup label="Sede Central">                 
            							<option value="17">Casa Central (Maci&aacute; 740)</option>        
            							<option value="18">Obra Social (Ramirez 2921)</option>
            						</optgroup>
            							<optgroup label="Otros">        
            							<option value="19">Camping Paran&aacute;</option>        
            						</optgroup>
            					</select>

<?
}

function filiales_mostrar($numero)
{    
switch ($numero){
                            case '01': echo "Chajar&iacute";
                                break;
                            case '02': echo "La Paz";
                                break;
                            case '03': echo "La Federal";
                                break;
                            case '04': echo "Concordia";
                                break;
                            case '05': echo "San Salvador";
                                break;
                            case '06': echo "Col&oacute;n";
                                break;
                            case '07': echo "Villaguay";
                                break;
                            case '08': echo "Villa Elisa";
                                break;
                            case '09': echo "Crespo";
                                break;
                            case '10': echo "Hasenkamp";
                                break;
                            case '11': echo "C. del Uruguay";
                                break;
                            case '12': echo "Gualeguaychu";
                                break;
                            case '13': echo "Gualeguay";
                                break;
                            case '14': echo "Victoria";
                                break;
                            case '15': echo "SEP Paran&aacute;";
                                break;
                            case '16': echo "SEP Concordia";
                                break;
                            case '17': echo "Casa Central (Maci&aacute; 740)";
                                break;
                            case '18': echo "Obra Social (Ramirez 2921)";
                                break;
                            case '19': echo "Camping Paran&aacute;";
                                break;
                }
}
?>