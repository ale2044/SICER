<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seleccion de Pcias y Dptos.</title>
  <? include_once ('conexion.inc.php');

   ?>
<script type="text/javascript" src="cargarDptos.js"></script>   
<script type="text/javascript" src="jquery.js"></script> 
</head>
<?
$pcias=mysql_query("SELECT * from zona ORDER BY NOMZON ASC");
?>
<form id="form" action="mostrar.php" method="post">
<dl><dt>  	  <label> Provincia :</label></dt>
          	  <dd>	 <select name="pcia" id="pcia"  onchange="cargarDptos();" />
                                 <option value="null">Selecciona una Provincia!</option>
           	 <? 	          while($row=mysql_fetch_assoc($pcias)){
					print '<option value="'.strtolower($row['NOMZON']).'" >'.$row['ZONA']." - ".$row['NOMZON'].'</option>';
											}?>
				</select>
                 </dd>
</dl>                                                  
                                                            
<dl><dt>      <label><span class="rojo">*</span> Departamento :</label></dt>
           		<dd>	 <select name="departamento" id="departamento"  />
                                <option value="null">Selecciona una localidad</option>
           			</select></dd>
</dl>

<input type="submit" value="VER!!!" size="10">

</form>
<body>
</body>
</html>